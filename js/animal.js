const greenSpace = document.getElementById("green-space")
const redSpace = document.getElementById("red-space")

document.body.addEventListener("load",widthChangerDemo())

function widthChangerDemo(){
    greenSpace.style.width = "50%"
    redSpace.style.width = "50%"
}