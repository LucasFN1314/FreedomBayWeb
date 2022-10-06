<template>
    <div class="carousel-item" data-bs-interval="6000">
        <img :src="this.image" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
            <div v-html="this.title" class="title"></div>
            <p id="subtitle"></p>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.htmlTitle = document.createElement('a');
        this.htmlTitle.innerHtml = this.title;
    },
    data() {
        return {
            htmlTitle: ''
        }
    },
    props: ['title', 'subtitle', 'image', 'link']
}
</script>

<style scoped>
    @import url('https://fonts.googleapis.com/css2?family=Libre+Franklin&display=swap');

    a {
        color: white;
        text-decoration: none;
    }

    .notices {
        display: flex;
        justify-content: center;

        margin-top: 5em;

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
        height: 500px;
        min-height: 500px;
        max-height: 500px;
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
        background: rgba(0, 0, 0, 0.5);
        bottom: .01rem;
    }

    .title {
        font-family: 'Libre Franklin', sans-serif;
        font-weight: 600;
    }

    p {
        margin-bottom: 2em;
    }

</style>