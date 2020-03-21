<?php
    session_start();

    $pdo = new PDO('mysql:host=188.68.47.203;dbname=k93814_matheAbi', 'k93814_matheAbi', 'Sxt0m25?');

    $sql = "SELECT token from user_token WHERE benutzername = :nutzer";
    $statement = $pdo->prepare($sql);
    $statement->execute(array('nutzer' => $_GET['nutzer']));
    $result = $statement->fetch();

    echo $result['token'];
?>