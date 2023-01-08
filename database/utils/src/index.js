// import config.js
import { firebaseConfig } from './config.js';

import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js';
import { getStorage, ref, getDownloadURL } from 'https://www.gstatic.com/firebasejs/9.15.0/firebase-storage.js';


const app = initializeApp(firebaseConfig);

// Initialize Cloud Storage and get a reference to the service
const defaultStorage = getStorage(app);
const storageRef = ref(defaultStorage);

// Create a child reference
// animalsRef now points to 'images/animals'
const animalsRef = ref(storageRef, 'images/animals');

// articlesRef now points to 'images/articles'
const articlesRef = ref(storageRef, 'images/articles');

let img = document.getElementById('img');

const cpRef = ref(animalsRef, 'chupacabra.jpg');

getDownloadURL(cpRef).then((url) => {
    console.log(url);
    img.src = url;
}).catch((error) => {
    console.log(error);
});
