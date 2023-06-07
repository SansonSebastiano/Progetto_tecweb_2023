const submitForm = document.getElementById("submit-form")
const titleInput = document.getElementById("titolo")
const subTitleInput = document.getElementById("sottotitolo")
const placeInput = document.getElementById("luogo")
const animalInput = document.getElementById("creatura")
const textInput = document.getElementById("testo")
const imagePath = document.getElementById("image-path")

submitForm.addEventListener("submit", function(){ return validate()})
titleInput.addEventListener("blur", function(){
    if(checkLength("titolo","invalid-title",1,"L'inserimento di un titolo per l'articolo è obbligatorio")) {
        checkValidation("titolo","invalid-title",/^[\wèàìòéùç\s]*$/,"Il titolo dell'articolo non può contenere caratteri speciali")
    }
})
subTitleInput.addEventListener("blur", function(){
    checkLength("sottotitolo","invalid-subtitle",1,"L'inserimento di un sottotitolo per l'articolo è obbligatorio")
})
placeInput.addEventListener("blur", function(){
    checkLength("luogo","invalid-place",1,"L'inserimento di un luogo è obbligatorio")
})
animalInput.addEventListener("blur", function(){
    checkValidation("creatura","invalid-creature",/^[a-zA-Zèàìòéùç\s]*$/, "Il nome della creatura riferita dall'articolo non può contenere caratteri speciali")
})
textInput.addEventListener("blur", function(){
    checkLength("testo","invalid-text",20,"Il testo dell'articolo deve essere lungo almeno 20 caratteri")
})

function checkValidation(input,output,regex,errorText){
    const inputHTML = document.getElementById(input)
    const outputHTML = document.getElementById(output).getElementsByTagName("strong").item(0)

    if(regex != "" && !(regex.test(inputHTML.value))){
        outputHTML.innerHTML = errorText
        return false
    }

    outputHTML.innerHTML = ""
    return true
    
}

function checkLength(input,output,minLength,noValueText){
    const inputHTML = document.getElementById(input)
    const outputHTML = document.getElementById(output).getElementsByTagName("strong").item(0)

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

const checkbox = document.getElementById("featured");

// check if the checkbox is focused
checkbox.addEventListener("focus", function() { 
    // check if enter key is pressed
    checkbox.addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            // check if the checkbox is checked
            if (checkbox.checked) {
                checkbox.checked = false;
                checkbox.dispatchEvent(new Event("change"));
            } else {
                checkbox.checked = true;
                checkbox.dispatchEvent(new Event("change"));
            }
        }
    });
});

// check if the checkbox is not focused
checkbox.addEventListener("blur", function() {
    checkbox.setAttribute("aria-label", "Seleziona se inserire l'articolo in evidenza");                
});

// check if the checkbox is checked
checkbox.addEventListener("change", function() {
    if (checkbox.checked) {
        checkbox.setAttribute("aria-label", "Articolo in evidenza selezionato");
    } else {
        checkbox.setAttribute("aria-label", "Articolo in evidenza deselezionato");
    }
});