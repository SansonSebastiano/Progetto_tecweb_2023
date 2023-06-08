function addVote(animal, voteType) {
    let xmlhttp = new XMLHttpRequest();
    let btnUpvote = document.getElementById("btn-exist");
    let btnDownvote = document.getElementById("btn-non-exist");

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(voteType == 'upvote'){
                document.getElementById("exist-votes").innerHTML = this.responseText; 
            } else {    // voteType = 'downvote'
                document.getElementById("non-exist-votes").innerHTML = this.responseText;
            }
            btnUpvote.disabled = true;
            btnDownvote.disabled = true;
            window.location.reload();
        }
    };

    xmlhttp.open("GET", "../add-vote.php?animale=" + animal + "&voteType=" + voteType, true);
    xmlhttp.send();
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
    xmlhttp.open("GET", "../remove-vote.php?animale=" + animal + "&voteType=" + voteType, true);
    xmlhttp.send();
}