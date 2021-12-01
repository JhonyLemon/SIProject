<?php while ($post = $st->fetch()) : ?>
        <div class="post">
                <?php if ($previous != $post['IDpost']) : ?>
                        <h1><?php echo $post['title'] ?></h1>
                <?php endif; ?>
                <?php $previous = $post['IDpost']; ?>
                <div class='element'>
                        <img class='img' src="<?php echo PostURL($post); ?>" alt="<?php echo $post['IDpost'] ?>" />
                        <figcaption class='figpost'><?php echo $post['description'] ?></figcaption>
                </div>
        </div>
<?php endwhile; ?>