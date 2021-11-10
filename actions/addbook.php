<?php
if(isset($_SESSION['perm']) && $_SESSION['perm']=='admin')
{
    if (isset($_POST['submit']))
    {
        $Error='';
        if (empty($_POST['title']))
        {
            $Error.= 'Tytuł jest wymagany<br>';
        }
        if (empty($_POST['author']))
        {
            $Error.= 'Autorzy są wymagani<br>';
        }
        if (empty($_POST['number']))
        {
            $Error.= 'Liczba egzemplarzy jest wymagana<br>';
        }
        if($Error=='')
        {
            try { 
                $db->beginTransaction();
                $add = $db->prepare('INSERT INTO book (title,authors,number) VALUES(:title,:authors,:number)');
                $add->bindValue(':title', $_POST['title'], PDO::PARAM_STR); 
                $add->bindValue(':authors', $_POST['author'], PDO::PARAM_STR); 
                $add->bindValue(':number', $_POST['number'], PDO::PARAM_INT); 
                $add->execute();
                $add->closeCursor();
                $add = null;
                $db->commit();
                $ok='Dodano książkę';
            }
            catch(PDOException $e)
            {
                $db->rollBack();
                $alert='Operacja nie powiodła się';
            }
        }
    }
}
else
{
    redirect('form');
}

?>