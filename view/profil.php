<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css" />
    <meta charset="utf-8" />
    <meta name="description" content="Opis strony" />
    <meta name="keywords" content="Wyrazy kluczowe" />
    <script type="text/javascript" src="js/profil.js"></script>
</head>

<body>
    <section>
        <div class="div-panel">
            <a class="icons-text" href="index.php?action=profil&show=favorited">Ulubione</a>
            <a class="icons-text" href="index.php?action=profil&show=self">Własne</a>
        </div>

        <?php if (!array_key_exists('show', $_GET)) : ?>
            <?php include(_ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'favorited.php'); ?>
        <?php elseif ($_GET['show'] == 'favorited') : ?>
            <?php include(_ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'favorited.php'); ?>
        <?php elseif ($_GET['show'] == 'self') : ?>
            <?php include(_ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'favorited.php'); ?>
        <?php endif; ?>
    </section>
</body>

</html>