<?php
session_start();

$colors = ['', 'is-primary', 'is-success', 'is-dark', 'is-link', 'is-info', 'is-warning', 'is-danger'];
// Database Connection
$pdo = new PDO('mysql:host=188.68.47.203;dbname=k93814_matheAbi', 'k93814_matheAbi', 'Sxt0m25?');

$sql = "INSERT INTO nachrichten (benutzername, inhalt, farbe) VALUES( :nutzer, :inhalt, :farbe)";
$statement = $pdo->prepare($sql);
$statement->execute(array('nutzer' => $_GET['benutzername'], 'inhalt' => $_GET['inhalt'], 'farbe' => $colors[array_rand($colors)]));

echo "erfolgreich";

?>