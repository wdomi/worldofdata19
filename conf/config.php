<?php

try {
    $conn = new PDO("mysql:host=localhost;
                    dbname=myapp",         //DBname ...
                    "myapp",                 //User, default "root"
                    "myapp");                    //Passw, default ""
  } 
  
  catch (PDOException $e) {
    echo "Connection error: "
      . $e->getMessage();
    exit;
  }

// ALLERT error connection (try{} and catch{})
    
?>


