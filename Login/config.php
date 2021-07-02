<?php
/* Datenbank Verbindung */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'demo');
 
/* Versuch mit der MYSql-Datenbank zu verbinden */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Verbindung überprüfen
if($link === false){
    die("Fehler: Verbindung nicht möglich " . mysqli_connect_error());
}
?>