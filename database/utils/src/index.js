// test 
import { ref, animalsRef ,getDownloadURL} from './initDB.js';

let img = document.getElementById('img');

const cpRef = ref(animalsRef, 'chupacabra.jpg');

getDownloadURL(cpRef).then((url) => {
    console.log(url);
    img.src = url;
}).catch((error) => {
    console.log(error);
});
