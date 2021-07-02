<!DOCTYPE html>
<html lang="en">
<?php
      $GLOBALS['servername'] = "localhost"; 
      $GLOBALS['username'] = "root";
      $GLOBALS['password'] = "root";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try{
          //Verbindung zur Datenbank herstellen
          $conn = new PDO("mysql:host=" . $GLOBALS['servername'] . ";port=3306;dbname=einkaufsliste", $GLOBALS['username'], $GLOBALS['password']);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          if(isset($_POST['add'])) {
            //Ein neuer Eintrag soll in der Datenbank erstellt werden
            //POST in der Form: "[Anzahl]x [Bezeichnung]"
            $explodedString = explode("x ", $_POST['add']);
            $anzahl = $explodedString[0];
            $bezeichnung = $explodedString[1];

            $sql = "INSERT INTO artikelliste (bezeichnung, anzahl, flagged) VALUES (?,?,?)";
            $statement = $conn->prepare($sql);
            $statement -> execute([$bezeichnung, $anzahl, 0]);             

          }else if(isset($_POST['check'])) {
            //Ein Eintrag in der Datenbank soll abgehakt oder nicht-abgehakt werden
            //POST in der Form: "[ID]|[Checked]"
            $explodedString1 = explode("|", $_POST['check']);
            $flagged = $explodedString1[1];
            $id = $explodedString1[0];

            $sql = "UPDATE artikelliste SET flagged = ? WHERE id = ?";
            $statement = $conn->prepare($sql);
            $statement -> execute([$flagged, $id]);

          }else if(isset($_POST['delete'])) {
            //Ein Eintrag in der Datenbank soll gelöscht werden
            //POST in der Form: "[ID]"
            $sql = "DELETE FROM artikelliste WHERE id = ?";
            $statement = $conn->prepare($sql);
            $statement -> execute([$_POST['delete']]);
          }

        } catch(PDOException $e) {
          echo "Datenbankverbindung fehlgeschlagen: " . $e->getMessage();
        }finally {
          //Connection schließen
          $statement = null;
          $conn = null;
        }
        
      }
  ?> 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Die Einkaufsliste</title>
    <script type="text/javascript" src="main.js"></script>
</head>
<body>
    <div class="bigElement heading">
        <h1>Die Einkaufsliste</h1>
    </div>
    <div class="bigElement">
       <h2> Bitte Wert eingeben</h2>
       <input type="number" id="itemQnty" class="input" min="1" max="99" value="1" placeholder="Anzahl">
       <input type="text" id="Input1" class="input" maxlength="40">
       <button id="btn1" class="btnAdd" onclick="addItem()">+</button>
   </div> 
   <div class="bigElement">
       <table class="table" id="table">
        <thead>
            <tr>
              <th>Anzahl</th>
              <th class="table_bezeichnung">Bezeichnung</th>
              <th>abhaken</th>
              <th>löschen</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $returnValue = "<script type=\"text/javascript\">";

            try {
              //Verbindung zur Datenbank herstellen
              $conn = new PDO("mysql:host=" . $GLOBALS['servername'] . ";port=3306;dbname=einkaufsliste", $GLOBALS['username'], $GLOBALS['password']);
              // set the PDO error mode to exception
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              $sql = 'select * from artikelliste';
              foreach ($conn->query($sql) as $row){
                $flagged = "";
                if($row['flagged'] == 0){
                  $flagged = "false";
                } else {
                  $flagged = "true";
                }

                //Für jedes Element aus der Datenbank wird die Funktion addItem() ausgeführt, um das Element der Liste hinzuzufügen
                $returnValue .= "addItem(true, \"" 
                . $row['bezeichnung'] 
                . "\", " . $row['anzahl'] 
                . ", " . $flagged . ", " . $row['id'] . ");";
              }
              $returnValue .= "</script>";

              echo $returnValue;
            } catch(PDOException $e) {
              echo "Datenbankverbindung fehlgeschlagen: " . $e->getMessage();
            }
            ?>
        </tbody>
       </table>
   </div>
    
</body>

<script>
  //Dies verhindert ein erneutes ausführen des SQL beim Neu-Laden der Seite
  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }
</script>

</html>
