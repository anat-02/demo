function showList(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("complaint-table").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "server.php?q=cl", true);
    xmlhttp.send();
}