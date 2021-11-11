<?php
if (array_key_exists('user', $_SESSION)) 
{ 
    redirect('home');
}
else if (isset($_POST['submit']))
{
    $Error= array();
    if (empty($_POST['login']))
    {
        $Error['login']= 'Login field cannot be empty'; 
    }
    if (empty($_POST['password']))
    {
        $Error['password']= 'Password field cannot be empty'; 
    }
    if (empty($_POST['email']))
    { 
        $Error['email']= 'Email field cannot be empty'; 
    }
    if(count($Error)==0)
    {
        try 
        { 
            $db->beginTransaction();
            if (empty($_POST['birthday']))
            {
                $stmt = $db->prepare('INSERT INTO users (IDuser,password,email) VALUES (:login,:password,:email)');
                $stmt->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
                $stmt->bindValue(':password', sha1($_POST['password']), PDO::PARAM_STR);
                $stmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
            }
            else
            {
                $stmt = $db->prepare('INSERT INTO users (IDuser,password,email,birthday) VALUES (:login,:password,:email,:birthday)');
                $stmt->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
                $stmt->bindValue(':password', sha1($_POST['password']), PDO::PARAM_STR);
                $stmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
                $stmt->bindValue(':birthday', $_POST['birthday']);
            }
            $stmt->execute();
            $stmt->closeCursor();
            $db->commit();
            redirect('home');
        }
        catch(PDOException $e)
        {
            $db->rollBack();
            $Error['action']='Operacja rejestracji nie powiodła się';
        }
    }
}
?>