import { createStore } from 'vuex'
import user from './user'
import post from './post'
import userDetails from './userDetails'

export default createStore({
    modules: {
        user,
        post,
        userDetails
    },
});
