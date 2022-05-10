function loadDoc() {

    setInterval(function(){

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            document.getElementById("unchecked").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "src/load/php/check.php", true);
        xhttp.send();

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            document.getElementById("unverified").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "src/load/php/verify.php", true);
        xhttp.send();

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            document.getElementById("billed").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "src/load/php/billed.php", true);
        xhttp.send();

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            document.getElementById("after_veri").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "src/load/php/after_veri.php", true);
        xhttp.send();

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            document.getElementById("veri_rate").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "src/load/php/veri_rate.php", true);
        xhttp.send();
    },1000);

}
loadDoc();