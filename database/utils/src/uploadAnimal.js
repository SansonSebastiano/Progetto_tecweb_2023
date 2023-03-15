import { ref, animalsRef, uploadBytes} from './initDB.js';

// PRE: web page with input image file and button (maybe change with submit button)
// function to upload file called by button
function uploadFile() {
    // get file from input with id=#file
    let file = document.querySelector("#file").files[0];

    // set metadata for the file
    const metadata = {
        contentType: file.type,
      };

    // create a reference to the file
    const fileRef = ref(animalsRef, file.name);

    // get message element
    let msg = document.querySelector("#upMsg");

    // upload file
    uploadBytes(fileRef, file, metadata).then((snapshot) => {
        console.log(file.name  + ' uploaded');
        // show message
        msg.innerHTML = file.name + ' uploaded';
    });
}
// POST: file uploaded to firebase storage

// add event listener to button with id=#upload
document.getElementById('upload').addEventListener('click', uploadFile);

// TODO: for the article it is analogous