import {ref, animalsRef, uploadBytes, getDownloadURL} from './init-db.js';



function uploadFile(e) {
    
    e.preventDefault();
    
    let file = document.querySelector("#image").files[0];
    let hidden = document.querySelector("#image-path");
    let status = document.getElementById("loaded-photo");
    let strong = status.getElementsByTagName("strong").item(0);
    
    const metadata = {
        contentType: file.type,
    };
    
    if(file == undefined){
        status.classList.remove("success")
        status.classList.add("error")
        strong.innerHTML = "Inserire un'immagine della creatura";
        return;
    }
    
    if(file.size >= 1000000){
        status.classList.remove("success")
        status.classList.add("error")
        strong.innerHTML = "L'immagine &egrave; troppo grande, il massimo &egrave; 1MB";
        return;
    }
    
    const fileRef = ref(animalsRef, file.name);

    
    uploadBytes(fileRef, file, metadata).then((snapshot) => {
        console.log(file.name  + ' uploaded');
        return getDownloadURL(snapshot.ref);
    }).then((url) => {
        hidden.value = url;
        strong.innerHTML = "Foto caricata con successo";
        status.classList.remove("error")
        status.classList.add("success")

    });
}

document.getElementById('btn-load').addEventListener('click', uploadFile);
