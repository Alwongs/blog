<template>
    <div class="post">
        <img 
            :src="require('../assets/img/jpg/first.jpg')" 
            alt="picture"
        >
        <article>
            <header>
                <h3>{{ post.title }}</h3>
            </header>
            <main>
                {{ post.body }}
            </main>
            <footer>
                <button class="btn-post">
                    Continue ->
                </button>
            </footer>
        </article>
    </div>
</template>

<script>
//import { ref } from 'vue'

export default {
    props: {
        post: {
            type: Object
        }
    },
}
</script>

<style lang="scss" scoped>

.post {
    display: flex;
    justify-content: space-between;
    height: 200px;
    width: 100%;
}
img {
    display: block;
    height: 100%;
    width: 300px;
}
article {
    color: grey;
    width: 500px;
    padding: 0 10px;
}
header {
    margin-bottom: 20px;
}
main {
    margin-bottom: 20px;
}
.btn-post {
    border: 2px solid lightgrey;
    border-radius: 15px;
    color: lightgrey;
    width: 200px;
    height: 32px;
}
</style>