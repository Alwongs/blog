<template>
    <div class="home-page container">
        <p 
            class="add-link"
            @click="showCreatePost"
        >
            Add new post
        </p>
        <post-list />
    </div>
</template>

<script>
import PostList from '../components/PostList.vue'
import { useRouter } from 'vue-router'

export default {
    components: { PostList },
    setup() {
        const router = useRouter();

        const showCreatePost = () => router.push('/create-post');

        return {
            showCreatePost
        }
    }
}
</script>

<style lang="scss" scoped>

.post {
    margin-bottom: 90px;
}
</style>