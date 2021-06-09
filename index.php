<!DOCTYPE html>
<html lang="en">
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
    <div class="bigElement">
        <h1>Die Einkaufsliste</h1>
    </div>
    <div class="bigElement">
       <h2> Bitte Wert eingeben</h2>
       <input type="number" id="itemQnty" class="input" min="1" max="99" value="1" placeholder="Anzahl">
       <input type="text" id="Input1" class="input" maxlength="33">
       <button id="btn1" class="btnAdd" onclick="addItem()">+</button>
   </div> 
   <div class="bigElement">
       <ul class="list" id="ul1">

          <?php
            $servername = "localhost";
            $username = "root";
            $password = "Passwort123!";
            $returnValue = "<script type=\"text/javascript\">";

            try {
              $conn = new PDO("mysql:host=$servername;port=3306;dbname=einkaufsliste", $username, $password);
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

                $returnValue .= "addItem(\"" 
                . $row['bezeichnung'] 
                . "\", " . $row['anzahl'] 
                . ", " . $flagged . ");";
              }
              $returnValue .= "</script>";

              echo $returnValue;
            } catch(PDOException $e) {
              echo "Datenbankverbindung fehlgeschlagen: " . $e->getMessage();
            }
            ?>

       </ul>
   </div>
</body>
</html>