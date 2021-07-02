
<!-- <input type="text" name="ID" value=""> -->
<!-- $id_N= $_POST['ID']; -->
<?php 
try{
$db = new PDO('sqlite:NOTES_PDO.sqlite');

//  $db->exec("CREATE TABLE artikelliste( note TEXT)");


$id = '4';
$note= 'Tomaten';
$did= '4';
// INSERT
$query = "INSERT INTO artikelliste(note) VALUES(?)";

// DELETE
// $query2 = "DELETE FROM artikelliste WHERE id=?";

// INSERT
$stmt = $db->prepare($query);
$stmt->execute([$note]); 

// DELETE
// $stmt2 = $db->prepare($query2);
  // $stmt2->execute([$did]); 


// --------------------


print "<table border=5>";
print "<tr>   <td> NOTES </td></tr>";
$value = $db->query('SELECT * FROM artikelliste');
foreach($value as $row){
// print "<tr><td>".$row['id']."</td>";
print "<td>".$row['note']."</td></tr>";
}
print "</table";

}catch(PDOException $e){
    echo $e->getMessage();
}
?>