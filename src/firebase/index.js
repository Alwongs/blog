import { initializeApp } from "firebase/app";
import { getAuth } from 'firebase/auth'

const firebaseConfig = {
    apiKey: "AIzaSyACg5WrYn5MD-ckxl-Kgz7WekhALJ9xnh8",
    authDomain: "store-common.firebaseapp.com",
    databaseURL: "https://store-common-default-rtdb.firebaseio.com",
    projectId: "store-common",
    storageBucket: "store-common.appspot.com",
    messagingSenderId: "501631459011",
    appId: "1:501631459011:web:4342012cf5f1afa3094c76"
}

const app = initializeApp(firebaseConfig);

const auth = getAuth(app);

export { auth }