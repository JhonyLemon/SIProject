<?php
if(isset($_GET['id']))
{
    $stmt = $db->prepare('SELECT posts.IDpost,title,IDphoto,ext,description FROM posts LEFT JOIN photos ON posts.IDpost=photos.IDpost WHERE posts.IDpost=:id');
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();
}

?>