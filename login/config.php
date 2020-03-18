<?php
session_start();
$host = "188.68.47.203"; /* Host name */
$user = "k93814_matheAbi"; /* User */
$password = "Sxt0m25?"; /* Password */
$dbname = "k93814_matheAbi"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}