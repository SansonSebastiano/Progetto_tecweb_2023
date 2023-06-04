const submitForm = document.getElementById("submit-form")
const titleInput = document.getElementById("titolo")
const subTitleInput = document.getElementById("sottotitolo")
const placeInput = document.getElementById("luogo")
const animalInput = document.getElementById("creatura")
const textInput = document.getElementById("testo")
const imagePath = document.getElementById("image-path")

titleInput.addEventListener("blur", function(){
    if(checkLength("titolo","invalid-title",1,255,"Inserire un titolo per l'articolo", "Il titolo dell'articolo non può essere più lungo di 255 caratteri")) {
        checkValidation("titolo","invalid-title",/^[\wèàìòéùç\s]*$/,"Il titolo dell'articolo non può contenere caratteri speciali")
    }
})
subTitleInput.addEventListener("blur", function(){
    checkLength("sottotitolo","invalid-subtitle",1,255,"Inserire un sottotitolo","Il sottotitolo dell'articolo non può essere più lungo di 255 caratteri")
})
placeInput.addEventListener("blur", function(){
    checkLength("luogo","invalid-place",1,255,"Inserire un luogo", "Il luogo dell'articolo non può essere più lungo di 255 caratteri")
})
animalInput.addEventListener("blur", function(){
    checkValidation("creatura","invalid-creature",/^[a-zA-Zèàìòéùç\s]*$/, "Il nome della creatura riferita dall'articolo non può contenere caratteri speciali")
})
textInput.addEventListener("blur", function(){
    checkLength("testo","invalid-text",20,2000,"Il testo dell'articolo deve essere lungo almeno 20 caratteri", "Il testo dell'articolo non può essere più lungo di 2000 caratteri")
})

function checkValidation(input,output,regex,errorText){
    const inputHTML = document.getElementById(input)
    const outputHTML = document.getElementById(output)

    if(regex != "" && !(regex.test(inputHTML.value))){
        outputHTML.innerHTML = errorText
        return false
    }

    outputHTML.innerHTML = ""
    return true
    
}

function checkLength(input,output,minLength,maxLength,noValueText,tooLongText){
    const inputHTML = document.getElementById(input)
    const outputHTML = document.getElementById(output)

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
    if(imagePath.value == ""){
        status.innerHTML = "Inserire un immagine dell'articolo";
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

function validate() {

    const titleBool = checkLength("titolo","invalid-title",1,255,"Inserire un titolo per l'articolo", "Il titolo dell'articolo non può essere più lungo di 255 caratteri") && checkValidation("titolo","invalid-title",/^[\wèàìòéùç\s]*$/,"Il titolo dell'articolo non può contenere caratteri speciali");
    const subtitleBool = checkLength("sottotitolo","invalid-subtitle",1,255,"Inserire un sottotitolo","Il sottotitolo dell'articolo non può essere più lungo di 255 caratteri");
    const placeBool = checkLength("luogo","invalid-place",1,255,"Inserire un luogo", "Il luogo dell'articolo non può essere più lungo di 255 caratteri");
    const animalBool = checkValidation("creatura","invalid-creature",/^[a-zA-Zèàìòéùç\s]*$/,"Il nome della creatura riferita dall'articolo non può contenere caratteri speciali");
    const textBool = checkLength("testo","invalid-text",20,2000,"Il testo dell'articolo deve essere lungo almeno 20 caratteri", "Il testo dell'articolo non può essere più lungo di 2000 caratteri");
    const imageBool = isImageUploaded()

    return titleBool
        && subtitleBool
        && placeBool
        && animalBool
        && textBool
        && imageBool
}
