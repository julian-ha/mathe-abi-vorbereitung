<?php
session_start();
$error = false;
$pdo = new PDO('mysql:host=188.68.47.203;dbname=k93814_matheAbi', 'k93814_matheAbi', 'Sxt0m25?');

if(isset($_POST['submit'])){
    $benutzername = $_POST['benutzer'];
    $password = $_POST['passwort'];

    //Überprüfung mit Datenbank
    $sql = "SELECT *, COUNT(*) as anzahl FROM benutzer WHERE benutzername = :nutzer AND passwort = :passwort";
    $statement = $pdo->prepare($sql);
    $statement->execute(array('nutzer' => $email, 'passwort' => $password));
    $user = $statement->fetch();

    echo $user['vorname'];
    echo $user['anzahl'];
    


}

?>