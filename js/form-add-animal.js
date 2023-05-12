const invalidAnimalName = document.getElementById("invalid-animal-name")
const animalInput = document.getElementById("name")

animalInput.addEventListener("blur", checkAnimalName)

var date = new Date();
var currentDate = date.toISOString().substring(0,10);
document.getElementById('data_scrittura').value = currentDate;

function checkAnimalName(e){
    console.log(e.target.value)
    if(!(/^[A-Za-z\s]*$/.test(e.target.value))){
        invalidAnimalName.innerHTML = "Il nome dell animale può contenere solo lettere o spazi"
    }
    else{
        invalidAnimalName.innerHTML = ""
    }
}

