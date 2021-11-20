<?php

if(array_key_exists('type',$_POST))
{
    $temp=explode('.',$_POST['type']);
    if($temp['1']=='ON')
    {
        if($temp['0']=='upvote')
        {
            try 
            { 
                $db->beginTransaction();
                    $stmt = $db->prepare('INSERT INTO likedposts (IDuser,IDpost,vote) VALUES (:iduser,:idpost,1)');
                    $stmt->bindValue(':iduser', $_SESSION['id']);
                    $stmt->bindValue(':idpost', $_GET['id']);
                    //$stmt->bindValue(':vote', 1);
                    $stmt->execute();
                    $stmt->closeCursor();
                $db->commit();
                unset($_POST);
            }
            catch(Exception $e)
            {
                $db->rollBack();
                $Error='Unexpected error occured: '.$e;
            }    
        }
        else if($temp['0']=='downvote')
        {
            try 
            { 
                $db->beginTransaction();

                    $stmt = $db->prepare('INSERT INTO likedposts (IDuser,IDpost,vote) VALUES (:iduser,:idpost,0)');
                    $stmt->bindValue(':iduser', $_SESSION['id']);
                    $stmt->bindValue(':idpost', $_GET['id']);
                   // $stmt->bindValue(':vote', 0);
                    $stmt->execute();
                    $stmt->closeCursor();
                $db->commit();
                unset($_POST);
            }
            catch(Exception $e)
            {
                $db->rollBack();
                $Error='Unexpected error occured: '.$e;
            } 
        }
        else if($temp['0']=='favorite')
        {
            try 
            { 
                $db->beginTransaction();

                    $stmt = $db->prepare('INSERT INTO favoritedposts (IDuser,IDpost) VALUES (:iduser,:idpost)');
                    $stmt->bindValue(':iduser', $_SESSION['id']);
                    $stmt->bindValue(':idpost', $_GET['id']);
                    $stmt->execute();
                    $stmt->closeCursor();
                $db->commit();
                unset($_POST);
            }
            catch(Expection $e)
            {
                $db->rollBack();
                $Error='Unexpected error occured';
            } 
        }
    }
    else if($temp['1']=='OFF')
    {
        if($temp['0']=='favorite')
        {
            try 
            { 
                $db->beginTransaction();

                    $stmt = $db->prepare('DELETE FROM favoritedposts WHERE IDuser=:iduser && IDpost=:idpost');
                    $stmt->bindValue(':iduser', $_SESSION['id']);
                    $stmt->bindValue(':idpost', $_GET['id']);
                    $stmt->execute();
                    $stmt->closeCursor();
                $db->commit();
                unset($_POST);
            }
            catch(Expection $e)
            {
                $db->rollBack();
                $Error='Unexpected error occured';
            }
        }
        else
        {
            try 
            { 
                $db->beginTransaction();

                    $stmt = $db->prepare('DELETE FROM likedposts WHERE IDuser=:iduser && IDpost=:idpost');
                    $stmt->bindValue(':iduser', $_SESSION['id']);
                    $stmt->bindValue(':idpost', $_GET['id']);
                    $stmt->execute();
                    $stmt->closeCursor();
                $db->commit();
                unset($_POST);
            }
            catch(Expection $e)
            {
                $db->rollBack();
                $Error='Unexpected error occured';
            } 
        }
    }
}



if(isset($_GET['id']))
{
    $stmt = $db->prepare('SELECT points FROM posts WHERE IDpost=:id');
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();
    $points=$stmt->fetch();

    $stmt = $db->prepare('SELECT vote FROM likedposts WHERE IDuser=:iduser && IDpost=:idpost');
    $stmt->bindValue(':iduser', $_SESSION['id']);
    $stmt->bindValue(':idpost', $_GET['id']);
    $stmt->execute();
    $vote=$stmt->fetch();

    $stmt = $db->prepare('SELECT IDpost FROM favoritedposts WHERE IDuser=:iduser && IDpost=:idpost');
    $stmt->bindValue(':iduser', $_SESSION['id']);
    $stmt->bindValue(':idpost', $_GET['id']);
    $stmt->execute();
    $favorite=$stmt->fetch();

    $stmt = $db->prepare('SELECT posts.IDpost,title,IDphoto,ext,description,points FROM posts LEFT JOIN photos ON posts.IDpost=photos.IDpost WHERE posts.IDpost=:id');
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();

}
?>