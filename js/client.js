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
      xmlhttp.open('GET', "../settings/gettoken.php?nutzer=" + benutzername, true);
      xmlhttp.send();
      console.log('wurde getestet');
      setTimeout(checktoken, 60000);
}

window.addEventListener("DOMContentLoaded", function() {
    checktoken();
}, false);

function sendMessage(){
    var inhalt = document.getElementById('frage');
    console.log(inhalt);
    console.log('Message wird gesendet');
    xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            var color = "is-primary";
            var message = "Ihre Nachricht wurde erfolgreich versandt";
            sendNotification(color, message);
            console.log(this.responseText);
            inhalt.value = "";
        }else {
            var color = "is-danger";
            var message = "Beim versenden ihrer Nachricht ist ein Fehler aufgetreten";
            sendNotification(color, message);
        }
    };
    xmlhttp.open('GET', "../settings/send_message.php?benutzername=" + benutzername + "&inhalt=" + inhalt.value);
    xmlhttp.send();
}

function sendNotification(color, message){
    //hinzufügen der Klasse um die Notification anzuzeigen

    //5sek warten

    //Klasse wieder entfernen

}