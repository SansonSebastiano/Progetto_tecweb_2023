import { ref, defaultStorage, getDownloadURL} from './initDB.js';

// TODO: get url of animal's image from db sql

// this current url is a test url
let url = "https://firebasestorage.googleapis.com/v0/b/elusive-6b545.appspot.com/o/images%2Fanimals%2Fchupacabra.jpg?alt=media&token=62851388-eece-4d6e-822a-33e661d0092e";

// get image element
let img = document.querySelector("#img");

// create reference to the file from url
const httpsReference = ref(defaultStorage, url); 

getDownloadURL(httpsReference).then((url) => {
    console.log(url);
    img.src = url;
}).catch((error) => {
    console.log(error);
});

// TODO: for the article it is analogous