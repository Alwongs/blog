<template>
    <div class="the-app">
        <app-header />
        <router-view/>
    </div>
</template>

<script>
import AppHeader from './components/AppHeader.vue'

export default {
    name: 'App',
    components: { AppHeader },
}
</script>

<style lang="scss">

.the-app {
    height: 100vh;
}
</style>
