<?php
$do='';

if(isset($_GET['id']))
{
    $stmt = $db->prepare("SELECT IDpost,valid FROM posts WHERE IDpost=(SELECT MIN(IDpost) FROM posts WHERE IDpost>:id)");
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();
    $next=$stmt->fetch();

    $stmt = $db->prepare("SELECT IDpost,valid FROM posts WHERE IDpost=(SELECT MAX(IDpost) FROM posts WHERE IDpost<:id)");
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();
    $previous=$stmt->fetch();
}

if(array_key_exists('type',$_POST) && isset($_SESSION['id']))
{
    $temp=explode('.',$_POST['type']);
    if(array_key_exists('1',$temp))
    {
        
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
    else
    {
        if($temp['0']=='validate')
        {
            try 
            { 
                $db->beginTransaction();
                    $stmt = $db->prepare('UPDATE posts SET valid=1 WHERE IDpost=:idpost && valid=:valid');
                    $stmt->bindValue(':valid', $_GET['valid']);
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
        else if($temp['0']=='delete')
        {
            
            $stmt = $db->prepare('SELECT IDphoto,ext FROM posts LEFT JOIN photos ON posts.IDpost=photos.IDpost WHERE posts.IDpost=:id && valid=:valid');
            $stmt->bindValue(':valid', $_GET['valid']);
            $stmt->bindValue(':id', $_GET['id']);
            $stmt->execute();
            $files=$stmt->fetchAll();
            var_dump($files);
            for($i=0; $i<count($files); $i++)
            {
                unlink(_PHOTO_PATH.DIRECTORY_SEPARATOR.$files[$i]['IDphoto'].'.'.$files[$i]['ext']);
            }
            try 
            { 
                $db->beginTransaction();
                    $stmt = $db->prepare('DELETE FROM posts WHERE IDpost=:idpost && valid=:valid');
                    $stmt->bindValue(':valid', $_GET['valid']);
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
            /*
            if($next)
            {
                //var_dump("post&id={$next['IDpost']}&valid={$next['valid']}");
                header("Location:index.php?action=post&id={$next['IDpost']}&valid={$next['valid']}",TRUE,301);
                exit();
            //redirect("post&id={$next['IDpost']}&valid={$next['valid']}");
            }
            else if($previous)
            {
                //var_dump("post&id={$previous['IDpost']}&valid={$previous['IDpost']}");
                header("Location:index.php?action=post&id={$previous['IDpost']}&valid={$previous['IDpost']}",TRUE,301);
                exit();
            //redirect("post&id={$previous['IDpost']}&valid={$previous['IDpost']}");
            }
            else
            {
            redirect("home");
            }
            */
        }
    }

}



if(isset($_GET['id']))
{
    $stmt = $db->prepare('SELECT points FROM posts WHERE IDpost=:id');
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();
    $points=$stmt->fetch();

    $stmt = $db->prepare('SELECT valid FROM posts WHERE IDpost=:id && valid=0');
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();
    $valid=$stmt->fetch();

    if(isset($_SESSION['id']))
    {
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
    }

    $stmt = $db->prepare('SELECT posts.IDpost,title,IDphoto,ext,description,points FROM posts LEFT JOIN photos ON posts.IDpost=photos.IDpost WHERE posts.IDpost=:id && valid=:valid');
    $stmt->bindValue(':valid', $_GET['valid']);
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();

}
?>