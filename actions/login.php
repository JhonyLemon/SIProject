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
        $Error['password']= 'Login field cannot be empty'; 
    }
    if(count($Error)==0)
    {
        $stmt = $db->prepare('SELECT IDuser,login,birthday,permission FROM users WHERE login = :login AND password=:password');
        $stmt->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
        $stmt->bindValue(':password', sha1($_POST['password']), PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch();
        if ($user!=0)
        {
            $_SESSION["id"]=$user['id'];
            $_SESSION["login"]=$user['login'];
            $_SESSION["permission"]=$user['permission'];
            $_SESSION["birthday"]=$user['birthday'];
            redirect('home');
        } else {
            $Error= 'Login or password is incorrect'; 
        }
    }
}
?>