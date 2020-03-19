<?php
session_start();
$error = false;
$pdo = new PDO('mysql:host=188.68.47.203;dbname=k93814_matheAbi', 'k93814_matheAbi', 'Sxt0m25?');

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['passwort'];

    //Überprüfung mit Datenbank
    $sql = "SELECT *, COUNT(*) as anzahl FROM benutzer WHERE mail = :email AND passwort = :passwort";
    $statement = $pdo->prepare($sql);
    $statement->execute(array('email' => $email, 'passwort' => $password));
    $user = $statement->fetch();

    echo $user['vorname'];
    echo $user['anzahl'];
    


}

?>