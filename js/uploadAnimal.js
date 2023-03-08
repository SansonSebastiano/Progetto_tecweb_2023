import { ref, animalsRef, uploadBytes} from './initDB.js';

// PRE: web page with input image file and button (maybe change with submit button)
// function to upload file called by button
function uploadFile(e) {
    //rimuove la reazione base del form così da non sovrascrivere l'upload
    e.preventDefault();
    // get file from input with id=#file
    let file = document.querySelector("#immagine").files[0];

    // set metadata for the file
    const metadata = {
        contentType: file.type,
      };

    // create a reference to the file
    const fileRef = ref(animalsRef, file.name);

    // upload file
    uploadBytes(fileRef, file, metadata).then((snapshot) => {
        console.log(file.name  + ' uploaded');
    });

}
// POST: file uploaded to firebase storage

// add event listener to button with id=#submit
document.getElementById('submit').addEventListener('submit', uploadFile);
//document.getElementById('form-aggiunta-animale').addEventListener("submit", uploadFile);