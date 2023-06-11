const exist = document.getElementById("exist-votes")
const nonExist = document.getElementById("non-exist-votes")
const coloredVoteArea = document.getElementById("colored-vote-area")

document.body.addEventListener("load", getVotes())

function getVotes(){
    
    let existVotes = parseInt(exist.dataset.value)
    let nonExistVotes = parseInt(nonExist.dataset.value)
    let totalVotes = existVotes + nonExistVotes
    
    let percExist = Math.round((existVotes/totalVotes) * 100)
    let _percExist = percExist + 1;
    let percNonExist = 100 - percExist;


    exist.innerHTML = existVotes + " (" + percExist + "%)"
    nonExist.innerHTML = nonExistVotes + " (" + percNonExist + "%)"

    coloredVoteArea.style.background = "linear-gradient(to right, green, green " + percExist + "%, red " + _percExist + "%,red)"
    
}