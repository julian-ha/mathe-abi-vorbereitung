<?php 
session_start();

$pdo = new PDO('mysql:host=188.68.47.203;dbname=k93814_matheAbi', 'k93814_matheAbi', 'Sxt0m25?');


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

    <?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll
 
if(isset($_GET['register'])) {
    $error = false;
    //$email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];
    $benutzername = $_POST['benutzername'];

  

  
    // if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
    //     $error = true;
    // }     
    // if(strlen($passwort) == 0) {
    //     echo 'Bitte ein Passwort angeben<br>';
    //     $error = true;
    // }
    if($passwort != $passwort2) {
        //echo 'Die Passwörter müssen übereinstimmen<br>';
        $_SESSION['fehler'] = "Die Passwörter müssen übereinstimmen";
        $error = true;
    }
    
   // Überprüfe, dass der Benutzername noch nicht registriert wurde
    if(!$error) { 
        $statement = $pdo->prepare("SELECT * FROM benutzer WHERE benutzername = :benutzername");
        $result = $statement->execute(array('benutzername' => $benutzername));
        $user = $statement->fetch();
        
        if($user !== false) {
            //echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $_SESSION['fehler'] = "Dieser Benutzername ist bereits vergeben";
            $error = true;
        }    
    }
    
    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) {    
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        
        $statement = $pdo->prepare("INSERT INTO benutzer (mail, passwort, vorname, nachname, benutzername) VALUES (:email, :passwort, :vorname, :nachname, :benutzername)");
        $result = $statement->execute(array('email' => $_SESSION['email'], 'passwort' => $passwort_hash, 'vorname' => $_SESSION['vorname'], 'nachname' => $_SESSION['nachname'], 'benutzername' => $benutzername));
        
        if($result) {        
            //echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
            $_SESSION['fehler'] = "Du wurdest erfolreich registriert";

            //Email mit den Daten versenden
            $empfaenger = $_SESSION['email'];
            $betreff = "Zugangsdaten Mathe Abi Vorbereitung";
            $from = "From: Mathe Abi Vorbereitung <noreply@mathe-abi-vorbereitung.de>";
            $text = "Hallo " . $_SESSION['vorname']. ", 
            Vielen Dank für die Registrierung bei Mathe-Abi-Vorbereitung.de
            Hier sind deine Zugangsdaten um alle Vorteile der Plattform nutzen zu können.
            
            benutzername: " . $benutzername ."
            Passwort: " . $passwort . "
            
            Viel Spaß und ganz viel Erfolg bei deinem Abitur,
            Dein Mathe Abi Vorbereitungs Team";
            
            mail($empfaenger, $betreff, $text, $from);

            //hier ist die Weiterleitung auf die nächste Seite
            header("Location: https://mathe-abi-vorbereitung.de/");
            $showFormular = false;
        } else {
            //echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
            $_SESSION['fehler'] = "Beim Abspeichern ist leider ein Fehler aufgetreten";
        }
    } 
}
 
if($showFormular) {
?>

    <form action="?register=1" method="post">

        <section class="hero is-light is-fullheight">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title">
                        Dein Kauf war erfolgreich
                    </h1>
                    <h2 class="subtitle">
                        Gib nun einen Benutzernamen und ein Passwort ein. <br> <span class="subtitle is-7">Wir senden
                            dir eine E-Mail mit
                            deinems
                            Passwort
                            und deinem Benutzernamen.</span>
                    </h2>

                    <div class="columns">
                        <div class="column register-form">
                            <div class="field">
                                <label class="label">Benutzername</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input is-primary" type="text" placeholder="Wähle einen Benutzernamen"
                                        value="" maxlength="250" name="benutzername" required />
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Passwort</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input is-primary" type="password" placeholder="Wähle ein Passswort"
                                        value="" maxlength="250" name="passwort" required />
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-key"></i> </span>
                                </div>
                                <br />
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input is-primary" type="password"
                                        placeholder="Bestätige dein Passswort" value="" maxlength="250" name="passwort2"
                                        required />
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-key"></i>
                                    </span>
                                </div>
                            </div>
                            <p class="subtitle is-7">Die Abbuchung erfolgt durch Digistore24</p>




                            <?php
if(isset($_SESSION['fehler'])){
    echo "<p>" . $_SESSION['fehler'] . "</p>";
    unset($_SESSION['fehler']);
}
?>

                            <input class="button is-primary" type="submit" value="<strong>Weiter</strong>">
    </form>
    <br>
    <p>Du wirst danach direkt auf die Stream Seite geleitet. <br> Du kannst dir diese gern als Favorit
        in
        deinem Browser speichern</p>
    <a href="#imprint">Impressum / Datenschutz</a>
    </div>
    </div>
    </div>
    </div>
    </section>
    <div class="imprint" id="imprint">
        <section class="section">
            <div class="container">
                <h3 class="title is-5 has-text-weight-bold">
                    Informationen
                </h3>
                <hr>
                <ul>
                    <li><a href="https://mathe-abi-vorbereitung.de/impressum.html">Impressum</a></li>
                    <li><a href="https://mathe-abi-vorbereitung.de/datenschutzerklaerung.html">Datenschutzerklärung</a>
                    </li>
                    <li><a href="https://augustin-heidenheim.de/">Über uns</a></li>
                    <li><a href="https://augustin-heidenheim.de/">Nachhilfe Schule</a></li>
                </ul>

            </div>
        </section>
    </div>

    <?php
} //Ende von if($showFormular)
?>

</body>

</html>