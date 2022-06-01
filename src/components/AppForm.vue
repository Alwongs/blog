<template>
    <div class="background-layer">
        <div class="modal-window" :class="{'wide-modal': title === 'Create post'}">
            <h3 class="close-modal-btn" @click="closeModal">x</h3>
            <form class="form" @submit.prevent="submitHandler">
                <h3 class="title">{{ title }}</h3>  
                <template v-if="['Register', 'Login'].includes(title)">              
                    <input
                        v-model="data.email"
                        type="email" 
                        placeholder="Email" 
                    />
                    <input 
                        v-model="data.password"             
                        type="password" 
                        placeholder="Password" 
                    />
                </template>     
                <template v-if="title === 'Create user details'">            
                    <input  
                        v-model="data.name"
                        type="text" 
                        placeholder="Введите имя"
                    />
                    <input 
                        v-model="data.surname"
                        type="text" 
                        placeholder="Введите фамилию" 
                    />
                    <input 
                        v-model="data.gender"
                        type="text" 
                        placeholder="Введите пол"  
                    />
                    <input                      
                        v-model="data.age"
                        type="text" 
                        placeholder="Введите возраст" 
                    /> 
                </template>    
                <template v-if="title === 'Create post'">            
                    <input 
                        v-model="data.title"                                       
                        type="text" 
                        placeholder="type title..."
                    />
                    <textarea
                        v-model="data.body"                 
                        name="" 
                        id="" 
                        cols="30" 
                        rows="10"
                        placeholder="type description..."                    
                    ></textarea> 
                    <input  
                        v-model="data.sign"                 
                        type="text" 
                        placeholder="type a sign..."                      
                    /> 
                </template>                                              
                <input 
                    type="submit" 
                    :value="buttonValue" 
                    class="button"
                />
            </form>
            <h4 class="footer-message">
                <span @click="goToPath">
                    {{ footerMessage }}
                </span>
            </h4>
        </div>
    </div>    
</template>

<script>
import { ref } from 'vue'

export default {
    props: [
        'title',
        'buttonValue',
        'footerMessage'
    ],
    setup(_, {emit}) {
        const data = ref({});
        const closeModal = () => emit('closeModal');
        const submitHandler = () => emit('submitHandler', data);
        const goToPath = () => emit('goToPath');
        return {
            data,
            closeModal,
            submitHandler,
            goToPath,
        }
    }
}
</script>

<style lang="scss" scoped>

.background-layer {
    background-color: rgba(9, 17, 8, 0.816);
    position: relative;
    height: 100%;
}
.modal-window {
    background-color: #fff;
    border-radius: 10px;
    position: absolute;
    width: 500px;    
    left: calc(50% - 250px);
    top: 30%;
    padding: 10px 20px;
    &.wide-modal {
        width: 800px;
        left: calc(50% - 400px);
    }
}
.close-modal-btn {
    font-size: 28px;
    text-align: right;
    color: grey;    
    cursor: pointer;
}
.title {
    color: grey;
    font-size: 22px;
    align-self: center;
    margin-bottom: 10px;
}
.form {
    display: flex;
    flex-direction: column;
}
input {
    font-size: 16px;
    border: none;
    border-bottom: 1px solid grey;
    height: 30px;
    margin: 10px;
}
.button {
    align-self: end;
    background-color: rgb(95, 151, 129);
    border-radius: 5px;
    height: 38px;
    width: 115px;
    color: white;
    cursor: pointer;
}
.footer-message {
    color: red;
    font-weight: 300;
    text-align: left;
    cursor: pointer;
}
</style>