function checktoken(){
    xmlhttp = new XMLHttpRequest();
    console.log("Nutzer ist eingeloggt: " + benutzername);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(token != this.responseText){
                sendNotification("Ein anderer Benutzer hat sich mit ihren Daten eingeloggt. Sie werden ausgeloggt");
                setTimeout(() => { window.location = 'https://www.mathe-abi-vorbereitung.de';   }, 10000);
                      
            }     
        }
      };
      xmlhttp.open('GET', "../settings/gettoken.php?nutzer=" + benutzername, true);
      xmlhttp.send();
      console.log('wurde getestet');
      setTimeout(checktoken, 10000);
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
            var message = "Ihre Nachricht wurde erfolgreich versandt";
            inhalt.value = "";
            sendNotification(message);   
        }
       
    };
    xmlhttp.open('GET', "../settings/send_message.php?benutzername=" + benutzername + "&inhalt=" + inhalt.value);
    xmlhttp.send();
}

function sendNotification(message){
    var myToast = Toastify({
        text: message,
        duration: 5000
       })
   myToast.showToast();
}

