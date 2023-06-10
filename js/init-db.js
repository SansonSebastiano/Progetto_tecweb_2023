import { firebaseConfig } from './firebase-config.js';

import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js';
import { getStorage, ref, getDownloadURL, uploadBytes } from 'https://www.gstatic.com/firebasejs/9.15.0/firebase-storage.js';

const app = initializeApp(firebaseConfig);

const defaultStorage = getStorage(app);

const storageRef = ref(defaultStorage);

const animalsRef = ref(storageRef, 'images/animals');

const articlesRef = ref(storageRef, 'images/articles');

export { ref, defaultStorage, animalsRef, articlesRef, getDownloadURL, uploadBytes };
