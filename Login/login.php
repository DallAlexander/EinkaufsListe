<?php
// PHP-Session initialisieren
session_start();
 

// Überprüfen ob der Benutzer schon eingeleggt ist, wenn ja dann zur Willkommen-Seite weiterleiten
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
// DB-Config einbeziehen
require_once "config.php";
 
// Variablen definieren und initialisieren mit leeren Werten
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Verarbeitung von Formulardaten beim Absenden des Formulars
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Überprüfen, ob das Benutzername-Feld leer ist
    if(empty(trim($_POST["username"]))){
        $username_err = "Bitte Benutzername eingeben.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Überprüfen, ob das Passwort-Feld leer ist
    if(empty(trim($_POST["password"]))){
        $password_err = "Bitte Passwort eingeben.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Zugang überprüfen
    if(empty($username_err) && empty($password_err)){
        // Select-Statement vorbereiten
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Variablen als Parameter an das Select-Statement binden
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set Parameter
            $param_username = $username;
            
            // Versuch das Prepared Statement abzusetzen
            if(mysqli_stmt_execute($stmt)){
                // Ergebnis speichern
                mysqli_stmt_store_result($stmt);
                
                // Überprüfen, ob der Benutzername existiert, wenn ja dann überprüfe Passwort
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Ergebnis-Variablen binden
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Das Passwort ist korrekt, also starte eine PHP-Session
                            if(session_status() == PHP_SESSION_NONE) {
                                // Sofern die PHP-Session noch nicht gestartet wurde
                                    session_start();
                                }
                            
                            // Credentials in die Sitzungsvariablen speichern
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Weiterleitung zur Willkommen-Seite
                            header("location: index.php");
                        } else{
                            // Wenn das Passwort nicht stimmt, Fehlermeldung anzeigen
                            $login_err = "Ungültiger Benutzername oder Passwort.";
                        }
                    }
                } else{
                    // Wenn der Benutzer nicht existiert, Fehlermeldung anzeigen
                    $login_err = "Ungültiger Benutzername oder Passwort";
                }
            } else{
                echo "Hoppla! Etwas ist schief gelaufen. Probiere es später erneut.";
            }

            // Statement schließen
            mysqli_stmt_close($stmt);
        }
    }
    
    // Verbindung schließen
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Anmeldung</title>
    <link rel="stylesheet" href="stylesheet.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="bigElement heading">
        <h1>Login</h1>
    </div>
    <div class="bigElement">
        <h2>Bitte gebe deine Anmeldedaten an, um dich anzumelden</h2>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <p class="feedback"><?php echo $username_err; ?></p>
                <input type="text" name="username" placeholder="Benutzername" class="input <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
            </div>    
            <div class="form-group">
                <p class="feedback"><?php echo $password_err; ?></p>
                <input type="password" name="password" placeholder="Passwort" class="input <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>, ">
            </div>
            <div class="form-group">
                <input type="submit" class="btnSubmit" value="Login">
            </div>
            <p>Du bist noch nicht registriert? <a href="register.php">Registriere dich jetzt</a>.</p>
        </form>
    </div>
</body>
</html>