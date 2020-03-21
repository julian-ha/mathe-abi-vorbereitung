<?php
    session_start();

    $nutzer = $_GET['nutzer'];

    $sql = "SELECT token from user_token WHERE benutzername = :nutzer";
    $statement = $pdo->prepare($sql);
    $statement->execute(array('nutzer' => $_GET['nutzer']));
    $result = $statement->fetch();

    echo $result['token'];
?>