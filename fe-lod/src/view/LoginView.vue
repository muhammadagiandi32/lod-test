<template>
    <div class="text-center">
        <main class="form-signin">
            <form v-on:submit.prevent="submitForm">
                <img class="mb-4" src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                <div class="form-floating">
                    <input type="email" v-model="form.email" class="form-control" name="email" id="floatingInput"
                        placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                    <input type="password" v-model="form.password" class="form-control" name="password"
                        id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                <p class="mt-5 mb-3 text-muted">© 2017–2021</p>
            </form>
        </main>
    </div>
</template>
<script>
import axios from 'axios'
// import { onMounted, ref } from 'vue';
export default {
    name: 'LoginForm',
    data() {
        return {
            form: {
                email: '',
                password: '',
            }
        }
    },
    methods: {
        submitForm() {
            console.log(this.form)
            axios.post('api/auth', this.form, {
                headers: {
                    "Access-Control-Allow-Origin": "*",
                    'Content-Type': 'application/json',
                    "Access-Control-Allow-Methods": "GET, POST, OPTIONS, PUT, DELETE",
                    "Access-Control-Allow-Headers": "X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization",
                    "Access-Control-Allow-Credentials": true,

                },
            })
                .then((response) => {
                    //Perform Success Action
                    localStorage.setItem('X-AUTH-TOKEN', response.data.token);
                    console.log(response.data)
                    // document.cookie = `X-AUTH-TOKEN=${response.data.token}`;
                    // commit("SET_TOKEN", response.data.token);
                    // commit("LOGIN_COMPLETE");
                    window.location = "/create"
                })
                .catch((error) => {
                    // error.response.status Check status code
                    console.log(error)

                }).finally(() => {
                    //Perform action in always
                });
        }
    }
}
</script>