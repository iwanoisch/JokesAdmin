<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang='it'>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php htmlout($pageTitle); ?></title>
    </head>
    <body>
        <h1><?php htmlout($pageTitle); ?></h1>
        <form action="?<?php htmlout($action); ?>" method="post">
            <div>
                <label for="name">
                    Nome: <input type="text" name="name" id="name" value="<?php htmlout($name); ?>" >
                </label>
            </div>
            <div>
                <input type="hidden" name="id" id="id" value="<?php htmlout($id); ?>" >
                <input type="submit" value="<?php htmlout($button); ?>">
            </div>
        </form>
    </body>
</html>
