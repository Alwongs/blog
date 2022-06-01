<template>   
    <app-form 
        :title="'Register'"
        :buttonValue="'Save'"
        :footerMessage="'you already have account?'"
        id="register-page"        
        @closeModal="closeModal"
        @submitHandler="register"
        @goToPath="goToLogin"
    />
</template>

<script>
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'
import AppForm from '@/components/AppForm.vue'

export default {
    components: { AppForm },    
    setup() {
        const store = useStore();
        const router = useRouter();

        const closeModal = () => router.push('/');
        const register = (data) => store.dispatch('register', data.value);
        const goToLogin = () => router.push('/login');
        
        return {
            closeModal,
            register,
            goToLogin
        }
    }
}
</script>
