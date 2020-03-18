<?php 
session_start();
$pdo = new PDO('mysql:host=188.68.47.203;dbname=k93814_matheAbi', 'k93814_matheAbi', 'Sxt0m25?');

//Daten aus dem Header müssen noch encryptet werden. 
require('encrypt.php');

$querystring = 'order_id=848RCXR3&order_item_id=ds247ae61d484890a74bcb8bd22f5c1646a5-Z3U3ZXFadEg3OTQ4UFErZUZUbW9ZUT09&order_language=ds242bfde3c64f58c719c083adc0e6819a05-bkNIM2hXVG5DSGdLMUgzVmlpWHRtZz09&buyer_email=ds24fd8102faf4eeee5c9a2a70d2dff0ce36-VFN1L3ZvV290SDZ5RGpoNXRQNzl1OE1XMUdhR05EOFpXdFp3Zzh4empHQT0_e&payplan_id=ds2423be8af695370fdbd6b05108c6bc69a6-L285MVl2V3ZhUXJLT1phZGZ0MS82UT09&product_id=ds249720e5dc57ccf55ee1cc36b4fa191b3e-Q0xCT0taQW9rTklWVW1mNzN4ZDBjQT09&product_name=ds24abd7045dc7e600cbb2d1c3a3e5652efd-S29yTW1WcmhwMXp4eXJVQ2Q4YVdkZEgzaFUvZm44WUFDVUFCUVF0WnhMST0_e&quantity=ds24db9968675fff402c3a992f76563fff9b-OHBFRjhMT1hXZmNreVlTZnBJS0hvdz09&country=ds24628a6212b236d2873b1da4f1c12e4997-REJBUTJDcFIwZXU0SlE0cG9mNkxvdz09&buyer_language=ds24a94bfae7731cc0cb6e004306efeda32f-UVZETG5DQkUvT0NmdVMvWk1Fdld1dz09&buyer_id=ds24ab691b84e76059d5d8ca149306619a1e-dDFiNVNNTm45cHo3RzNHb1c5a2xrZz09&buyer_first_name=ds240b9b81088d74c603e3a8bc8f870c5065-am1XNW1PVGJUb3ZaRUdSbXZ0YW1WZz09&buyer_last_name=ds24d84edf0414f9871ecea01c8d131acafb-V0FmVE5lZnNCRVdpcjVIQ25KQ0pOUT09&billing_status=ds24de5c12b5d98df71033a09b08b7375196-R2JuQ2N1emdZL3NIc3NBY3EyY2ljQT09¤cy=ds24e1292ff8777e18195a50c107072f7a07-TCt3T1hYZ04rRW00NVZ1VTcwT0diUT09&amount=ds24f0922f4fca3adbca3b9f73ea64de1cca-ck9Fa2s5ajRCZGU4cDN2eXhQSmF4Zz09&vat_amount=ds248e5a60052f1b1563a3e6d31197f0b3ef-aHB0dXp2bWhEVmJ2cklZOVY0M2RaZz09&other_amounts=ds24b25ab21926f624256c0fe74a8800afb3-ZHFDYXBQOCtNUzFIUjNaZnI1YzBJdz09&other_vat_amounts=ds245c19d94d90bb7640fca3282a0195b718-ang2Mjl1L0lnOFJtaHArTnJkWmhEdz09&sha_sign=842486B8C793B57A237158836DEEC03B34BCC436C13BED1C8412E03317B3ABE314E8D4F8F19FB89FFD3C811DA4E1CD20BF15C43A897375B46C836CD2DBBC528A';

$secret_key = 'some-secret-key';

parse_str( $querystring, $encrypted_get_params );

$get_params = digistore_decrypt_url_args( $secret_key, $encrypted_get_params );

if(!isset($_SESSION['email'])){

    $_SESSION['email'] = $get_params['buyer_email'] ;
    $_SESSION['vorname'] = $get_params['buyer_first_name'] ;
    $_SESSION['nachname'] = $get_params['buyer_last_name'] ;  
}
?>



<!DOCTYPE html> 
<html> 
<head>
  <title>Mathe Abi Vorbereitung</title>    
</head> 
<body>
 
<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll
 
if(isset($_GET['register'])) {
    $error = false;
    //$email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];

  
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }     
    // if(strlen($passwort) == 0) {
    //     echo 'Bitte ein Passwort angeben<br>';
    //     $error = true;
    // }
    // if($passwort != $passwort2) {
    //     echo 'Die Passwörter müssen übereinstimmen<br>';
    //     $error = true;
    // }
    
    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    // if(!$error) { 
    //     $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    //     $result = $statement->execute(array('email' => $email));
    //     $user = $statement->fetch();
        
    //     if($user !== false) {
    //         echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
    //         $error = true;
    //     }    
    // }
    
    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) {    
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        
        $statement = $pdo->prepare("INSERT INTO benutzer (email, passwort, vorname, nachname) VALUES (:email, :passwort, :vorname, :nachname)");
        $result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash, 'vorname' => $vorname, 'nachname' => $nachname));
        
        if($result) {        
            echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    } 
}
 
if($showFormular) {
?>
 
<form action="?register=1" method="post">


 
Dein Passwort:<br>
<input type="password" size="40"  maxlength="250" name="passwort"><br>
 
<input type="submit" value="Abschicken">
</form>
 
<?php
} //Ende von if($showFormular)
?>
 
</body>
</html>