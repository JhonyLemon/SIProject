<?php

if($_SESSION['permission']=='admin')
{
$stmt = $db->query("SELECT * FROM users");

if(array_key_exists('do',$_GET) && array_key_exists('id',$_GET))
{
    if(isset($_POST))
    {
        if(array_key_exists('edit',$_POST))
        {
            try 
            { 
                $db->beginTransaction();
                    $stmt = $db->prepare("UPDATE users SET points=:points WHERE IDuser=:IDuser");
                    $stmt->bindValue(':IDuser', $_GET['id']);
                    $stmt->bindValue(':points', $_POST['points']);
                    $stmt->execute();
                    $stmt->closeCursor();
                $db->commit();
                unset($_POST);
                redirect('users');
            }
            catch(Expection $e)
            {
                $db->rollBack();
                $Error='Unexpected error occured';
            }
        }
        else if(array_key_exists('delete',$_POST))
        {
            try 
            { 
                $db->beginTransaction();
                    $stmt = $db->prepare("DELETE FROM users WHERE IDuser=:IDuser");
                    $stmt->bindValue(':IDuser', $_GET['id']);
                    $stmt->execute();
                    $stmt->closeCursor();
                $db->commit();
                unset($_POST);
                redirect('users');
            }
            catch(Expection $e)
            {
                $db->rollBack();
                $Error='Unexpected error occured';
            }
        }
    }

    if($_GET['do']=='view')
    {
        $st = $db->prepare('SELECT posts.IDpost,title,IDphoto,ext,description,points,valid FROM posts LEFT JOIN photos ON posts.IDpost=photos.IDpost RIGHT JOIN userposts ON posts.IDpost=userposts.IDpost WHERE userposts.IDuser=:id');
        $st->bindValue(':id', $_GET['id']);
        $st->execute();
        $previous=0;
    }
    elseif($_GET['do']=='delete')
    {
        $st = $db->prepare("SELECT login FROM users WHERE IDuser=:id");
        $st->bindValue(':id', $_GET['id']);
        $st->execute();
        $user=$st->fetch();
    }
    elseif($_GET['do']=='edit')
    {
        $st = $db->prepare('SELECT points FROM users WHERE IDuser=:id');
        $st->bindValue(':id', $_GET['id']);
        $st->execute();
        $points=$st->fetch();
        if(!$points)
            $points=0;
    }

}

}
?>