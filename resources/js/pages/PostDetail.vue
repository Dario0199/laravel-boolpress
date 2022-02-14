<template>
    <section class="container">
        <div v-if="post">
            <h1>{{ post.title }}</h1>

            <h3 v-if="post.category">Category: {{ post.category.name }}</h3>
            <h3 v-else>Uncategorized</h3>

            <!-- <div class="mb-5">
                <span class="badge badge-primary mr-2" v-for="tag in post.tags" :key="`tag-${tag.id}`">
                    {{ tag.name }}
                </span>
            </div> -->
            <Tags class="mb-5" :list=" post.tags "/>

            <figure class="mb-5" v-if="post.cover">
                <img width="600" :src="post.cover" :alt="post.title">
            </figure>

            <p>{{ post.content }}</p>
        </div>
        <Loader  text="Loading Post..." v-else class="text-center"/>
    </section>
</template>

<script>
import axios from 'axios';
import Tags from '../components/Tags';
import Loader from '../components/Loader';

export default {
    name: 'PostDetail',
    components: {
        Tags,
        Loader,
    },
    data() {
        return {
            post: null,
        }
    },
    created(){
        this.getPostDetail()
    },
    methods: {
        getPostDetail(){
            axios.get(`http://127.0.0.1:8000/api/posts/${this.$route.params.slug}`)
                .then(res => {
                    console.log(res.data);
                    if(res.data.not_found){
                        console.log('error 404');
                        this.$router.push({ name: 'not-found' })
                    }else{
                        this.post = res.data;
                    }
                    
                })
                .catch(err=> log.error(err));
            

        }
    }
}
</script>

<style>

</style>