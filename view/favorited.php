<?php if (isset($_GET['id'])) : ?>
    <div class="list">
    <?php if ($post = $stmt->fetch()) : ?>
        <h1><?php echo $post['title'] ?></h1>
        <?php
        do {
        ?>
            <div class='element'>
                <img class='img' src="<?php echo PostURL($post) ?>" alt="<?php echo $post['IDpost'] ?>" />
                <figcaption class='figpost'><?php echo $post['description'] ?></figcaption>
            </div>
        <?php
        } while ($post = $stmt->fetch());
        ?>
    <?php else : ?>
        <?php redirect('profil'); ?>
    </div>
    <?php endif; ?>
<?php else : ?>
    <h1>Ulubione</h1>
    <div class="tiles">
                <?php while ($posts = $stmt->fetch()): ?>
                    <div onclick="onClickFavorited(event)" class="tile">
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
<?php endif; ?>
