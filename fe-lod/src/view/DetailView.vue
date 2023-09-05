<script setup>
import NavBar from '../components/NavBar.vue'
</script>

<template>
    <NavBar />
    <main>
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">{{ article.title }}</h1>
                </div>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row col-12">
                    <div class="col">
                        <div class="card shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title class="fw-bold">Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef"
                                    dy=".3em">Thumbnail</text>
                            </svg>

                            <div class="card-body">
                                <p class="card-text">{{ article.title }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">{{ article.content }}</small>
                                </div>
                                <div class="text-end">
                                    <a class="btn btn-primary" href="/">Back</a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </main>
</template>
<script>

import axios from 'axios'
// import { onMounted, ref } from 'vue';

export default {

    data: () => ({
        article: [],
    }),
    created() {
        var slug = this.$route.params.slug; // here I'm getting error that Uncaught TypeError: Cannot read property 'params' of undefined
        // console.log('http://localhost:8080/api/article/show/' + slug);
        this.posts = [];
        axios.get('http://localhost:8080/api/article/show/' + slug).then(res => {
            this.article = res.data;

            // console.log(this.article)
        })
            .catch(err => {
                console.log(err);
            });
    },
}
</script>