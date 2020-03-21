<?php
session_start();

// Database Connection
$pdo = new PDO('mysql:host=188.68.47.203;dbname=k93814_matheAbi', 'k93814_matheAbi', 'Sxt0m25?');

$benutzername = $_SESSION['benutzername'];
$_SESSION['token'];

// wenn nicht eingeloggt, dann auf Startseite weiterleiten
    if(!isset($_SESSION['isloggedin'])){
        session_destroy();
        header('Location: https://www.mathe-abi-vorbereitung.de');
    }
    else{
        // Auto Log-out bei mehrfachem login

        $sql = "SELECT token FROM user_token WHERE benutzername = :benutzer";
        $statement = $pdo->prepare($sql);
        $statement->execute(array('benutzer' => $_SESSION['benutzername']));
        $token = $statement->fetch();

        echo "Token aus der Datenbank: " . $token['token'] . "<br>";
        echo "Token aus der Session: " . $_SESSION['token'] . "<br>";
    }





?>