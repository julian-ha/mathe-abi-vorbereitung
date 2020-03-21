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

    //generieren des Session Tokens
    if(!$error){
        //token
        $token = getToken(10);
       
        
        //SQL
        $sql = "SELECT * FROM user_token WHERE benutzername = :nutzer";
        $statement = $pdo->prepare($sql);
        $statement->execute(array('nutzer' => $benutzername));
        $token_result = $statement->fetch();

        if($token_result !== false){
            //update
            $sql_token = "UPDATE user_token SET token = :tok WHERE benutzername = :nutzer";
            $statement = $pdo->prepare($sql_token);
            $statement->execute(array('tok' => $token, 'nutzer' => $benutzername));

        }else{
            //Insert
            $sql_token = "INSERT INTO user_token (user_id, benutzername, token) VALUES (:id, :nutzer, :tok)";
            $statement = $pdo->prepare($sql_token);
            $statement->execute(array('tok' => $token, 'nutzer' => $benutzername, 'id' => $user['id']));
        }

        $_SESSION['token'] = $token;
        $_SESSION['benutzername'] = $benutzername;
        $_SESSION['isloggedin'] = true;
        header('Location: https://mathe-abi-vorbereitung.de/stream/');

    }

}

// Generate token
function getToken($length){
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited
   
    for ($i=0; $i < $length; $i++) {
     $token .= $codeAlphabet[random_int(0, $max-1)];
    }
   
    return $token;
   }



?>