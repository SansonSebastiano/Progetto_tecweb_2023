document.getElementById("btn-exist").addEventListener("click", function(){vote("upvote")})
document.getElementById("btn-non-exist").addEventListener("click", function(){vote("downvote")})

function vote(voteType) {

    let matches = /animale=([^&#=]*)/.exec(window.location.search);
    let animalName = matches[1];

    let xmlhttp = new XMLHttpRequest();
    let btnUpvote = document.getElementById("btn-exist");
    let btnDownvote = document.getElementById("btn-non-exist");

    
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(voteType == 'upvote'){
                document.getElementById("exist-votes").innerHTML = this.responseText;
                btnUpvote.disabled = true;
                btnDownvote.disabled = true;
            } else {    // voteType = 'downvote'
                document.getElementById("non-exist-votes").innerHTML = this.responseText;
                btnUpvote.disabled = true;
                btnDownvote.disabled = true;    
            }
            window.location.reload();
        }
    };

    xmlhttp.open("POST", "../vote-event.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    xmlhttp.send("animale=" + animalName + "&voteType=" + voteType);
}