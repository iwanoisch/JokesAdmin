
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Gestione categorie</title>
        <link href="style/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h1>Gestione categorie </h1>
        <p><a href="?add">Aggiungi nuova categoria</a></p>
        <ul>
            <?php foreach ($categories as $category): ?>
                <li>
                    <form action="" method="post">
                        <div>
                            <?php htmlout($category['name']); ?>
                            <input type="hidden" name="id" value="<?php htmlout($category['id']); ?>" >
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