const submitForm = document.getElementById("submit-form")
const imagePath = document.getElementById("image-path")
const dateInput = document.getElementById("date")
const animalInput = document.getElementById("name")
const descriptionInput = document.getElementById("description")

submitForm.addEventListener("submit",function(){
    return validate()
})

dateInput.addEventListener("blur",function(){
    if(checkLength("date","invalid-date",1,999,"Inserire una data","")){
        checkValidation("date","invalid-date",/^\d{4}-\d{2}-\d{2}$/,"La data non è nel formato corretto")
    }
})
animalInput.addEventListener("blur",function(){
    if(checkLength("name","invalid-animal-name",1,100,"Inserire un nome per la creatura", "Il nome della creatura non può essere più lungo di 100 caratteri")) {
        checkValidation("name","invalid-animal-name",/^[a-zA-Zèàìòéùç\s]*$/,"Il nome della creatura non può contenere caratteri speciali")
    }
})
descriptionInput.addEventListener("blur",function(){
    checkLength("description","description-too-short",20,2000,"La descrizione deve essere lunga almeno 20 caratteri", "La descrizione non può essere più lunga di 2000 caratteri")})


function checkValidation(input,output,regex,errorText){
    const inputHTML = document.getElementById(input)
    const outputHTML = document.getElementById(output).getElementsByTagName("strong").item(0)

    if(!(regex.test(inputHTML.value))){
        outputHTML.innerHTML = errorText
        return false
    }

    outputHTML.innerHTML = ""
    return true
    
}

function checkLength(input,output,minLength,maxLength,noValueText,tooLongText){
    const inputHTML = document.getElementById(input)
    const outputHTML = document.getElementById(output).getElementsByTagName("strong").item(0)

    if(inputHTML.value.length < minLength){
        outputHTML.innerHTML = noValueText
        return false
    }
    else if(inputHTML.value.length > maxLength){
        outputHTML.innerHTML = tooLongText
        return false
    }

    outputHTML.innerHTML = ""
    return true
}



function isImageUploaded(){
    const status = document.getElementById("loaded-photo")
    const strong = status.getElementsByTagName("strong").item(0)
    if(imagePath.value == ""){
        strong.innerHTML = "Non è stata caricata nessuna immagine";

        status.classList.add("error")
        status.classList.remove("success")
        return false
    }

    status.classList.remove("error")
    status.classList.add("success")
    return true
}


function validate() {

    const dateBool = checkLength("date","invalid-date",1,999,"Inserire una data","") && checkValidation("date","invalid-date",/^\d{4}-\d{2}-\d{2}$/,"La data non è nel formato corretto")
    const nameBool = checkLength("name","invalid-animal-name",1,100,"Inserire un nome per la creatura", "Il nome della creatura non può essere più lungo di 100 caratteri") && checkValidation("name","invalid-animal-name",/^[a-zA-Zèàìòéùç\s]*$/,"Il nome della creatura non può contenere caratteri speciali")
    const descriptionBool = checkLength("description","description-too-short",20,2000,"La descrizione deve essere lunga almeno 20 caratteri", "La descrizione non può essere più lunga di 2000 caratteri")
    const imageBool = isImageUploaded()

    return dateBool
        && nameBool
        && descriptionBool
        && imageBool
}