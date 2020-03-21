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
                <p><strong>Mathe-Abi-Vorbereitung</strong></p>
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
                        <a class="button is-light" href="/logout/">
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="info-section stream-container">
        <section class="section ">
            <div class="container has-text-centered is-centered">
                <h2 class="title is-4 has-text-weight-bold has-text-light">
                    Willkommen zur Mathe-Abi-Vorbereitung
                </h2>
                <p class="subtitle is-6 has-text-light">
                    Wir empfehlen dir den Stream auf Vollbild anzusehen: Doppelklick in
                    den Stream für Vollbild
                </p>
                <iframe id="ytplayer" type="text/html" width="100%" height="500"
                    src="https://www.youtube-nocookie.com/embed/OZjFVFW8UJY?&controls=0&rel=0&showinfo=0&modestbranding=1"
                    frameborder="0" allowfullscreen></iframe>
            </div>
        </section>
        <section class="section">
            <div class="container has-text-centered is-centered">
                <h2 class="title is-4 has-text-weight-bold has-text-light">
                    Zeit für deine Fragen
                </h2>
                <textarea name="" id="frage" cols="100" rows="10"></textarea>
                <br />
                <button class="button is-primary" onclick="sendMessage()"><strong>Absenden</strong></button>
            </div>
        </section>
    </div>
</body>

</html>