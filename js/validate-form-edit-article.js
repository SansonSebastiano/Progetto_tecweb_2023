const submitForm = document.getElementById("submit-form")
const textInput = document.getElementById("testo")

submitForm.addEventListener("submit", function(){ return validate()})
textInput.addEventListener("blur", function(){
    checkLength("testo","invalid-text",20,"Il testo dell'articolo deve essere lungo almeno 20 caratteri")
})

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

function validate() {

    return checkLength("testo","invalid-text",20,"Il testo dell'articolo deve essere lungo almeno 20 caratteri")
    
}
