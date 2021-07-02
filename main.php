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

        $db = new PDO('sqlite:test_PDO.sqlite');

        print "<table border=5>";
        print "<tr>   <td> NOTES </td></tr>";
        $value = $db->query('SELECT * FROM NOTES_TEST');
        foreach($value as $row){

        // print "<tr><td>".$row['id']."</td>";
        print "<td>".$row['note']."</td></tr>";
        
        }
        print "</table";

        
        $id = '29';
        $note= 'Tomaten';
        $did= '3';

            ?>

<?php
        if(array_key_exists('button1', $_POST)) {
            button1();
        }
        else if(array_key_exists('button2', $_POST)) {
            button2();
        }
        function button1() {
            echo "This is Button1 that is selected";
        }
        function button2() {
            echo "This is Button2 that is selected";
        }
    ?>







	<form method="post">
		<input type="submit" name="button1"
				class="button" value="Button1" />
		
		<input type="submit" name="button2"
				class="button" value="Button2" />
	</form>
</head>

</html>



