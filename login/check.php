<?php
session_start();
if(isset($_SESSION['fehlermeldung'])){
    unset($_SESSION['fehlermeldung']);
}
include "config.php";
echo "Test";
if(isset($_POST['submit'])){

echo "Test";
 $email = mysqli_real_escape_string($con,$_POST['email']);
 echo $email . "<br>";
 $password = mysqli_real_escape_string($con,$_POST['passwort']);
 echo $password . "<br>";

 if ($email != "" && $password != ""){

  $sql_query = "select id, count(*) as cntUser from benutzer where mail='".$email."' and passwort='".$password."' GROUP BY id";
  $result = mysqli_query($con,$sql_query);
  $row = mysqli_fetch_array($result);

  $count = $row['cntUser'];
  echo $count;
  $user_id = $row['id'];

  if($count > 0){
   $token = getToken(10);
   $_SESSION['user_mail'] = $email;
   $_SESSION['user_token'] = $token;
   $_SESSION['userid'] = $user_id;

   // Update user token 
   $result_token = mysqli_query($con, "select count(*) as allcount from user_token WHERE user_id = '".$user_id."'");
   $row_token = mysqli_fetch_assoc($result_token);
   if($row_token['allcount'] > 0){
    mysqli_query($con,"update user_token set token='".$token."' where user_id='".$user_id."'");
   }else{
    mysqli_query($con,"insert into user_token(user_id,token) values('".$user_id."','".$token."')");
   }
   header('Location: https://www.google.com/');
  }else{
    $_SESSION['fehlermeldung'] = "Login Fehlerhaft";
    header('Location: https://mathe-abi-vorbereitung.de/login/');
  }

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