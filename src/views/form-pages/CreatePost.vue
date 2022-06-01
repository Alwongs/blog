<template>
    <app-form 
        :title="'Create post'"
        :buttonValue="'Save'"
        id="create-post-page"        
        @closeModal="closeModal"
        @submitHandler="createPostHandler"
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

        const createPostHandler = async (data) => {
            try {
                await store.dispatch('createPost', data.value);
                closeModal();
            } catch (e) {
                console.log('ошибка: ' + e);
            }
        }
        const closeModal = () => router.push('/');        

        return {
            createPostHandler,
            closeModal            
        }
    }
}
</script>
