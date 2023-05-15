
const titleInput = document.getElementById("titolo");
const invalidTitle = document.getElementById("invalid-title");
const subTitleInput = document.getElementById("sottotitolo");
const placeInput = document.getElementById("luogo");
const animalInput = document.getElementById("creatura");
const textInput = document.getElementById("testo");

const submitForm = document.getElementById("submit-form")
const imagePath = document.getElementById("image-path")

titleInput.addEventListener("blur", checkValidation("titolo","invalid-title",/^[a-zA-Z_\s]{1,}$/, "Il titolo dell'articolo non può essere vuoto e può contenere solo lettere o spazi"))
subTitleInput.addEventListener("blur", checkValidation("sottotitolo","invalid-subtitle",/^[a-zA-Z_\s]{1,}$/, "Il sottotitolo dell'articolo non può essere vuoto e può contenere solo lettere o spazi"))
placeInput.addEventListener("blur", checkValidation("luogo","invalid-place",/^[a-zA-Z_\s]{1,}$/, "Il luogo dell'articolo non può essere vuoto e può contenere solo lettere o spazi"))
animalInput.addEventListener("blur", checkValidation("creatura","invalid-creature",/^[a-zA-Z_\s]{1,}$/, "Il nome dell'animmale riferito dall'articolo non può essere vuoto e può contenere solo lettere o spazi"))
textInput.addEventListener("blur", checkValidation("testo","invalid-text",/^[\w\d]{20,}$/, "Il testo dell'articolo deve contenere almeno 20 caratteri"))

submitForm.addEventListener("submit", function(){ return validate()})

function checkValidation(input,output,regex,errorText){
    const inputHTML = document.getElementById(input)
    const outputHTML = document.getElementById(output)
    if(!(regex.test(inputHTML.value))){
        outputHTML.innerHTML = errorText
        return false
    }   
    else{
        outputHTML.innerHTML = ""
        return true
    }
}

function isImageUploaded(){
    const status = document.getElementById("loaded-photo")
    if(imagePath.value == ""){
        status.innerHTML = "Non è stata caricata nessuna immagine";
        status.classList.add("error")
        status.classList.remove("success")
        return false
    }
    else{
        status.classList.remove("error")
        status.classList.add("success")
        return true
    }
}


function setText(id, text){
    document.getElementById(id).innerHTML = text
}

 function setCurrentDate(){
     var date = new Date();
     var currentDate = date.toISOString().substring(0,10);
     document.getElementById('data-scrittura').value = currentDate;
 }

function validate() {
    setCurrentDate()

    return checkValidation("titolo","invalid-title",/^[\w\s]*$/, "Il titolo dell'articolo può contenere solo lettere o spazi") 
        && checkValidation("sottotitolo","invalid-subtitle",/^[\w\s]*$/, "Il sottotitolo dell'articolo può contenere solo lettere o spazi") 
        && isImageUploaded() 
}

