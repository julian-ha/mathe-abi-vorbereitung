<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mathe-Abi-Vorbereitung</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css" />
    <link rel="stylesheet" href="../includes/style.css" />
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>

<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
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
                <a href="https://mathe-abi-vorbereitung.de/#tutor-info" class="navbar-item">
                    Dein Lehrer
                </a>
                <a href="https://mathe-abi-vorbereitung.de/#kurse-und-daten" class="navbar-item">
                    Kursdaten
                </a>
                <a href="https://mathe-abi-vorbereitung.de/#ablauf" class="navbar-item">
                    Kursdaten
                </a>
            </div>
        </div>
    </nav>

    <form action="login_script.php" method="POST">
        <section class="hero is-light is-fullheight">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title">
                        Melde dich an
                    </h1>
                    <h2 class="subtitle">
                        Gib nun einen Benutzernamen und ein Passwort ein
                    </h2>
                    <div class="columns">
                        <div class="column register-form">
                            <div class="field">
                                <label class="label">Benutzername</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input is-primary" type="text"
                                        placeholder="Gib deinen Benutzernamen ein" value="" name="benutzer" required />
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Passwort</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input is-primary" type="password" placeholder="Gib dein Passwort ein"
                                        value="" name="passwort" required />
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </div>
                                <br />

                            </div>
                            <?php if(isset($_SESSION['notification'])){
                                echo "<p>". $_SESSION['notification']. "</p>";
                                unset($_SESSION['notification']);
                            } ?>
                            <input class="button is-primary" type="submit" name="submit" value="Login">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="imprint">
            <section class="section">
                <div class="container">
                    <h3 class="title is-5 has-text-weight-bold">
                        Informationen
                    </h3>
                    <hr>
                    <ul>
                        <li><a href="https://mathe-abi-vorbereitung.de/impressum.html">Impressum</a></li>
                        <li><a
                                href="https://mathe-abi-vorbereitung.de/datenschutzerklaerung.html">Datenschutzerklärung</a>
                        </li>
                        <li><a href="https://augustin-heidenheim.de/">Über uns</a></li>
                        <li><a href="https://augustin-heidenheim.de/">Nachhilfe Schule</a></li>
                    </ul>

                </div>
            </section>
        </div>
    </form>






</body>

</html>