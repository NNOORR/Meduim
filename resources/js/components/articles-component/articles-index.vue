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