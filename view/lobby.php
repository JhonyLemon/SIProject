<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css" />
    <meta charset="utf-8" />
    <meta name="description" content="Opis strony" />
    <meta name="keywords" content="Wyrazy kluczowe" />
    <script type="text/javascript" src="js/lobby.js"></script>
</head>

<body>
    <section>
        <div class="tiles">
                <?php while ($posts = $stmt->fetch()): ?>
                    <div onclick="onClick(event)" class="tile">
                        <img src="<?php echo LobbyURL($posts); ?>" alt="<?php echo $posts['IDpost']; ?>">
                        <figcaption class="figlobby">
                            <div>
                                <?php echo $posts['title']; ?>
                            </div>
                            <?php if($posts['points']>0): ?>
                                <div class='postplus'>
                                    <?php echo $posts['points']; ?>
                                </div>
                        </figcaption>
                            <?php else: ?>
                                <div class='postminus'><?php echo $posts['points']; ?>
                            </div>
                        </figcaption>
                            <?php endif; ?>
                    </div>
                <?php endwhile; ?>
        </div>
    </section>
</body>

</html>