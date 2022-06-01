<template>
    <div class="home-page container">
        <p 
            class="add-link"
            @click="goTo('create-user')"
        >
            Add details
        </p>
        <p v-if="getUser">
            email: <span>{{ getUser.email }}</span>
        </p>
        <div v-if="getDetails.name">
            <p>name: <span>{{ getDetails.name }}</span></p>
            <p>surname: <span>{{ getDetails.surname }}</span></p>
            <p>gender: <span>{{ getDetails.gender }}</span></p>
            <p>age: <span>{{ getDetails.age }}</span></p>
        </div>
    </div>  
</template>

<script>
import { onBeforeMount } from 'vue'
import { useRouter } from 'vue-router'
import { useStore } from 'vuex'
import { computed } from 'vue'

export default {
    setup() {
        const router = useRouter();
        const store = useStore();

        const goTo = (path) => router.push(path)

        const getUserDetailsHandler = async () => {
            await store.dispatch('getUserDetails');
        }


        onBeforeMount(() => {
            getUserDetailsHandler();
        });

        return {
            getDetails: computed(() => store.getters.getUserDetails),
            getUser: computed(() => store.getters.getUser),
            goTo
        }
    }
}
</script>

<style lang="scss" scoped>

h1 {
    text-align: center;
}
.add-link {
    margin-bottom: 90px;
    font-size: 20px;
    font-weight: 500;
    color: green;
    cursor: pointer;
    &:hover {        
        font-weight: 700;
        color: rgb(0, 170, 0);        
    }
}
span {
    color: blue;
}
</style>