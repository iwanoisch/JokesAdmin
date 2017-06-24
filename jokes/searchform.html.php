<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Gestione joke</title>
        <link href="style/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h1>Gestione joke</h1>
        <p><a href="?add">Aggiungi nuovo joke</a></p>
        <form action="" method="get">
            <p>Visualizza i joke che soddisfano i seguenti criteri:</p>
            <div>
                <label for="author">Per autore:</label>
                <select name="author" id="author">
                    <option value="">Qualsiasi autore</option>
                    <?php foreach ($authors as $author): ?>
                        <option value="<?php htmlout($author['id']); ?>">
                            <?php htmlout($author['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="category">Per categoria:</label>
                <select name="category" id="category">
                    <option value="">Qualsiasi categoria</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php htmlout($category['id']); ?>"> 
                            <?php htmlout($category['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="text">Contenenti il testo:</label>
                <input type="text" name="text" id="text">
            </div>
            <div>
                <input for="hidden" name='action' value='search'>
                <input type="submit" value="Cerca">
            </div>
        </form>
        <p><a href="..">Torna alla prima pagina </a></p>
    </body>
</html>
