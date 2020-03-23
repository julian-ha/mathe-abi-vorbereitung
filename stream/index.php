<?php
session_start();
include('../settings/login_control.php'); 
?>
<!-- man muss immer den Token in die Variable laden-->
<script>
const token = "<?php echo $_SESSION['token'] ?>";
const benutzername = "<?php echo $_SESSION['benutzername'] ?>";
console.log(token);
console.log(benutzername);
</script>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mathe-Abi-Vorbereitung - STREAM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css" />
    <link rel="stylesheet" href="includes/style.css" />
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <link rel="stylesheet" href="../includes/style.css" />
    <script src="../js/client.js"></script>
</head>

<body>
    <nav class="navbar nav-black" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="https://mathe-abi-vorbereitung.de">
                <p class="color-red"><strong>Mathe-Abi-Vorbereitung</strong></p>
            </a>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
                data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <!-- <a href="https://mathe-abi-vorbereitung.de/" class="navbar-item">
            Startseite
          </a> -->
                <!-- <a
            href="https://mathe-abi-vorbereitung.de/#tutor-info"
            class="navbar-item"
          >
            Backup-Stream
          </a> -->
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-primary is-small is-rounded" href="/logout/">
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="message message1 message-none" id="notification">
      <article class="message" id="message">
        <div class="message-header">
          <p>Mathe-Abi-Vorbereitung.de</p>
          
        </div>
        <div class="message-body" id="mess-body">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        </div>
      </article>
    </div>
    


    <div class="info-section stream-container">
        <section class="section ">
            <div class="container">
                <h2 class="title is-3 has-text-weight-bold">
                    Willkommen zur Mathe-Abi-Vorbereitung
                </h2>
                <p class="subtitle is-6">
                    Wir bereiten dich auf das Abi vor!
                </p>

                <iframe src="https://player.vimeo.com/video/399397842" width="100%" height="500px" frameborder="0"
                    allow="autoplay; fullscreen" allowfullscreen></iframe>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column">
                        <h2 class="title is-4 has-text-weight-bold">
                            Zeit für deine Fragen
                        </h2>
                        <textarea class="textarea" name="" id="frage" cols="100" rows="10"
                            placeholder="Stell eine Frage..."></textarea>
                        <br />
                        <button class="button is-primary" onclick="sendMessage()">
                            <strong>Absenden</strong>
                        </button>
                    </div>
                    <div class="column">
                        <h2 class="title is-4 has-text-weight-bold">
                            Funktionen & Hilfe
                        </h2>
                        <ul>
                            <li class="">
                                Doppelklick auf Stream = Vollbild
                            </li>
                        </ul>
                        <p class="">
                            Solltest du Probleme mit dem Stream haben klicke hier:
                        </p>
                        <a class="has-text-primary"
                            href="https://docs.google.com/document/d/1EvLmFQNcrs60iSV2ffv93BOj43SDHgGpB2zDoObK2Rg/edit?usp=sharing">Ich
                            habe ein Problem mit dem Stream</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <h3 class="title is-4 has-text-weight-bold">
                    Natürlich kannst du uns auch eine Mail schreiben
                </h3>
                <a class="has-text-primary" href="">Neue Mail verfassen</a>
            </div>
        </section>
    </div>

    <div class="imprint">
        <section class="section">
            <div class="container">
                <h3 class="title is-5 has-text-weight-bold">
                    Informationen
                </h3>
                <hr />
                <ul>
                    <li>
                        <a class="has-text-primary"
                            href="https://mathe-abi-vorbereitung.de/impressum.html">Impressum</a>
                    </li>
                    <li>
                        <a class="has-text-primary"
                            href="https://mathe-abi-vorbereitung.de/datenschutzerklaerung.html">Datenschutzerklärung</a>
                    </li>
                    <li>
                        <a class="has-text-primary" href="https://augustin-heidenheim.de/">Über uns</a>
                    </li>
                    <li>
                        <a class="has-text-primary" href="https://augustin-heidenheim.de/">Nachhilfe Schule</a>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <script src="https://mathe-abi-vorbereitung.de/includes/navbar.js"></script>
</body>

</html>