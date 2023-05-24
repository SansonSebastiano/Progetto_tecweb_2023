const animalStatus = document.getElementById("status")
const dateInput = document.getElementById("data-scoperta")
const animalInput = document.getElementById("name")
const descriptionInput = document.getElementById("description")

const submitForm = document.getElementById("submit-form")
const imagePath = document.getElementById("image-path")

//Aggiunge gli event listener ai campi del form, che vengono chiamati quando si perde il focus
submitForm.addEventListener("submit",function(){return validate()})

function checkValidation(input,output,regex,noValueText,errorText){
    const inputHTML = document.getElementById(input)
    const outputHTML = document.getElementById(output)

    if(!noValueText == "" && inputHTML.value == ""){
        outputHTML.innerHTML = noValueText
        return false
    }
    if(!(regex.test(inputHTML.value))){
        outputHTML.innerHTML = errorText
        return false
    }

    outputHTML.innerHTML = ""
    return true
    
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

    status.classList.remove("error")
    status.classList.add("success")
    return true
}


function setText(id, text){
    document.getElementById(id).innerHTML = text
}

//Funzione che viene chiamata quando si preme il pulsante di submit del form
function validate() {
    return checkValidation("name","invalid-animal-name",/^[a-zA-Zèàìòéùç\s]*$/, "Inserire un nome per l'animale","Il nome dell'animale non può contenere caratteri speciali")
        && checkValidation("description","description-too-short",/^[\S\s]{20,}$/,"","La descrizione deve essere lunga almeno 20 caratteri") 
        && checkValidation("data-scoperta","invalid-date",/\d{4}\-\d{2}\-\d{2}/,"Inserire una data","La data non è nel formato corretto")
        && isImageUploaded() 
}
