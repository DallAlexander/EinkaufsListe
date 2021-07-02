<?php
// PHP-Session initialisieren
session_start();
 
// Überprüfen, ob der Benutzer eingeloggt ist, ansonsten zur Login-Seite weiterleiten
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Willkommen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="stylesheet.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="bigElement">
        <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Willkommen auf deiner Einkaufsliste.</h1>    
    </div>
    <div class="bigElement">
        <a href="logout.php" class="btn btn-danger ml-3">Abmelden</a>
        <a href="index.php" class="btn btn-info">Zur Einkaufsliste fortfahren</a>
    </div> 
    <p>

    </p>
</body>
</html>