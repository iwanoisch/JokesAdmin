<?php

//-----------------------------INDEX AUTHOR------------------------------------
//--------------Preparo la form per aggiungere autori--------------
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';

if (isset($_GET['add'])) {

    $pageTitle = 'Nuovo autore';
    $action = 'aggiungi';
    $name = '';
    $email = '';
    $id = '';
    $button = 'Aggiungi autore';

    include 'forms.html.php';
    exit();
}
//--------------Invio la form al db per aggiungere autore-----------

if (isset($_GET['aggiungi'])) {

    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

    try {

        $sql = 'INSERT INTO author SET name = :name, email= :email';
        $s = $pdo->prepare($sql);
        $s->bindValue(':name', $_POST['name']);
        $s->bindValue(':email', $_POST['email']);
        $s->execute();
    } catch (PDOException $ex) {

        $error = 'Errore in aggiunta autore. ' . $ex->getMessage();
        include 'error.php';
        exit();
    }
    header('Location: .');
    exit();
}

//--------------Mi connetto per aggiornare autore al db-----------
if (isset($_POST['action']) and $_POST['action'] == 'Modifica') {
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

    try {
        $sql = 'SELECT id, name, email FROM author WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $ex) {

        $error = 'Errore in recupero dati autore. ' . $ex->getMessage();
        include 'error.php';
        exit();
    }

    $row = $s->fetch();

    $pageTitle = 'Modifica autore';
    $action = 'editform';
    $name = $row['name'];
    $email = $row['email'];
    $id = $row['id'];
    $button = 'Aggiorna autore';

    include 'forms.html.php';
    exit();
}

if (isset($_GET['editform'])) {

    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';



    try {

        $sql = 'UPDATE author SET name = :name, email = :email WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->bindValue(':name', $_POST['name']);
        $s->bindValue(':email', $_POST['email']);
        $s->execute();
    } catch (PDOException $ex) {

        $error = 'Errore in aggiornamento autore. ' . $ex->getMessage();
        include 'error.php';
        exit();
    }

    header('Location: .');
    exit();
}



if (isset($_POST['action']) and $_POST['action'] == 'Elimina') {

// MI connetto al server Database
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

//--------------Ottengo i joke appartenenti all'autore-----------
    try {
        $sql = 'SELECT id FROM joke WHERE authorid= :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $ex) {
        $error = 'Errore in recupero joke da eliminare. ' . $ex->getMessage();
        include 'error.php';
        exit();
    }
//Recupera l'intero insieme di risultati per la query e lo memorizza nell'arry result
//in questo caso il php manterrà in memoria tutti i risultati insieme il che consente di inviare altre query aMysql;
    $result = $s->fetchAll();



//--------------Elimino voci categorie joke-----------------
    try {
        $sql = 'DELETE FROM jokecategory WHERE jokeid = :id';
        $s = $pdo->prepare($sql);

//Per ogni joke 
        foreach ($result as $row) {

            $jokeId = $row['id'];
            $s->bindValue(':id', $jokeId);
            $s->execute();
        }
    } catch (PDOException $ex) {
        $error = 'Errore in eliminazione voci categorie joke. ' . $ex->getMessage();
        include 'error.php';
        exit();
    }
//--------------Elimino i joke appartenenti all'autore------
    try {
        $sql = 'DELETE FROM joke WHERE authorid = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $ex) {
        $error = 'Errore in eliminazione joke per autore. ' . $ex->getMessage();
        include 'error.php';
        exit();
    }

//--------------Elimino l'autore-----------------------------

    try {

        $sql = 'DELETE FROM author WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $ex) {

        $error = 'Errore in eliminazione autore. ' . $ex->getMessage();
        include 'error.php';
        exit();
    }

    header('Location: .');
    exit();
}



//--------------Mostrare gli autori-------------------------
// MI connetto al server Database
include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

try {

    $sql = 'SELECT id, name FROM author';
    $result = $pdo->query($sql);
} catch (PDOException $ex) {

    $error = 'Errore recupero dati autore dal database! ' . $ex->getMessage();
    include 'error.php';
    exit();
}

foreach ($result as $row) {

    $authors[] = array(
        'id' => $row['id'],
        'name' => $row['name']
    );
}

include 'authors.html.php';


