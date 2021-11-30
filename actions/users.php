<?php

if($_SESSION['permission']=='admin')
{
$stmt = $db->query("SELECT * FROM users");

if(array_key_exists('do',$_GET) && array_key_exists('id',$_GET))
{
    if($_GET['do']=='view')
    {
        $st = $db->prepare('SELECT posts.IDpost,title,IDphoto,ext,description,points,valid FROM posts LEFT JOIN photos ON posts.IDpost=photos.IDpost RIGHT JOIN userposts ON posts.IDpost=userposts.IDpost WHERE userposts.IDuser=:id');
        $st->bindValue(':id', $_GET['id']);
        $st->execute();
        $previous=0;
    }
    elseif($_GET['do']=='delete')
    {

    }
    elseif($_GET['do']=='edit')
    {

    }
}

}
?>