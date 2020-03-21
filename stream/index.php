<?php
session_start();
include('../settings/login_control.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mathe-Abi-Vorbereitung</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css"
    />
    <link rel="stylesheet" href="includes/style.css" />
    <script
      defer
      src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"
    ></script>
    <link rel="stylesheet" href="../includes/style.css" />
  </head>
  <body>
    <div class="info-section">
      <section class="section">
        <div class="container has-text-centered is-centered">
          <h2 class="title is-3 has-text-weight-bold">
            Willkommen zum Stream
          </h2>
          <iframe
            id="ytplayer"
            type="text/html"
            width="640"
            height="360"
            src="https://www.youtube-nocookie.com/embed/OZjFVFW8UJY?&controls=0&rel=0&showinfo=0&modestbranding=1"
            frameborder="0"
            allowfullscreen
          ></iframe>
        </div>
      </section>
    </div>


    <section class="section">
      <div class="container">
        <div class="columns">
          <div class="column is-full">
            <button class="button is-primary" onclick="testcall()">Testbutton</button>
            <h4 id="test">asdfasdf</h4>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>

<script>
function testcall(){
  xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("test").innerHTML = this.responseText;
      }
    };

    xmlhttp.open('GET', "gettoken.php?nutzer=test", true);
    xmlhttp.send();
}
</script>
