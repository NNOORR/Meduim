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

    .carousel-item img, .carousel {
        max-height: 250px;
        max-width: 600px;
        min-width: 600px;
        min-height: 250px;
    }
    .carousel {
        margin: 0 auto;
    }

</style>
<template>
    <div style="float: left; width:100%;">

        <hr/>
        <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
            <ol  class="carousel-indicators">
                <li v-for="(attachment, index) in attachments" data-target="#carouselExampleIndicators" v-bind:data-slide-to="index"  v-bind:class="[{active: index == 0}]"></li>
            </ol>
            <div class="carousel-inner">
                <div v-for="(attachment, index) in attachments" class="carousel-item" v-bind:class="[{active: index == 0}]">
                    <img v-bind:src="attachment" class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <hr/>


        <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 65rem;">
            <div class="card-body">
                <h3 class="card-title" style="font-weight: bolder;">{{ article.title}}</h3>
                <p class="card-text">{{ article.description }}</p>
                <hr/>
                <h6 class="card-title" style="font-style: italic">Author: {{ article.author_name }}</h6>
                <h6 class="card-title" style="font-style: italic;">Article date: {{ article.created_at }}</h6>
                <h6 class="card-title" style="font-style: italic;">Read by: {{ article.preview_count }}</h6>
                <a href="/" class="btn btn-primary">Go Back</a>
                <hr/>
                <span v-for="(tag, index) in tags" class="badge badge-primary m-1">{{ tag.name }}</span>
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
                //articles: [],
                tags:[],
                tag: {
                    id: '',
                    name: '',
                },
                attachments: [],
                attachment: {
                  path: '',
                },
                article: {
                    id: '',
                    title: '',
                    brief: '',
                    description: '',
                    author_name: '',
                    preview_count: '',
                    created_at: '',
                },
                meta_search: {
                    search_key: ''
                },
                pagination: {},
            }
        },
        created() {
            this.getArticle();
        },

        methods: {
            getArticle(){
                let vm = this;
                fetch('/api/get-article/' + this.$route.params.id,{
                    method: 'get',
                    //body: JSON.stringify(this.meta_search),
                    headers:{
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    }
                })
                    .then(res => res.json())
            .then(data => {
                    var a = data['data']['article'];
                    this.article.title = a['title']
                    this.article.brief = a['brief']
                    this.article.description = a['description']
                    this.article.author_name = a['author_name']
                    this.article.created_at = a['created_at']
                    this.article.preview_count = a['preview_count']
                    this.tags = data['data']['tags']
                    this.attachments = data['data']['attachments']
            })
            .catch(err => console.log(err));
            }
        }
    };
</script>