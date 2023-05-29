const exist = document.getElementById("exist-votes")
const nonExist = document.getElementById("non-exist-votes")
const coloredVoteArea = document.getElementById("colored-vote-area")

document.body.addEventListener("load", getVotes())

/*
    Ottiene i valori di data-value per i voti, poi aggiorna l'HTML
*/
function getVotes(){
    
    let existVotes = parseInt(exist.dataset.value)
    let nonExistVotes = parseInt(nonExist.dataset.value)
    let totalVotes = existVotes + nonExistVotes
    
    let percExist = Math.round((existVotes/totalVotes) * 100)
    let percNonExist = Math.round((nonExistVotes/totalVotes) * 100);


    exist.innerHTML = existVotes + " (" + percExist + "%)"
    nonExist.innerHTML = nonExistVotes + " (" + percNonExist + "%)"

    let existGradientPerc = percExist < 10 ? 0 : percExist - 10
    let nonExistGradientPerc = percNonExist > 90 ? 100 : percExist + 10
    coloredVoteArea.style.background = "linear-gradient(to right, #00FF00 " + existGradientPerc + "%, #FF0000 " + nonExistGradientPerc + "%)"
    
}