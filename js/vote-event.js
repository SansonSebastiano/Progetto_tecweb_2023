function vote(animal, voteType, clickedBtn) {
    let isClicked = (clickedBtn === "true"); 

    let xmlhttp = new XMLHttpRequest();
    let btnUpvote = document.getElementById("btn-exist");
    let btnDownvote = document.getElementById("btn-non-exist");

    if(isClicked){
        alert("Hai già votato!");
        btnUpvote.disabled = true;
        btnDownvote.disabled = true;
        return;
    }

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(voteType == 'upvote'){
                document.getElementById("exist-votes").innerHTML = this.responseText;
                btnUpvote.disabled = true;
                btnDownvote.disabled = true;

                alert("Grazie per aver votato!");
            } else {    // voteType == 'downvote'
                document.getElementById("non-exist-votes").innerHTML = this.responseText;
                btnUpvote.disabled = true;
                btnDownvote.disabled = true;    

                alert("Grazie per aver votato!");
            }
        }
    };

    xmlhttp.open("GET", "../vote-event.php?animale=" + animal + "&voteType=" + voteType, true);
    xmlhttp.send();
}