<?php
$Error= array();
if (array_key_exists('user', $_SESSION)) 
{ 
    redirect('home');
}
else if (isset($_POST['submit']))
{
    if (empty($_POST['login']))
    {
        $Error['login']= 'Login field cannot be empty'; 
    }
    else
    {
        $stmt = $db->prepare('SELECT login FROM users WHERE login = :login');
        $stmt->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch();
        if ($user!=0)
            $Error['login']= 'Login is already used'; 
        }
    if (empty($_POST['password']) || empty($_POST['rpassword']))
    {
        $Error['password']= 'Passwords field cannot be empty'; 
    }
    else
    {
        if($_POST['password']!=$_POST['rpassword'])
            $Error['password']= 'Passwords arent identical'; 
    }
    if (empty($_POST['email']))
    { 
        $Error['email']= 'Email field cannot be empty'; 
    }
    else
    {
    $_POST['email']=filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
    {
        $Error['email']= 'Email is not correct'; 
    }
    }
    if(count($Error)==0)
    {
        try 
        { 
            $db->beginTransaction();
            if (empty($_POST['birthday']))
            {
                $stmt = $db->prepare('INSERT INTO users (login,password,email) VALUES (:login,:password,:email)'); 
            }
            else
            {
                $stmt = $db->prepare('INSERT INTO users (login,password,email,birthday) VALUES (:login,:password,:email,:birthday)');
                $stmt->bindValue(':birthday', $_POST['birthday']);
            }
            $stmt->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
            $stmt->bindValue(':password', password_hash($_POST['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
            $stmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
            $db->commit();
           // redirect('home');
        }
        catch(PDOException $e)
        {
            $db->rollBack();
            $Error['action']='Operacja rejestracji nie powiodła się';
        }
    }
}
?>