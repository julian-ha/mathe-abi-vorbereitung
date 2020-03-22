<?php 

//Database connection
$pdo = new PDO('mysql:host=188.68.47.203;dbname=k93814_matheAbi', 'k93814_matheAbi', 'Sxt0m25?');

//get all messages
$sql= "SELECT * FROM nachrichten ORDER BY zeitstempel DESC";
$statement = $pdo->prepare($sql);
$statement->execute();
$messages = $statement->fetchAll();

foreach($messages as $message){
    echo $message['inhalt'] . "<br>";
    echo $message['benutzername'] . "<br>";
}
?>