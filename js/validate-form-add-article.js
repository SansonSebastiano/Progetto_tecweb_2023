
const titleInput = document.getElementById("titolo");
const invalidTitle = document.getElementById("invalid-title");
const subTitleInput = document.getElementById("sottotitolo");
const placeInput = document.getElementById("luogo");
const animalInput = document.getElementById("creatura");
const textInput = document.getElementById("testo");
const tagInput = document.getElementById("tag");

const submitForm = document.getElementById("submit-form")
const imagePath = document.getElementById("image-path")

submitForm.addEventListener("submit", function(){ return validate()})

function checkValidation(input,output,regex,noValueText,errorText){
    const inputHTML = document.getElementById(input)
    const outputHTML = document.getElementById(output)

    if(!noValueText == "" && inputHTML.value == ""){
        outputHTML.innerHTML = noValueText
        return false
    }
    if(regex != "" && !(regex.test(inputHTML.value))){
        outputHTML.innerHTML = errorText
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

function setText(id, text){
    document.getElementById(id).innerHTML = text
}

function validate() {

    return checkValidation("titolo","invalid-title",/^[\wèàìòéùç\s]*$/,"Inserire un titolo per l'articolo","Il titolo dell'articolo non può contenere caratteri speciali")
        && checkValidation("sottotitolo","invalid-subtitle","","Inserire un sottotitolo","")
        && checkValidation("creatura","invalid-creature",/^[a-zA-Z_èàìòéùç\s]*$/,"Inserire un nome per l'animale riferito dall'articolo", "Il nome dell'animmale riferito dall'articolo non può contenere caratteri speciali")
        && checkValidation("testo","invalid-text",/^[\S\s]{20,}$/,"","Il testo dell'articolo deve essere lungo almeno 20 caratteri")
        && isImageUploaded() 
}

