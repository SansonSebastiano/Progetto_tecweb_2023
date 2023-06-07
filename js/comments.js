const replyBtns = Array.from(document.querySelectorAll(".btn-reply"));

console.log(replyBtns);

replyBtns.forEach(btn => {
    btn.addEventListener("click", function(){
        btn.classList.toggle("hidden")
        btn.nextElementSibling.classList.toggle("hidden")
    })
})