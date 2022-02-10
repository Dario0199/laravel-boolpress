<template>
  <div class="container">
      <h1 class="mb-5">Our Blog</h1>

      <div class="mb-5" v-if="posts">
          <article class="mb-5" v-for="post in posts" :key="`post-${post.id}`">
              <h2>{{ post.title }}</h2>
              <div class="mb-2">{{ formatDate(post.created_at) }}</div>
              <p>{{ getExcerpt(post.content, 200) }}</p>
          </article>

          <button class="btn btn-primary mr-2" @click="getPosts(pagination.current - 1)" :disabled="pagination.current === 1">
              <i class="fas fa-arrow-left"></i>
          </button>

          <button class="btn mx-2" 
                    :class="pagination.current === i ? 'btn-primary' : 'btn-secondary'"
                    v-for="i in pagination.last" 
                    :key="`page-${i}`" 
                    @click="getPosts(i)">
              {{i}}
          </button>

          <button class="btn btn-primary ml-2" @click="getPosts(pagination.current + 1)" :disabled="pagination.current === pagination.last">
              <i class="fas fa-arrow-right"></i>
          </button>
      </div>
      
      <Loader v-else class="text-center"/>
  </div>
</template>

<script>
import axios from 'axios';
import Loader from '../components/Loader'

export default {
    name:'Blog',
    components: {
        Loader
    },
    data(){
        return {
            posts: null,
            pagination:null,
        }
    },
    created(){
        this.getPosts();
    },
    methods:{
        getPosts(page = 1){
            axios.get(`http://127.0.0.1:8000/api/posts?page=${page}`)
            .then(res=> {
                console.log(res);

                this.posts = res.data.data;
                this.pagination = {
                    current: res.data.current_page,
                    last: res.data.last_page,
                }
            })
        },
        getExcerpt(text, maxLength) {
            if(text.length > maxLength){
                return text.substr(0, maxLength) + '...';
            }
            return text;
        },
        formatDate(postDate){
            //console.log(postDate);
            const date = new Date(postDate);
            //console.log(date);

            const formatter = new Intl.DateTimeFormat('it-IT').format(date);
            return formatter;
        }
    }
}
</script>

<style lang="scss">
</style>