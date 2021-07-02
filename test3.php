<!DOCTYPE html>
<html>
	
<head>
	<title>
		Einkaufsliste TEST 
	</title>
</head>

<body style="text-align:center;">
	
	<h4>
		Liste
	</h4>
	

<?php
if ($_POST) {
    echo '<pre>';
    echo htmlspecialchars(print_r($_POST, true));
    echo '</pre>';
}
?>
<form action="" method="post">
    Name:  <input type="text" name="personal[name]" /><br />
    E-Mail: <input type="text" name="personal[email]" /><br />
    Bier: <br />
    <select multiple name="bier[]">
        <option value="oettinger">Öttinger</option>
        <option value="bitburger">Bitburger</option>
        <option value="stuttgarter">Stuttgarter Schwabenbräu</option>
    </select><br />
    <input type="submit" value="Und ab!" />
</form>



</head>

</html>



