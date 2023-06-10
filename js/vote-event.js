document.getElementById("btn-exist").addEventListener("click", function(){addVote("upvote")})
document.getElementById("btn-non-exist").addEventListener("click", function(){addVote("downvote")})

function addVote(voteType) {

    let matches = /animale=([^&#=]*)/.exec(window.location.search);
    let animalName = matches[1];

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

    xmlhttp.open("POST", "../add-vote.php", true);
    xmlhttp.send("animale=" + animalName + "&voteType=" + voteType);
}

function removeVote(animal, voteType) {
    let xmlhttp = new XMLHttpRequest();
    let btnRemoveVote = document.getElementById("btn-remove-vote");

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (voteType == 'yes') {
                document.getElementById("exist-votes").innerHTML = this.responseText;
            } else {
                document.getElementById("non-exist-votes").innerHTML = this.responseText;
            }
            btnRemoveVote.disabled = true;
            window.location.reload();
        }
    };
    xmlhttp.open("POST", "../remove-vote.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    xmlhttp.send("animale=" + animal + "&voteType=" + voteType);
}