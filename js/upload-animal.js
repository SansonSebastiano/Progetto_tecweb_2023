import { ref, animalsRef, uploadBytes, getDownloadURL} from './init-db.js';

// PRE: web page with input image file and button (maybe change with submit button)
// function to upload file called by button
function uploadFile(e) {
    //rimuove la reazione base del form così da non sovrascrivere l'upload
    e.preventDefault();
    // get file from input with id=#file
    let file = document.querySelector("#image").files[0];
    let hidden = document.querySelector("#image-path");
    let status = document.getElementById("loaded-photo")
        // set metadata for the file
    const metadata = {
        contentType: file.type,
      };
    
    console.log(file.size);
    if(file.size >= 1000000){
        status.classList.remove("success")
        status.classList.add("error")
        status.innerHTML = "L'immagine è troppo grande, massimo 1MB";
        return;
    }
    // create a reference to the file
    const fileRef = ref(animalsRef, file.name);

    // upload file
    uploadBytes(fileRef, file, metadata).then((snapshot) => {
        console.log(file.name  + ' uploaded');
        return getDownloadURL(snapshot.ref);
    }).then((url) => {
        hidden.value = url;
        status.innerHTML = "Foto caricata con successo";
        status.classList.remove("error")
        status.classList.add("success")

    });
    document.getElementById("btn-submit").style.visibility="visible";
}
// POST: file uploaded to firebase storage

// add event listener to button with id=#load
document.getElementById('btn-load').addEventListener('click', uploadFile);
