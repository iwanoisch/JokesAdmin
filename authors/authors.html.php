<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Gestione Autori</title>
        <link href="style/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h1>Gestione Autori </h1>
        <p><a href="?add">Aggiungi nuovo autore</a></p>
        <ul>
            <?php foreach ($authors as $author): ?>
                <li>
                    <form action="" method="post">
                        <div>
                            <?php htmlout($author['name']); ?>
                            <input type="hidden" name="id" value="<?php htmlout($author['id']); ?>" >
                            <input type="submit" name="action" value="Modifica">
                            <input type="submit" name="action" value="Elimina">
                        </div>
                    </form>
                </li>
            <?php endforeach; ?>
         </ul>
        <p><a href="..">Torna alla prima pagina</a></p>
    </body>
</html>