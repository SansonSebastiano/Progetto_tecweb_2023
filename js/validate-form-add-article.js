const submitForm = document.getElementById("submit-form")
const titleInput = document.getElementById("titolo")
const subTitleInput = document.getElementById("sottotitolo")
const placeInput = document.getElementById("luogo")
const animalInput = document.getElementById("creatura")
const textInput = document.getElementById("testo")
const imagePath = document.getElementById("image-path")

submitForm.addEventListener("submit", function(){ return validate()})
titleInput.addEventListener("blur", function(){
    if(checkLength("titolo","invalid-title",1,"Inserire un titolo per l'articolo")) {
        checkValidation("titolo","invalid-title",/^[\wèàìòéùç\s]*$/,"Il titolo dell'articolo non può contenere caratteri speciali")
    }
})
subTitleInput.addEventListener("blur", function(){
    checkLength("sottotitolo","invalid-subtitle",1,"Inserire un sottotitolo")
})
placeInput.addEventListener("blur", function(){
    checkLength("luogo","invalid-place",1,"Inserire un luogo")
})
animalInput.addEventListener("blur", function(){
    checkValidation("creatura","invalid-creature",/^[a-zA-Zèàìòéùç\s]*$/, "Il nome della creatura riferita dall'articolo non può contenere caratteri speciali")
})
textInput.addEventListener("blur", function(){
    checkLength("testo","invalid-text",20,"Il testo dell'articolo deve essere lungo almeno 20 caratteri")
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

function validate() {

    const titleBool = checkLength("titolo","invalid-title",1,"Inserire un titolo per l'articolo") && checkValidation("titolo","invalid-title",/^[\wèàìòéùç\s]*$/,"Il titolo dell'articolo non può contenere caratteri speciali");
    const subtitleBool = checkLength("sottotitolo","invalid-subtitle",1,"Inserire un sottotitolo");
    const placeBool = checkLength("luogo","invalid-place",1,"Inserire un luogo");
    const animalBool = checkValidation("creatura","invalid-creature",/^[a-zA-Zèàìòéùç\s]*$/,"Il nome della creatura riferita dall'articolo non può contenere caratteri speciali");
    const textBool = checkLength("testo","invalid-text",20,"Il testo dell'articolo deve essere lungo almeno 20 caratteri");
    const imageBool = isImageUploaded()

    return titleBool
        && subtitleBool
        && placeBool
        && animalBool
        && textBool
        && imageBool
}
