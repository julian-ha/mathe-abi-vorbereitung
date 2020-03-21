<?php
session_start();
    if(!isset($_SESSION['isloggedin'])){
        session_destroy();
        header('Location: https://www.mathe-abi-vorbereitung.de');
    }
    
?>