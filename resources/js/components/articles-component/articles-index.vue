<style>
    .bi:hover {
        cursor: pointer;
        color: hsl(240, 65%, 75%);
    }

    .active-cyan input[type=text] {
        border-bottom: 1px solid #4dd0e1;
        box-shadow: 0 1px 0 0 #4dd0e1;
    }

    .clearfix {
        clear: both;
    }
</style>

<template>
    <div style="float: left; width:100%;">

        <div style="height: 60px; width: 100%;">

            <div style="width: 100px; height: 50px; float: left;">
                <nav aria-label="Page navigation example">
                    <div style=" width: 250px; display: inline-block;">
                        <ul class="pagination" style="width: 250px;">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a
                                    class="page-link" href="#"
                                    @click="fetchArticles(pagination.prev_page_url)">Previous</a></li>
                            <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{
                                pagination.current_page}} of {{ pagination.last_page }}</a></li>
                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a
                                    class="page-link" href="#"
                                    @click="fetchArticles(pagination.next_page_url)">Next</a></li>
                        </ul>
                    </div>
                </nav>
            </div>

        </div>

        <div class="clearfix"></div>


        <div class="shadow-lg p-3 bg-white rounded-lg card card-body mb-2 mr-2 float-left"
             style="max-height: 362px; height: 362px; width:240px; max-width: 240px" v-for="(article, index) in articles"
             v-bind:key="article.id">
            <h4 style="text-align: center">{{ article.title }}</h4>
            <h4 style="text-align: center">{{ article.created_at }}</h4>
            <!--<img @click="openModal(index)" v-bind:src="photo.path"
                 style="cursor: pointer; max-height: 188px; max-width: 200px; height: 188px; width: 200px;"/>-->
            <p class="mt-1" style="height: 75px; max-height:75px; overflow-y: auto">{{ article.brief}} </p>
            <p class="mt-1" style="height: 75px; max-height:75px; overflow-y: auto">Read By: {{ article.preview_count}} </p>
            <div>
                <ul style="list-style: none; padding: 0px;">
                  <router-link class="nav-link" v-bind:to="'/article/' + article.id">View</router-link>
                    <li><span title="favorite">
                        <svg @click="article/1" class="bi bi-star" width="1em"
                                                    height="1em" viewBox="0 0 16 16" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 00-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 00-.163-.505L1.71 6.745l4.052-.576a.525.525 0 00.393-.288l1.847-3.658 1.846 3.658a.525.525 0 00.393.288l4.052.575-2.906 2.77a.564.564 0 00-.163.506l.694 3.957-3.686-1.894a.503.503 0 00-.461 0z"
                              clip-rule="evenodd"/>
                    </svg></span></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    var mediaG = [],
        media_indexG;

    export default {
        data() {
            return {
                articles: [],
                article: {
                    id: '',
                    title: '',
                    brief: '',
                    description: '',
                    author_name: '',
                    preview_count: '',
                },
                meta_search: {
                    search_key: ''
                },
                pagination: {},
            }
        },
        created() {
            this.fetchArticles();
        },

        methods: {
            fetchArticles(page_url){
                let vm = this;
                page_url = page_url || 'api/get-articles'
                fetch(page_url,{
                    method: 'get',
                    //body: JSON.stringify(this.meta_search),
                    headers:{
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    }
                })
                    .then(res => res.json())
            .then(data => {
                    this.articles = data['data'].data;
                mediaG = this.articles;
                vm.makePagination(data['data']);
            })
            .catch(err => console.log(err));
            },
            makePagination(meta){
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: meta.next_page_url,
                    prev_page_url: meta.prev_page_url
                }

                this.pagination = pagination;
            },
        }
    };
</script>