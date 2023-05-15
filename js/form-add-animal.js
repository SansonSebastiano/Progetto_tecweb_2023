
const animalStatus = document.getElementById("animal-status")
const dateInput = document.getElementById("data-scoperta")
const animalInput = document.getElementById("name")
const descriptionInput = document.getElementById("description")

const submitForm = document.getElementById("submit-form")
const imagePath = document.getElementById("image-path")

//Aggiunge gli event listener ai campi del form, che vengono chiamati quando si perde il focus
animalInput.addEventListener("blur", checkValidation("name","invalid-animal-name",/^[a-zA-Z_\s]{1,}$/, "Il nome dell'animale non può contenere caratteri speciali"))
animalStatus.addEventListener("blur", setText("invalid-status",""))
descriptionInput.addEventListener("blur", checkValidation("description","description-too-short",/^[\w\d]{20,}$/, "La descrizione deve contenere almeno 20 caratteri"))
dateInput.addEventListener("blur", checkValidation("data-scoperta","invalid-date",/\d{4}\-\d{2}\-\d{2}/, "La data non è nel formato corretto"))
submitForm.addEventListener("submit",function(){return validate()})

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

//Controlla se è stata caricata un'immagine su firebase
//Il trucco è che se è stata caricata, il campo imagePath.value non è vuoto
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

//Funzione che viene chiamata quando si preme il pulsante di submit del form
function validate() {
    return checkValidation("name","invalid-animal-name",/^[\w\s]*$/) 
        && checkValidation("description","description-too-short",/^[\w\d]{5,}$/) 
        && checkValidation("data-scoperta","invalid-date",/\d{4}\-\d{2}\-\d{2}/) 
        && isImageUploaded() 
}
