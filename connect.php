<?php

//database connect
try {
    $db = new PDO('mysql:dbhost=locahost;dbname=basic_php_crud', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    
    ]);
} catch (PDOException $err) {
    echo "Database connection failed : ".$err->getMessage();
}



