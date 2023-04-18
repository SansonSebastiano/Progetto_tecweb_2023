// import firebase-config.js
import { firebaseConfig } from './firebase-config.js';

import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js';
import { getStorage, ref, getDownloadURL, uploadBytes } from 'https://www.gstatic.com/firebasejs/9.15.0/firebase-storage.js';


const app = initializeApp(firebaseConfig);

// Initialize Cloud Storage and get a reference to the service
const defaultStorage = getStorage(app);
const storageRef = ref(defaultStorage);

// Create a child reference
// animalsRef now points to 'images/animals'
const animalsRef = ref(storageRef, 'images/animals');

// articlesRef now points to 'images/articles'
const articlesRef = ref(storageRef, 'images/articles');

export { ref, defaultStorage, animalsRef, articlesRef, getDownloadURL, uploadBytes };