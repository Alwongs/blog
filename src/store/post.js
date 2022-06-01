import { getDatabase, set, ref, child, get } from "firebase/database";

export default {
    getters: {
        postList(state)  {
            return state.postList;
        },
        getPost(state)  {
            return state.post;
        },
    },
    state: {
        postList: [],
        post: {}
    },
    mutations: {
        UPDATE_POST_LIST(state, payload) {
            state.postList = payload
        }
    },
    actions: {
        async getPostList({ commit, getters }) {
            const dbRef = ref(getDatabase()); 
            const userId = getters.getUser.uid;
            await get(child(dbRef, `users/${userId}/posts`)).then((data) => {
                if (data.exists()) {
                    console.log(data.val());
                    commit('UPDATE_POST_LIST', data.val())
                } else {
                    alert("No data available");
                }
            }).catch((error) => {
                console.error(error);
            });
        },
        async createPost({ getters}, {title, body, sign}) {           
            const db = getDatabase();                
            const uid = getters.getUser.uid;
            const postId = Date.now()

            set(ref(db, 'users/' + uid + '/posts/' + postId), {
                title: title,
                body: body,
                sign: sign
            })
            .then(() => {
                alert('Success!')
            })
            .catch((error) => {
                alert('fail!' + error)
            })
        }
    }
}
