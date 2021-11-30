<?php while ($post = $st->fetch()) : ?>
        <div class="post">
                <?php var_dump($post); ?>
                <?php $row = PostURL($post); ?>
                <?php if ($previous != $post['IDpost']) : ?>
                        <h1><?php echo $post['title'] ?></h1>
                <?php endif; ?>
                <?php $previous = $post['IDpost']; ?>
                <div class='element'>
                        <img class='img' src="<?php echo $row['url'] ?>" alt="<?php echo $row['alt'] ?>" />
                        <figcaption class='figpost'><?php echo $row['description'] ?></figcaption>
                </div>
        </div>
<?php endwhile; ?>