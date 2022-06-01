<template>
    <post-item 
        v-for="post in postList"
        :key="post.id"
        :post="post"
        class="post"
    />
</template>

<script>
import { onBeforeMount } from 'vue'
//import { useRouter } from 'vue-router'
import { useStore } from 'vuex'
import { computed } from 'vue'
import PostItem from '@/components/PostItem.vue'

export default {
    components: { PostItem },    
    setup() {
        /*
        const posts = [
            {
                id: 1,
                title: 'Fox',
                description: "This is a softy fox. It's orange. You will defenetly like it.",
                img: 'first.jpg',
            },
            {
                id: 2,
                title: 'White rabbit',
                description: "You can't go away from that cuty baby. I t will be your favourtie pillow in a bed",
                img: 'second.jpg',
            },
            {
                id: 3,
                title: 'Bear',
                description: 'Kind frendly bear is the best frend for little people',
                img: 'third.jpg',
            },
        ];
        */
      
        //const router = useRouter();
        const store = useStore();

        //const goTo = (path) => router.push(path)

        const getPostListHandler = async () => {
            await store.dispatch('getPostList');
        }


        onBeforeMount(() => {
            getPostListHandler();
        });

        return {
            postList: computed(() => store.getters.postList),
            //getUser: computed(() => store.getters.getUser),
            //goTo
        }
    }
}
</script>

<style>
.post {
    margin-bottom: 90px;
}
</style>