<?php 
session_start();

$pdo = new PDO('mysql:host=188.68.47.203;dbname=k93814_matheAbi', 'k93814_matheAbi', 'Sxt0m25?');


?>



<!DOCTYPE html> 
<html> 
<head>
  <title>Mathe Abi Vorbereitung</title>    
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
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }
    
   // Überprüfe, dass der Benutzername noch nicht registriert wurde
    if(!$error) { 
        $statement = $pdo->prepare("SELECT * FROM benutzer WHERE benutzername = :benutzername");
        $result = $statement->execute(array('benutzername' => $benutzername));
        $user = $statement->fetch();
        
        if($user !== false) {
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true;
        }    
    }
    
    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) {    
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        
        $statement = $pdo->prepare("INSERT INTO benutzer (mail, passwort, vorname, nachname, benutzername) VALUES (:email, :passwort, :vorname, :nachname, :benutzername)");
        $result = $statement->execute(array('email' => $_SESSION['email'], 'passwort' => $passwort_hash, 'vorname' => $_SESSION['vorname'], 'nachname' => $_SESSION['nachname'], 'benutzername' => $benutzername));
        
        if($result) {        
            echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    } 
}
 
if($showFormular) {
?>
 
<form action="?register=1" method="post">

Dein Benutzername: <br>
<input type="text" maxlength="250" name="benutzername" required>
 
Dein Passwort:<br>
<input type="password" size="40"  maxlength="250" name="passwort" required><br>
<input type="password" size="40" maxlength="250" name="passwort2" required><br>
 
<input type="submit" value="Abschicken">
</form>
 
<?php
} //Ende von if($showFormular)
?>
 
</body>
</html>