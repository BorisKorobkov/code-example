<?php
/**
 * Layout
 *
 * @var Controller $this
 * @var string $title
 * @var string $content
 */

use mvc\Config;
use mvc\Controller;

?>
<!DOCTYPE html>
<html lang="<?= Config::$config['lang'] ?>">
<head>
    <meta charset="<?= Config::$config['charset'] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->encode($title) ?></title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<?= $this->getView('layoutHeader') ?>

<div class="container">
    <?= $content ?>
</div>

<?= $this->getView('layoutFooter') ?>

</body>
</html>
