import { getDatabase, set, ref, child, get } from "firebase/database";

export default {
    getters: {
        getUserDetails(state)  {
            return state.userDetails;
        }
    },
    state: {
        userDetails: {}
    },
    mutations: {
        UPDATE_USER_DETAILS(state, payload) {
            state.userDetails = payload
        }
    },
    actions: {
        async createUserDetails({ getters }, {name, surname, gender, age}) {           
            const db = getDatabase();                
            const userId = getters.getUser.uid;

            set(ref(db, 'users/' + userId + '/user-details'), {
                name: name,
                surname: surname,
                gender: gender,
                age: age
            })
            .then(() => {
                alert('Success!')
            })
            .catch((error) => {
                alert('fail!' + error)
            })
        },

        async getUserDetails({ commit, getters }) {
            const dbRef = ref(getDatabase()); 
            const userId = getters.getUser.uid;
            await get(child(dbRef, `users/${userId}/user-details`)).then((data) => {
                if (data.exists()) {
                    console.log(data.val());
                    commit('UPDATE_USER_DETAILS', data.val())
                } else {
                    console.log("No data available");
                }
            }).catch((error) => {
                console.error(error);
            });
        }
    }
}
