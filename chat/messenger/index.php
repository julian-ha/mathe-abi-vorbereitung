<?php 

//Database connection
$pdo = new PDO('mysql:host=188.68.47.203;dbname=k93814_matheAbi', 'k93814_matheAbi', 'Sxt0m25?');

//get all messages
$sql= "SELECT * FROM nachrichten ORDER BY zeitstempel DESC";
$statement = $pdo->prepare($sql);
$statement->execute();
$messages = $statement->fetchAll();

foreach($messages as $message){
    echo $message['inhalt'] . "<br>";
    echo $message['benutzername'] . "<br>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mathe-Abi-Vorbereitung - STREAM</title>
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
                    <article class="message">
                        <div class="message-header">
                            <p>Hello World</p>
                            <button class="delete" aria-label="delete"></button>
                        </div>
                        <div class="message-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>




        

    </body>
</html>