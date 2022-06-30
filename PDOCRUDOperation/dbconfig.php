<?php

    define ('DB_HOST','localhost');
    define ('DB_USER','root');
    define ('DB_PASS','12345');
    define ('DB_NAME','pdocrud');

    try{
        $dbh = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME, DB_USER,DB_PASS);
    }catch(PDOException $e){
        exit("Error".$E->getMessage());
    }
    
?>