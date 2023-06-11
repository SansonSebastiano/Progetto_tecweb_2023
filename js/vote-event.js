document.getElementById("btn-exist").addEventListener("click", function(){addVote("upvote")})
document.getElementById("btn-non-exist").addEventListener("click", function(){addVote("downvote")})
document.getElementById("btn-remove-vote").addEventListener("click", function(){removeVote()})

function addVote(voteType) {

    const matches = /animale=([^&#=]*)/.exec(window.location.search);
    const animalName = matches[1];

    let xmlhttp = new XMLHttpRequest();
    let btnUpvote = document.getElementById("btn-exist");
    let btnDownvote = document.getElementById("btn-non-exist");
    
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(voteType == 'upvote'){
                document.getElementById("exist-votes").innerHTML = this.responseText; 
            } else {    
                document.getElementById("non-exist-votes").innerHTML = this.responseText;
            }
            btnUpvote.disabled = true;
            btnDownvote.disabled = true;
            window.location.reload();
        }
    };

    xmlhttp.open("GET", "../add-vote.php?animale=" + animalName + "&voteType=" + voteType, true);
    xmlhttp.send();
}

function removeVote() {
    const matches = /animale=([^&#=]*)/.exec(window.location.search);
    const animalName = matches[1];

    const voteString = document.getElementById("msg-vote");
    let xmlhttp = new XMLHttpRequest();
    let btnRemoveVote = document.getElementById("btn-remove-vote");

    const voteType = voteString.getElementsByClassName("green").length > 0 ? "upvote" : "downvote";
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (voteType == "upvote") {
                document.getElementById("exist-votes").innerHTML = this.responseText;
            } else {
                document.getElementById("non-exist-votes").innerHTML = this.responseText;
            }
            btnRemoveVote.disabled = true;
            window.location.reload();
        }
    };
    xmlhttp.open("GET", "../remove-vote.php?animale=" + animalName, true);
    xmlhttp.send();
}