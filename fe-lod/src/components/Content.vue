<template>
    <main>

        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Article CRUD test PT LOD</h1>
                </div>
            </div>
            <input class="form-control me-2" v-model="search" placeholder="Search Article..." aria-label="Search">

        </section>

        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <div class="col" v-for="article in article" :key="article.id">
                        <div class="card shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef"
                                    dy=".3em">Thumbnail</text>
                            </svg>

                            <div class="card-body">
                                <p class="card-text">{{ article.title }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a type="button" :href="'/detail/' + article.slug"
                                            class="btn btn-sm btn-outline-secondary">View</a>
                                        <a type="button" :href="'/edit/' + article.slug"
                                            class="btn btn-sm btn-outline-secondary">Edit</a>
                                        <a type="button" :href="'/delete/' + article.slug"
                                            class="btn btn-sm btn-outline-secondary">Hapus</a>
                                    </div>
                                    <small class="text-muted">{{ article.time }}</small>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </main>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
// import { onMounted, ref } from 'vue';

export default {

    data: () => ({
        article: [],
        readTime: [],
        search: '',
    }),
    created() {
        this.posts = [];
        axios.get('api/article/getAll').then(res => {
            this.article = res.data.data;

            console.log(this.article)
        })
            .catch(err => {
                console.log(err);
            });
    },
    computed: {
        article() {
            return this.article.filter(item => item.title.includes(this.search));
        }
    }
}
</script>