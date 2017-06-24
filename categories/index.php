<?php

//-----------------------------INDEX CATEGORY----------------------------------
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';


//-----Preparo i dati da inserire nel form------
if (isset($_GET['add'])) {

    $pagTitle = 'Nuova ategoria';
    $action = 'addform';
    $name = '';
    $id = '';
    $button = 'Aggiungi categoria';

    include 'form.html.php';
    exit();
}
//--------------Invio la form al db per aggiungere categoria-----------
if (isset($_GET['addform'])) {
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

    try {

        $sql = 'INSERT INTO category SET name = :name';
        $s = $pdo->prepare($sql);
        $s->bindValue(':name', $_POST['name']);
        $s->execute();
    } catch (PDOException $ex) {
        $error = 'Errore in aggiunta categoria' . $ex->getMessage();
        include'error.php';
        exit();
    }

    header('Location: .');
    exit();
}
//--------------Mi connetto per aggiornare i joke da visualizzare dal db---
if (isset($_POST['action']) and $_POST['action'] == 'Modifica') {
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

    try {
        $sql = 'SELECT id, name FROM category WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $ex) {
        $error = 'Errore in recupero categoria' . $ex->getMessage();
        include'error.php';
        exit();
    }

    $row = $s->fetch();

    $pagTitle = 'Modifica ategoria';
    $action = 'editform';
    $name = $row['name'];
    $id = $row['id'];
    $button = 'Aggiorna categoria';

    include 'form.html.php';
    exit();
}

//--------------Mi connetto per aggiornare e inserire i joke nel db---
if (isset($_GET['editform'])) {
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

    try {
        $sql = 'UPDATE category SET name= :name WHERE id= :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->bindValue(':name', $_POST['name']);
        $s->execute();
    } catch (PDOException $ex) {

        $error = 'Errore in aggiornamento categoria. ' . $ex->getMessage();
        include 'error.php';
        exit();
    }

    header('Location: .');
    exit();
}
//--------------Elimino i joke associati alla categoria -----------

if (isset($_POST['action']) and $_POST['action'] == 'Elimina') {
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

    try {
        $sql = 'DELETE FROM jokecategory WHERE categoryid = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $ex) {
        $error = 'Errore in rimozione joke dalla categoria. ' . $ex->getMessage();
        include 'error.php';
        exit();
    }

//--------------Elimino la categoria -----------------------------
    try {

        $sql = 'DELETE FROM category WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
        
    } catch (PDOException $ex) {

        $error = 'Errore in eliminazione categoria. ' . $ex->getMessage();
        include 'error.php';
        exit();
    }

    header('Location: .');
    exit();
}

//--------------Visualizza elenco categorie -----------------------------    
include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

try {
    
    $result = $pdo->query('SELECT id,name FROM category');
    
} catch (PDOException $ex) {
   
    $error = 'Errore recupero categoria dal database. ' . $ex->getMessage();
    include 'error.php';
    exit();
}

foreach ($result as $row){
    
    $categories [] = array(
        'id'=> $row['id'],
        'name' => $row['name']
    );
    
}

include 'categories.html.php';
