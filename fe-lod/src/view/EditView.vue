<script setup>
import NavBar from '../components/NavBar.vue'

</script>
<template>
    <NavBar />
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h2>Create New Article </h2>
            </div>

            <div class="row g-5">
                <div class="col-md-12 col-lg-12">
                    <h4 class="mb-3">Billing address</h4>
                    <form v-on:submit.prevent="updateArticle">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">Title</label>
                                <input type="text" v-model="article.title" class="form-control" id="firstName"
                                    placeholder="">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">author</label>
                                <input type="text" v-model="article.author" class="form-control" id="lastName"
                                    placeholder="">
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Content</label>
                                    <textarea class="form-control" v-model="article.content"
                                        id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
                    </form>
                </div>
            </div>
        </main>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© 2017–2021 Company Name</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
    </div>
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
    methods: {
        updateArticle(e) {
            e.preventDefault();
            // value = event.target.value;
            let url = 'localhost:8080/api/article/update/' + this.article.id;
            // this.article = value;
            // console.log(url);
            axios.patch(`api/article/update/10`, this.article, {
                headers: {
                    "Access-Control-Allow-Origin": "*",
                    'Content-Type': 'application/json',
                    "Access-Control-Allow-Methods": "GET, POST, OPTIONS, PUT, DELETE",
                    "Access-Control-Allow-Headers": "X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization",
                    "Access-Control-Allow-Credentials": true,
                    'Authorization': 'Bearer ' + localStorage.getItem('X-AUTH-TOKEN')

                },
            })
                .then((response) => {
                    console.log(response)
                    // window.location = "/create"
                })
                .catch((error) => {
                    // error.response.status Check status code
                    console.log(error)

                }).finally(() => {
                    //Perform action in always
                });
        },
    }
}

</script>