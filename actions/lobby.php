<?php
    $stmt = $db->prepare('SELECT posts.IDpost,posts.points,title,IDphoto,ext FROM posts LEFT JOIN photos ON posts.IDpost=photos.IDpost WHERE valid=0 GROUP BY posts.IDpost DESC');
    $stmt->execute();
?>