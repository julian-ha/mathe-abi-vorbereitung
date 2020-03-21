function checktoken(){
    xmlhttp = new XMLHttpRequest();
  
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("test").innerHTML = this.responseText;
            if(token != this.responseText){
              window.location = 'https://www.mathe-abi-vorbereitung.de';
            }     
        }
      };
      xmlhttp.open('GET', "./gettoken.php?nutzer=test", true);
      xmlhttp.send();
      console.log('wurde getestet');
      setTimeout(testcall, 60000);
}

window.addEventListener("DOMContentLoaded", function() {
    checktoken();
}, false);