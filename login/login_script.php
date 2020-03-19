<?php
session_start();
$error = false;
$pdo = new PDO('mysql:host=188.68.47.203;dbname=k93814_matheAbi', 'k93814_matheAbi', 'Sxt0m25?');

if(isset($_POST['submit'])){
    $benutzername = $_POST['benutzer'];
    $password = $_POST['passwort'];

    //Überprüfung mit Datenbank
    $sql = "SELECT * FROM benutzer WHERE benutzername = :nutzer";
    $statement = $pdo->prepare($sql);
    $statement->execute(array('nutzer' => $benutzername));
    $user = $statement->fetch();

    if ($user !== false && password_verify($password, $user['passwort'])) {
        $_SESSION['user'] = $user['benutzername'];
        $_SESSION['isloggedin'] = true;
        
        
    } else {
        $error = true;
        $_SESSION['notification'] = "Es wurde kein Benutzer zu den eingegebenen Daten gefunden.";
        echo "falsche Eingaben";
        header('Location: https://mathe-abi-vorbereitung.de/login/');
    }

   

    



?>