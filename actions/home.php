<?php
    $stmt = $db->prepare('SELECT posts.IDpost,title,IDphoto,ext FROM posts LEFT JOIN photos ON posts.IDpost=photos.IDpost WHERE valid=1 GROUP BY posts.IDpost');
    $stmt->execute();
?>