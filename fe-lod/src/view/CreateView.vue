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
                    <form v-on:submit.prevent="submitArticle">
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
    name: 'submitArticle',
    data() {
        return {
            article: {
                title: '',
                author: '',
                content: '',
            }
        }
    },
    methods: {

        async submitArticle(e) {
            e.preventDefault();
            // console.log(this.article)
            axios.post('api/article/new', this.article, {
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
                    //Perform Success Action
                    // localStorage.getItem('X-AUTH-TOKEN');
                    console.log(response.data.success)
                    // document.cookie = `X-AUTH-TOKEN=${response.data.token}`;
                    // commit("SET_TOKEN", response.data.token);
                    // commit("LOGIN_COMPLETE");
                    // window.location = "/create"
                })
                .catch((error) => {
                    // error.response.status Check status code
                    console.log(error.response.data.success)
                    if (error.response.data.success == false) {
                        window.location = "/logout"

                    }

                }).finally(() => {
                    //Perform action in always
                });
        }
    }
}
</script>