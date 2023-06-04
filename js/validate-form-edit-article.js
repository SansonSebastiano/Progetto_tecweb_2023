const submitForm = document.getElementById("submit-form")
const textInput = document.getElementById("testo")

textInput.addEventListener("blur", function(){
    checkLength("testo","invalid-text",20,2000,"Il testo dell'articolo deve essere lungo almeno 20 caratteri", "Il testo dell'articolo non può essere più lungo di 2000 caratteri")
})

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

function validate() {

    return checkLength("testo","invalid-text",20,"Il testo dell'articolo deve essere lungo almeno 20 caratteri")
    
}
