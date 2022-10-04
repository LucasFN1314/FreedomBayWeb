<template>
    <div>
        <div class="infoModal">
            <div class="closeModal">
                <i class="bi bi-x-circle" id="closeModal" @click="$emit('closeModal')"></i>
            </div>
            <div id="modal-container">
                <span id="start"></span>
                <div id="modalTitle">
                    <h1>{{ this.title }}</h1>
                </div>

                <div id="subtitle">
                    <h4>{{ this.subtitle }}</h4>
                </div>

                <div id="principalImage">
                    <img :src="this.image" alt="" />
                </div>

                <div id="info">
                    <p v-for="(item, index) of data" :key="index">
                        {{ data[index].innerText }}
                    </p>
                </div>

                <div id="keepReading">
                    <a href="javascript:void(0)" @click="
                      getInfoWithUrl(
                        keepReading[index].getElementsByTagName('a')[0].href
                      )
                    " v-for="(item, index) of keepReading" :key="index">{{ keepReading[index].innerText }}</a>
                </div>
            </div>
        </div>

        
    </div>
</template>

<script>
import axios from "axios";
export default {
    mounted() {
        console.log("Abriendo. . .");
        this.getInfo();
    },
    data() {
        return {
            data: [],
            keepReading: [],
            title: "",
            subtitle: "",
            image: "",
        };
    },
    methods: {
        getInfo() {
            this.image = this.info.image;
            this.subtitle = this.info.subtitle;
            this.title = this.info.title;

            axios.post("/api/html", { url: this.info.finalHref }).then((response) => {
                let html = document.createElement("html");
                html.innerHTML = response.data;

                this.data = html.getElementsByClassName("paragraph");
                this.keepReading = html.getElementsByClassName("text-element");
            });
        },
        getInfoWithUrl(url) {
            console.log(url);
            axios.post("/api/html", { url: url }).then((response) => {
                let html = document.createElement("html");
                html.innerHTML = response.data;

                this.data = html.getElementsByClassName("paragraph");
                this.keepReading = html.getElementsByClassName("text-element");

                this.title =
                    html.getElementsByClassName("article-headline")[0].innerHTML;
                this.subtitle = html.getElementsByClassName(
                    "article-subheadline"
                )[0].innerText;
                this.image = html
                    .getElementsByClassName("visual__image")[0]
                    .getElementsByTagName("img")[0].src;

                document.getElementById('start').scrollIntoView({behavior: 'smooth'}, true);
            });
        },
    },
    props: ["info"],
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@100&display=swap");

.infoModal {
    height: 600px;
    width: 90%;

    background: white;
    z-index: 100;

    position: absolute;

    top: 50%;
    left: 50%;
    margin-left: auto;
    margin-right: auto;

    transform: translate(-50%, -50%);

    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
}

#modal-container {
    overflow-y: scroll;
    height: inherit;
}

.closeModal {
    position: relative;
}

#closeModal {
    position: absolute;
    font-size: 30px;

    right: 0;
    top: 0;
    z-index: 100;

    margin-right: 1em;
    margin-top: .5em;


    color: rgba(0, 0, 0, 0.521);
}

#modalTitle,
#subtitle {
    text-align: center;
    margin-top: 3em;
    margin-bottom: 1em;
    margin-right: 2em;
    margin-left: 2em;
}

#subtitle {
    margin-top: 0;
    margin-left: 8em;
    margin-right: 8em;

    font-family: "Libre Franklin", sans-serif;
}

#principalImage {
    width: 100%;
    height: 600px;

    display: flex;
    justify-content: center;

    margin-bottom: 2em;
}

#principalImage>img {
    width: 80%;
    height: 100%;
    object-fit: cover;
}

#info {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-content: center;
}

p {
    font-family: "Libre Franklin", sans-serif;
    font-size: 18px;

    margin-left: 8em;
    margin-right: 8em;

    text-align: justify;
}

#keepReading {
    display: flex;
    flex-direction: column;

    margin-left: 9em;
    margin-right: 9em;
    margin-bottom: 2em;
}

#keepReading>a {
    text-decoration: none;
    font-family: "Libre Franklin", sans-serif;

    font-weight: 600;
    margin-bottom: 0.5em;
}
</style>