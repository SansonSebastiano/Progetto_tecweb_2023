//OVERVIEW: Contiene le funzioni che validano i campi del form di aggiunta di un animale
const invalidAnimalName = document.getElementById("invalid-animal-name")
const invalidDate = document.getElementById("invalid-date")
const descriptionTooShort = document.getElementById("description-too-short")
const status = document.getElementById("loaded-photo")

const animalStatus = document.getElementById("animal-status")
const dateInput = document.getElementById("data-scoperta")
const animalInput = document.getElementById("name")
const descriptionInput = document.getElementById("description")

const submitForm = document.getElementById("submit-form")
const imagePath = document.getElementById("image-path")

//Aggiunge gli event listener ai campi del form, che vengono chiamati quando si perde il focus
animalInput.addEventListener("blur", checkAnimalName)
animalStatus.addEventListener("blur", setText("invalid-status",""))
descriptionInput.addEventListener("blur", checkDescriptionLength)
dateInput.addEventListener("blur", checkDate)
submitForm.addEventListener("submit", validate)

//Controlla se il nome dell'animale è valido (solo lettere e spazi)
function checkAnimalName(){
    if(!(/^[\w\s]*$/.test(animalInput.value))){
        invalidAnimalName.innerHTML = "Il nome dell animale può contenere solo lettere o spazi"
        return false
    }
    else{
        invalidAnimalName.innerHTML = ""
        return true
    }
}

//Controlla se è stata caricata un'immagine su firebase
//Il trucco è che se è stata caricata, il campo imagePath.value non è vuoto
function isImageUploaded(){
    console.log(imagePath.value)
    if(imagePath.value == ""){
        status.innerHTML = "Non è stata caricata nessuna immagine";
        status.style.color = "red";
        return false
    }
    else{
        return true
    }
}

//Questo è probabilmente ridondante
//Alcuni browser non supportano l'attributo minlength
function checkDescriptionLength(){
    if(descriptionInput.value.length < 20){
        descriptionTooShort.innerHTML = "La descrizione deve contenere almeno 20 caratteri"
        return false
    }
    else{
        descriptionTooShort.innerHTML = ""
        return true
    }
}


//La data deve essere nel formato yyyy-mm-dd
function checkDate(){
    if(!/\d{4}\-\d{2}\-\d{2}/.test(dateInput.value)){
        invalidDate.innerHTML = "La data non è nel formato corretto"
        return false
    }
    else{
        invalidDate.innerHTML = ""
        return true
    }
}

function setText(id, text){
    document.getElementById(id).innerHTML = text
}

//Funzione che viene chiamata quando si preme il pulsante di submit del form
function validate() {
    return checkAnimalName() 
        && isImageUploaded() 
        && checkDescriptionLength()
        && checkDate()
}

//Questa funzione non è necessaria qui ma nel form aggiunta articolo
// function setCurrentDate(){
//     var date = new Date();
//     var currentDate = date.toISOString().substring(0,10);
//     document.getElementById('data_scrittura').value = currentDate;
// }
