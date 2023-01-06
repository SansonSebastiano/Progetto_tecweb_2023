const total = document.getElementById("total-votes")
const exist = document.getElementById("exist-votes")
const nonExist = document.getElementById("non-exist-votes")

document.body.addEventListener("load",getVotes())

/*
    Ottiene i valori di data-value per i voti, poi aggiorna l'HTML
*/

function getVotes(){
    
    let totalVotes = parseInt(total.dataset.value)
    let existVotes = parseInt(exist.dataset.value)
    let nonExistVotes = parseInt(nonExist.dataset.value)
    
    let percExist = Math.round((existVotes/totalVotes) * 100)
    let percNonExist = 100 - percExist;

    total.innerHTML = totalVotes
    exist.innerHTML = existVotes + " (" + percExist + "%)"
    nonExist.innerHTML = nonExistVotes + " (" + percNonExist + "%)"
    
}