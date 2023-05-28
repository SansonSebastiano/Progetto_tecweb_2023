const animalStatus = document.getElementById("status")
const dateInput = document.getElementById("data-scoperta")
const animalInput = document.getElementById("name")
const descriptionInput = document.getElementById("description")

const submitForm = document.getElementById("submit-form")
const imagePath = document.getElementById("image-path")

//Aggiunge gli event listener ai campi del form, che vengono chiamati quando si perde il focus
submitForm.addEventListener("submit",function(){return validate()})
dateInput.addEventListener("blur",function(){
    checkLength("data-scoperta","invalid-date",1,"Inserire una data")
    checkValidation("data-scoperta","invalid-date",/\d{4}\-\d{2}\-\d{2}/,"La data non è nel formato corretto")
})
animalInput.addEventListener("blur",function(){
    checkLength("name","invalid-animal-name",1,"Inserire un nome per la creatura")
    checkValidation("name","invalid-animal-name",/^[a-zA-Zèàìòéùç\s]*$/,"Il nome della creatura non può contenere caratteri speciali")
})
descriptionInput.addEventListener("blur",function(){checkLength("description","description-too-short",20,"La descrizione deve essere lunga almeno 20 caratteri")})

function checkValidation(input,output,regex,errorText){
    const inputHTML = document.getElementById(input)
    const outputHTML = document.getElementById(output)

    if(!(regex.test(inputHTML.value))){
        outputHTML.innerHTML = errorText
        return false
    }

    outputHTML.innerHTML = ""
    return true
    
}

function checkLength(input,output,minLength,noValueText){
    const inputHTML = document.getElementById(input)
    const outputHTML = document.getElementById(output)

    if(inputHTML.value.length < minLength){
        outputHTML.innerHTML = noValueText
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
    return checkLength("data-scoperta","invalid-date",1,"Inserire una data")
        && checkValidation("data-scoperta","invalid-date",/\d{4}\-\d{2}\-\d{2}/,"Inserire una data","La data non è nel formato corretto")
        && checkLength("name","invalid-animal-name",1,"Inserire un nome per la creatura")
        && checkValidation("name","invalid-animal-name",/^[a-zA-Zèàìòéùç\s]*$/, "Inserire un nome per l'animale","Il nome dell'animale non può contenere caratteri speciali")
        && checkLength("description","description-too-short",20,"La descrizione deve essere lunga almeno 20 caratteri")
        && isImageUploaded() 
}