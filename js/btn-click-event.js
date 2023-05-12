function myFunction(value_myFunction) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { 
            document.getElementById("results").innerHTML += this.responseText;
        }
    };
    xmlhttp.open("GET", "../order-chart.php?sendValue=" + value_myFunction, true);
    xmlhttp.send();
}