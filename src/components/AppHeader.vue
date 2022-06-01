<template>
    <header class="the-header">
        <div 
            class="logo"
            @click="goTo('/')"
        >
            <h2>Blog</h2>
        </div>
        <div class="link">
            <span 
                v-if="$store.getters.getUser"
                @click="goTo('/user-page')"
            >
                {{ $store.getters.getUser.email }}
            </span>
            <a 
                v-if="!$store.getters.getUser" 
                href="#" 
                @click="goTo('/login')"
            >
                Login
            </a> 
            <a 
                v-if="$store.getters.getUser" 
                href="#" 
                @click="logOutHandler"
            >
                Log out
            </a> 
            <a 
                v-if="!$store.getters.getUser" 
                href="#" 
                @click="goTo('/register')"
            >
                Register
            </a> 
        </div>
    </header>
</template>

<script>
import { onBeforeMount } from 'vue'
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'

export default {
    setup() {
        const store = useStore();
        const router = useRouter();

        const logOutHandler = () => store.dispatch('logout');
        const goTo = (path) => router.push(path);

        onBeforeMount(() => {
            store.dispatch('fetchUser')
        });

        return {
            store,
            logOutHandler,
            goTo,
        }
    },
}
</script>

<style lang="scss" scoped>
.logo {
    cursor: pointer;
}
h2 {
    color: rgb(40, 76, 40)
}
.the-header {
    background-color: rgb(222, 221, 221);
    display: flex;
    justify-content: space-between;
    height: 50px;
    
    .link, .logo {
        padding: 10px;
    }
    a {
        margin-right: 15px;

    }
}

span {
    font-weight: 700;
    color:green;
    margin-right: 10px;
    cursor: pointer;
}
</style>