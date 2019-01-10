<?php
// makes connection to DB
include('../conf/config.php');

// defines query: assigns $variable to values of column "id" & says SQL instruction ($id becomes :id)
$id=$_GET['id'];

$sql="  UPDATE  sample
        SET     deleted = 0
		WHERE   id=:id";
		
// prepare and execute query
$query=$conn->prepare($sql);
$query->execute(['id' => $id]);

// output on webpage
echo "The record has been restored <br>";


?>

<a href='../samples.php'>back</a>