<?php 

//Database connection
$pdo = new PDO('mysql:host=188.68.47.203;dbname=k93814_matheAbi', 'k93814_matheAbi', 'Sxt0m25?');

//get all messages
$sql= "SELECT benutzername, inhalt, farbe, date_format(zeitstempel, ' %d.%m.%Y %H:%i') zeitstempel FROM nachrichten ORDER BY zeitstempel DESC";
$statement = $pdo->prepare($sql);
$statement->execute();
$messages = $statement->fetchAll();


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="refresh" content="5; URL=https://www.mathe-abi-vorbereitung.de/chat/messenger/">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mathe-Abi-Vorbereitung - Chats für Dozenten</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css" />
    <link rel="stylesheet" href="includes/style.css" />
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <link rel="stylesheet" href="../includes/style.css" />
    
</head>
    <body>

    <div class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-full">
                    <h2 class="title is-3">Alle Chatnachrichten für den Dozenten</h2>
                    <br><br>
                </div>
            </div>
            <div class="columns">
                <div class="column is-full">
                    <?php foreach($messages as $message) {
                       
                        ?>
                    <article class="message <?php echo $message['farbe'] ?>">
                        <div class="message-header">
                            <p>Nachricht von Nutzer: <strong><?php echo $message['benutzername'] ?></strong></p>
                            <span style="float:right">Uhrzeit: <?php  echo $message['zeitstempel'] ?></span>
                            
                        </div>
                        <div class="message-body">
                            <?php echo $message['inhalt'] ?>
                        </div>
                    </article>
                    <?php $color = null;} ?>
                </div>
            </div>
        </div>
    </div>

    </body>
</html>