<?php
session_start();
// Database Connection
$pdo = new PDO('mysql:host=188.68.47.203;dbname=k93814_matheAbi', 'k93814_matheAbi', 'Sxt0m25?');

$sql = "INSERT INTO nachrichten (benutzername, inhalt) VALUES( :nutzer, :inhalt)";
$statement = $pdo->prepare($sql);
$statement->execute(array('nutzer' => $_GET['benutzername'], 'inhalt' => $_GET['inhalt']));

echo "erfolgreich";

?>