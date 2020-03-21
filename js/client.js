function checktoken(){
    xmlhttp = new XMLHttpRequest();
    console.log("Nutzer ist eingeloggt: " + benutzername);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(token != this.responseText){
              window.location = 'https://www.mathe-abi-vorbereitung.de';
            }     
        }
      };
      xmlhttp.open('GET', "../settings/gettoken.php?nutzer=test", true);
      xmlhttp.send();
      console.log('wurde getestet');
      setTimeout(checktoken, 60000);
}

window.addEventListener("DOMContentLoaded", function() {
    checktoken();
}, false);

function sendMessage(){
    var inhalt = document.getElementById('frage').value;
    console.log('Message wird gesendet');
    xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };
    xmlhttp.open('GET', "../settings/send_message.php?benutzername=" + benutzername + "&inhalt=" + inhalt);
}