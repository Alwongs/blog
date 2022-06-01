import { createRouter, createWebHistory } from "vue-router";
import { auth } from "../firebase";
import HomePage from '../views/HomePage'
import UserPage from '../views/UserPage'
import Register from '../views/form-pages/Register'
import Login from '../views/form-pages/Login'
import CreateUser from '../views/form-pages/CreateUser'
import CreatePost from '../views/form-pages/CreatePost'
import NotFound from '../views/NotFound'

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home-page',
            component: HomePage,   
        },
        {
            path: '/user-page',
            name: 'user-page',
            component: UserPage,   
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
        },
        {
            path: '/create-post',
            name: 'create-post',
            component: CreatePost,
            meta: {
                requiresAuth: true
            }             
        },
        {
            path: '/create-user',
            name: 'create-user',
            component: CreateUser,             
        },
        { 
            path: '/:pathMatch(.*)*', 
            name: 'NotFound', 
            component: NotFound 
        },       
    ]
})

router.beforeEach((to, from, next) => {
    if (to.path === 'login' && auth.currentUser) {
        next('/');
        return;
    }
    if (to.matched.some(record => record.meta.requiresAuth) && !auth.currentUser) {
        next('/login');
        return;
    }
    next();
})

export default router;
