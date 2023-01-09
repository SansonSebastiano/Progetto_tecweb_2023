import { ref, animalsRef, getDownloadURL, uploadBytes} from './initDB.js';

// mockup
// function to upload file called by button
function uploadFile() {
    // get file from input
    let file = document.querySelector("#file").files[0];
    let fileName = file.name;

    // metadata
    const metadata = {
        contentType: file.type,
      };

    // create a reference to the file
    const fileRef = ref(animalsRef, fileName);

    uploadBytes(fileRef, file, metadata).then((snapshot) => {
        console.log(fileName  + ' uploaded');
    });
}

document.getElementById('upload').addEventListener('click', uploadFile);

