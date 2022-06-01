<template>
    <app-form 
        :title="'Create user details'"
        :buttonValue="'Save'"
        id="create-user-details-page"        
        @closeModal="closeModal"
        @submitHandler="createUserHandler"
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

        const createUserHandler = async (data) => {
            try {
                await store.dispatch('createUserDetails', data.value);
                closeModal();
            } catch (e) {
                console.log('ошибка: ' + e);
            }
        }
        const closeModal = () => router.push('/');        

        return {
            createUserHandler,
            closeModal            
        }
    }
}
</script>
