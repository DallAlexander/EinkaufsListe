<?php
// PHP-Session initialisieren
session_start();
 
// Alle Sitzungsvariablen aufheben
$_SESSION = array();
 
// Session destroyen
session_destroy();
 
// Zur Login-Seite weiterleiten
header("location: login.php");
exit;
?>