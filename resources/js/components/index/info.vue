<template>
  <div>
    <div>
        <div class="notices">
            <div id="carouselExampleCaptions" class="carousel slide carousel-notices" data-bs-ride="carousel" v-if="news.length >= 3">
                

                <div class="carousel-indicators" >
                    <button type="button" v-for="(item, index) of news" :key="index" data-bs-target="#carouselExampleCaptions" :data-bs-slide-to="index" class="active" aria-current="true" aria-label="Slide 1"></button>    
                </div>

                <div class="carousel-inner">
                <span v-for="(item, index) of news.length" :key="index">
                    <info-item v-if="index == 0" @click.native="openNew = true; actualNew = news[index];" class="active" :title="news[index].title" :subtitle="news[index].subtitle" :image="news[index].image" :link="news[index].finalHref"></info-item>
                    <info-item v-else @click.native="openNew = true; actualNew = news[index];" :title="news[index].title" :subtitle="news[index].subtitle" :image="news[index].image" :link="news[index].finalHref"></info-item>
                </span>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next" id="carouselNext">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div v-else id="cargandoNoticiasCuad">
                <h1 id="cargandoNoticias">Cargando noticias</h1>
            </div>
        </div>
    </div>



    <span v-if="openNew">
        <div class="blackscreen"></div>
        <info-modal @closeModal="openNew = false; actualNew = [];" :info="actualNew" ></info-modal>
    </span>

    <div class="panel_objeto">
        <a href="javascript:void(0)" @click="updateNews()" class="panel_boton">Actualizar noticias</a>
    </div>
    
  </div>
</template>

<script>
import axios from 'axios';

export default {
    mounted() {
        this.getNews();
    },
    data() {
        return {
            news: [],
            newsLimit: 10,
            actualNew: [],
            openNew: false,
            newsUrl: 'https://www.lanacion.com.ar'
        }
    },
    methods: {
        getNews() {
            axios.post('/api/noticias/obtener').then((response) => {
                this.news = response.data;
            });
        },
        updateNews() {
            // Call to api and get news html
            axios.post('/api/noticias/buscar', {url:this.newsUrl}).then((response) => {
                // || Transform to html object
                let html = document.createElement('html');
                html.innerHTML = response.data;

                // || Get all the articles
                let articles = html.getElementsByClassName('mod-article');
                axios.post('/api/noticias/limpiar');

                for(let i = 0; i<articles.length; i++) {
                    if(i >= this.newsLimit) break;
                    this.processArticle(articles[i]);
                }

                // || Send processed to database
            });
        },
        processArticle(article) {
            try {    
                let href = article.getElementsByTagName('a')[0].href;
                let finalurl = this.newsUrl;

                // Change for local to 21, 24 for prod

                for(let i = 24; i<href.length; i++) {
                    finalurl+=href[i];
                }


                axios.post('/api/noticias/buscar', {url:finalurl}).then((response) => {
                    try {
                        // Search the image
                        let respHtml = document.createElement('html');
                        respHtml.innerHTML = response.data;
                        
                        let art = {
                            title: article.getElementsByClassName('com-title')[0].getElementsByTagName('a')[0].innerHTML,
                            image: this.ClearImageLink(respHtml.getElementsByClassName('placeholder ')[0].getElementsByTagName('img')[0].src),
                            link: finalurl,
                        };
                        axios.post('/api/noticias/guardar', {new: art});
                                              
                        
                    } catch (errorII) {return -1;}
                });

            } 
            catch (error) {return -1;}
        },
        ClearImageLink(link) {
            //console.log("image: " + link);

            let result = 'https://';
            for(let i = 0; i<link.length; i++){
                if(
                    link[i] === 'c' &&
                    link[i+1] === 'l' &&
                    link[i+2] === 'o' &&
                    link[i+3] === 'u' &&
                    link[i+4] === 'd') 
                    {
                        for(let j = i; j<link.length; j++) {
                            result+=link[j];
                        }
                        break;
                    }
            }
            //console.log("image result: " + result);
            return result;
        }   
    },
}
</script>

<style scoped>
    a {
        text-decoration: none;
    }

    .notices {
        display: flex;
        justify-content: center;

        margin-top: 3em;

        height: 500px;
        align-items: center;
    }
    .carousel-notices {
        width: 90%;
    }

    .carousel-inner {

        height: 500px;
        min-height: 500px;
        max-height: 500px;
    }

    .carousel-item {
        height: 400px;
        min-height: 400px;
        max-height: 400px;
    }

    .carousel-item>img {
        height: 100%;
        object-fit: cover;
    }

    .carousel-control-prev {
        background: rgba(0, 0, 0, 0.3);
    }
    .carousel-control-next {
        background: rgba(0, 0, 0, 0.3);
    }

    .carousel-control-prev-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='white'%3e%3cpath d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'/%3e%3c/svg%3e");
    }
    
    .carousel-control-next-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='white'%3e%3cpath d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }

    .carousel-caption {
        background: rgba(0, 0, 0, 0.15);
        bottom: .01rem;
    }

    #cargandoNoticias {
        color: gray;
        animation-duration: 3s;
        animation-name: loading;
        animation-iteration-count: infinite;
    }

    #cargandoNoticiasCuad {
        width: 90%;
        background: rgba(128, 128, 128, 0.466);
        height: 500px;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    @keyframes loading {
        0% {
            color: gray;
        }

        30% {
            color: rgb(128, 128, 128, .5);
        }

        60% {
            color: gray;
        }

        90% {
            color: rgb(128, 128, 128, .5);
        }
        100% {
            color: gray;
        }
    }

    .blackscreen {
        background: rgba(0, 0, 0, 0.5);
        width: 100vw;
        height: 110vh;
        position: absolute;
        top: 0;
        left: 0;
    }
    .panel_objeto {
        background-color: rgba(255, 255, 255, 0.5);
        width: 90%;

        margin: auto;
        padding: .3em;
    }

    .panel_boton {
        border-right: 1px solid rgba(128, 128, 128, 0.5);
        padding-right: 1em;
    }

</style>