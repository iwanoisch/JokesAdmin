<?php

//-----------------------------INDEX JOKES----------------------------------
//Creo due query che mostrano i due array uno di categorie di joke e uno di author
include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

//---------query per creare array degli autori-----------

try {
    $result = $pdo->query('SELECT id, name FROM author');
} catch (Exception $ex) {

    $error = 'Errore in recupero autori dal database! ' . $ex->getMessage();
    include 'error.php';
    exit();
}

foreach ($result as $row) {

    $authors[] = array(
        'id' => $row['id'],
        'name' => $row['name']
    );
}

//---------query per creare array delle categorie di joke-----------

try {

    $result = $pdo->query('SELECT id, name FROM category');
} catch (Exception $ex) {

    $error = 'Errore in recupero categrie dal database! ' . $ex->getMessage();
    include 'error.php';
    exit();
}

foreach ($result as $row) {

    $categories[] = array(
        'id' => $row['id'],
        'name' => $row['name']
    );
}

include 'searchform.html.php';