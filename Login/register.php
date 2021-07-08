<?php
// DB-Config
require_once "config.php";

// Variablen definieren und mit leeren Werten initialisiert
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Verarbeitung von Formulardaten beim Absenden des Formulars 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Bitte Benutzername eintragen.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Benutzername kann nur Buchstaben, Nummern und Unterstriche enthalten.";
    } else{
        // Select-Statement vorbereiten
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Variablen als Parameter an die vorbereitete Anweisung binden
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Parameter zum Setzen
            $param_username = trim($_POST["username"]);
            
            // Versuch die vorbereitete Anwensung auszuführen
            if(mysqli_stmt_execute($stmt)){
                /* Ergebnis speichern */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Dieser Benutzername ist bereits in Verwendung.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Statement schließen
            mysqli_stmt_close($stmt);
        }
    }
    
    // Passwort validieren
    if(empty(trim($_POST["password"]))){
        $password_err = "Bitte ein Passwort eintragen.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Passwort muss sechs Zeichen haben.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Passwort bestätigen überprüfen
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Bitte Passwort bestätigen.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Insert-Fehler überprüfen, vor Abschluss der Transaktion
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Insert-Statement vorbereiten
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Variablen an das Prepared-Statement als Parameter binden
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Parameter setzen
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Versuch das Prepared-Statement abzusetzen
            if(mysqli_stmt_execute($stmt)){
                // Zur Login-Seite weiterleiten
                header("location: login.php");
            } else{
                echo "Hoppla! Etwas ist schiefgelaufen, probiere es später erneut.";
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
    <title>Registrierung</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="stylesheet.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="bigElement heading">
        <h1>Registrieren</h1>
        <h2>Fülle dieses Formular aus, um dich zu registrieren.</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Benutzername</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Passwort</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Passwort bestätigen</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Übermitteln">
            </div>
            <p>Du hast bereits einen Account? <a href="login.php">Melde dich an</a>.</p>
        </form>
    </div>    
</body>
</html>