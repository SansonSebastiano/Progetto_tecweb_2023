const replyBtns = Array.from(document.querySelectorAll(".btn-reply"));

console.log(replyBtns);

replyBtns.forEach(btn => {
    btn.addEventListener("click", function(){
        btn.style.display = "none";
        btn.nextElementSibling.getElementsByClassName("btn-send")[0].style.display = "inline";
        btn.nextElementSibling.getElementsByClassName("textreply")[0].style.display = "inline";
    })
})