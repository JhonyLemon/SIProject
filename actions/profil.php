<?php
if(!array_key_exists('id',$_GET))
{
    if(!array_key_exists('show',$_GET))
    {
        $stmt = $db->prepare('SELECT posts.IDpost,posts.points,title,IDphoto,ext FROM posts LEFT JOIN photos ON posts.IDpost=photos.IDpost RIGHT JOIN favoritedposts ON favoritedposts.IDpost=posts.IDpost WHERE favoritedposts.IDuser=:id GROUP BY title;');
        $stmt->bindValue(':id', $_SESSION['id']);
        $stmt->execute();
    }
    else if($_GET['show']=='favorited')
    {
        $stmt = $db->prepare('SELECT posts.IDpost,posts.points,title,IDphoto,ext FROM posts LEFT JOIN photos ON posts.IDpost=photos.IDpost RIGHT JOIN favoritedposts ON favoritedposts.IDpost=posts.IDpost WHERE favoritedposts.IDuser=:id GROUP BY title;');
        $stmt->bindValue(':id', $_SESSION['id']);
        $stmt->execute();
    }
    else if($_GET['show']=='self')
    {
        $stmt = $db->prepare('SELECT posts.IDpost,posts.points,title,IDphoto,ext FROM posts LEFT JOIN photos ON posts.IDpost=photos.IDpost RIGHT JOIN userposts ON userposts.IDpost=posts.IDpost WHERE userposts.IDuser=:id GROUP BY title;');
        $stmt->bindValue(':id', $_SESSION['id']);
        $stmt->execute();
    }
}
else
{
    if(!array_key_exists('show',$_GET))
    {
        $stmt = $db->prepare('SELECT posts.IDpost,posts.points,title,IDphoto,ext,description FROM posts LEFT JOIN photos ON posts.IDpost=photos.IDpost RIGHT JOIN favoritedposts ON favoritedposts.IDpost=posts.IDpost WHERE favoritedposts.IDuser=:id && favoritedposts.IDpost=:idPost;');
        $stmt->bindValue(':id', $_SESSION['id']);
        $stmt->bindValue(':idPost', $_GET['id']);
        $stmt->execute();
    }
    else if($_GET['show']=='favorited')
    {
        $stmt = $db->prepare('SELECT posts.IDpost,posts.points,title,IDphoto,ext,description FROM posts LEFT JOIN photos ON posts.IDpost=photos.IDpost RIGHT JOIN favoritedposts ON favoritedposts.IDpost=posts.IDpost WHERE favoritedposts.IDuser=:id && favoritedposts.IDpost=:idPost;');
        $stmt->bindValue(':id', $_SESSION['id']);
        $stmt->bindValue(':idPost', $_GET['id']);
        $stmt->execute();
    }
    else if($_GET['show']=='self')
    {
        $stmt = $db->prepare('SELECT posts.IDpost,posts.points,title,IDphoto,ext,description FROM posts LEFT JOIN photos ON posts.IDpost=photos.IDpost RIGHT JOIN userposts ON userposts.IDpost=posts.IDpost WHERE userposts.IDuser=:id && userposts.IDpost=:idPost;');
        $stmt->bindValue(':id', $_SESSION['id']);
        $stmt->bindValue(':idPost', $_GET['id']);
        $stmt->execute();
    }
}

?>