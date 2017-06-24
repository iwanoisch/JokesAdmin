<?php
//CONNETTO AL SERVER
try {
    
    $pdo = new PDO('mysql:host=localhost; dbname=ijdb', 'jidbuser', 'mypassword');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('set names "UTF8"');
    
} catch (Exception $ex) {
    
    $error = 'Impossibile connettersi al server di database. '.$ex->getMessage();
    include 'error.html.php';
    exit();
    
}

