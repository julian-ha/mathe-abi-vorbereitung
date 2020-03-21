function checktoken(){
    xmlhttp = new XMLHttpRequest();
  
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("test").innerHTML = this.responseText;
        }
      };
  
      xmlhttp.open('GET', "../gettoken.php?nutzer=test", true);
      xmlhttp.send();
  }