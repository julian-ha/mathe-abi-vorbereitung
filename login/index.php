<?php
session_start();
?>
<!Doctype html>
<html>
    <head>

    </head>

    <body>
        <form action="login_script.php" method="POST">
        <input type="text" name="benutzer" required><br>
        <input type="password" name="passwort" required><br>
        
        <?php if(isset($_SESSION['notification'])){
            echo "<p>". $_SESSION['notification']. "</p>";
            unset($_SESSION['notification']);
        } ?>
        <input type="submit" name="submit" value="Abschicken">
        </form>
        
    </body>
</html>