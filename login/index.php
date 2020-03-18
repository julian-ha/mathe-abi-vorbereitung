<?php
session_start();
?>
<!Doctype html>
<html>
    <head>

    </head>

    <body>
        <form action="check.php" method="POST">
        <input type="mail" name="email" required><br>
        <input type="password" name="password" required><br>
        
        <?php if(isset($_SESSION['fehlermeldung'])){
            echo "<p>". $_SESSION['fehlermeldung']. "</p>";
        } ?>
        <input type="submit" name="submit" value="Abschicken">
        </form>
        
    </body>
</html>