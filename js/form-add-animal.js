const invalidAnimalName = document.getElementById("invalid-animal-name")
const descriptionTooShort = document.getElementById("description-too-short")
const animalInput = document.getElementById("name")
const descriptionInput = document.getElementById("description")
const submitForm = document.getElementById("submit-form")
const imagePath = document.getElementById("image-path")

animalInput.addEventListener("blur", checkAnimalName)
descriptionInput.addEventListener("blur", checkDescriptionLength)
submitForm.addEventListener("submit", validate)

function checkAnimalName(){
    if(!(/^[A-Za-z\s]*$/.test(animalInput.value))){
        invalidAnimalName.innerHTML = "Il nome dell animale può contenere solo lettere o spazi"
        return false
    }
    else{
        invalidAnimalName.innerHTML = ""
        return true
    }
}

function isImageUploaded(){
    const status = document.getElementById("loaded-photo")
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
    const description = document.getElementById("description")
    if(description.value.length < 20){
        descriptionTooShort.innerHTML = "La descrizione deve essere lunga almeno 20 caratteri"
        return false
    }
    else{
        descriptionTooShort.innerHTML = ""
        return true
    }
}

function validate() {
    setCurrentDate()
    return checkAnimalName() && isImageUploaded() && checkDescriptionLength()
}

// function setCurrentDate(){
//     var date = new Date();
//     var currentDate = date.toISOString().substring(0,10);
//     document.getElementById('data_scrittura').value = currentDate;
// }