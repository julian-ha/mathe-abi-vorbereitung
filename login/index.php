<!Doctype html>
<html>
    <head>

    </head>

    <body>
        <form action="check.php" method="POST">
        <input type="mail" name="email" required><br>
        <input type="password" name="passwort" required><br>
        <input type="submit" name="submit" value="Abschicken">
        <?php if(isset($_SESSION['fehlermeldung'])){
            echo "<p>". $_SESSION['fehlermeldung']. "</p>";
        } ?>

        </form>
        
    </body>
</html>