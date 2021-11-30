<?php
$do='';

if(!isset($_GET['id']))
{
    $_GET['id']=RandomID($db);
    redirect("random&id={$_GET['id']}");
}
else if(!isset($_POST))
{
    $_GET['id']=RandomID($db);
    redirect("random&id={$_GET['id']}");
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
        }
    }

}
else if(array_key_exists('comment',$_POST) && isset($_SESSION['id']))
{
    $db->beginTransaction();
    $stmt = $db->prepare("INSERT INTO comments (IDparent,IDuser,IDpost,text) VALUES (:IDparent,:IDuser,:IDpost,:text)");
    $stmt->bindValue(':IDparent', 0);
    $stmt->bindValue(':IDuser', $_SESSION['id']);
    $stmt->bindValue(':IDpost', $_GET['id']);
    $stmt->bindValue(':text', $_POST['comment']);
    $stmt->execute();
    $stmt->closeCursor();
$db->commit();
unset($_POST);
}
else if(array_key_exists('ID',$_POST) && isset($_SESSION['id']))
{
    if(array_key_exists('text',$_POST))
    {
        try 
        { 
            $db->beginTransaction();
                $stmt = $db->prepare("INSERT INTO comments (IDparent,IDuser,IDpost,text) VALUES (:IDparent,:IDuser,:IDpost,:text)");
                $stmt->bindValue(':IDparent', $_POST['ID']);
                $stmt->bindValue(':IDuser', $_SESSION['id']);
                $stmt->bindValue(':IDpost', $_GET['id']);
                $stmt->bindValue(':text', $_POST['text']);
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
        $idcomment=explode('.',$_POST['ID']);
        $stmt = $db->prepare("SELECT vote FROM likedcomments WHERE IDuser=:IDuser && IDcomment=:IDcomment");
        $stmt->bindValue(':IDuser', $_SESSION['id']);
        $stmt->bindValue(':IDcomment', $idcomment['1']);
        $stmt->execute();
        $likedcomments=$stmt->fetch();
        var_dump($likedcomments);
        var_dump($_POST['ID']);
        if(!$likedcomments)
        {
            try 
            { 
                $db->beginTransaction();
                    $stmt = $db->prepare("INSERT INTO likedcomments (IDcomment,IDuser,vote) VALUES (:IDcomment,:IDuser,:vote)");
                    $stmt->bindValue(':IDuser', $_SESSION['id']);
                    $stmt->bindValue(':IDcomment', $idcomment['1']);
                    if($idcomment['0']=='CommentUpVote')
                    $stmt->bindValue(':vote', 1);
                    else
                    $stmt->bindValue(':vote', 0);
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
            if($likedcomments['vote']==1)
            {
                if($idcomment['0']=='CommentUpVote')
                {
                    try 
                    { 
                        $db->beginTransaction();
                            $stmt = $db->prepare("DELETE FROM likedcomments WHERE IDuser=:IDuser && IDcomment=:IDcomment");
                            $stmt->bindValue(':IDuser', $_SESSION['id']);
                            $stmt->bindValue(':IDcomment', $idcomment['1']);
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
                            $stmt = $db->prepare("UPDATE likedcomments SET vote=0 WHERE IDuser=:IDuser && IDcomment=:IDcomment");
                            $stmt->bindValue(':IDuser', $_SESSION['id']);
                            $stmt->bindValue(':IDcomment', $idcomment['1']);
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
            else
            {
                if($idcomment['0']=='CommentUpVote')
                {
                    try 
                    { 
                        $db->beginTransaction();
                            $stmt = $db->prepare("UPDATE likedcomments SET vote=1 WHERE IDuser=:IDuser && IDcomment=:IDcomment");
                            $stmt->bindValue(':IDuser', $_SESSION['id']);
                            $stmt->bindValue(':IDcomment', $idcomment['1']);
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
                            $stmt = $db->prepare("DELETE FROM likedcomments WHERE IDuser=:IDuser && IDcomment=:IDcomment");
                            $stmt->bindValue(':IDuser', $_SESSION['id']);
                            $stmt->bindValue(':IDcomment', $idcomment['1']);
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

    }
}

    $stmt = $db->prepare('SELECT points FROM posts WHERE IDpost=:id');
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();
    $points=$stmt->fetch();

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

    $stmt = $db->prepare('SELECT likedcomments.IDcomment,vote FROM likedcomments LEFT JOIN comments ON comments.IDcomment=likedcomments.IDcomment WHERE IDpost=:id AND likedcomments.IDuser=:IDuser');
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->bindValue(':IDuser', $_SESSION['id']);
    $stmt->execute();
    $voteComments=$stmt->fetchAll();

    $stmt = $db->prepare('SELECT valid FROM posts WHERE IDpost=:id && valid=0');
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();
    $valid=$stmt->fetch();
    }

    $stmt = $db->prepare('SELECT IDcomment,IDparent,text,comments.points,login FROM comments LEFT JOIN users ON comments.IDuser=users.IDuser  WHERE IDpost=:id');
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();
    $comments=$stmt->fetchAll();
    $sortedComments=array();
    for($i=0; $i<count($comments); $i++)
    {
        if($comments[$i]['IDparent']==0)
        {
        $sortedComments[]=$comments[$i];
        GetChildComments($comments[$i]['IDcomment'],$i,$comments,$sortedComments);
        }
    }

    $stmt = $db->prepare('SELECT posts.IDpost,title,IDphoto,ext,description,points FROM posts LEFT JOIN photos ON posts.IDpost=photos.IDpost WHERE posts.IDpost=:id');
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();

?>