<?php
if (array_key_exists('user', $_SESSION)) 
{ 
    redirect('home');
}
else if (isset($_POST['submit']))
{
    $Error='';
    if (empty($_POST['log']))
    {
        $Error.= 'Login field cannot be empty'; 
    }
    if (empty($_POST['pass']))
    {
        $Error.= 'Password field cannot be empty'; 
    }
    if (empty($_POST['email']))
    { 
        $Error.= 'Email field cannot be empty'; 
    }
    if($Error=='')
    {
        $stmt = $db->prepare("SELECT id,login,password,age,permission FROM user WHERE login = :login");
        $stmt->bindValue(':login', $_POST['log'], PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch();
        if ($user && sha1($_POST['pass'])==$user['password'] && $user['age']==$_POST['age'])
        {
            $_SESSION["id"]=$user['id'];
            $_SESSION["user"]=$user['login'];
            $_SESSION["perm"]=$user['permission'];
            redirect('home');
        } else {
            $Error= 'Podane dane są błędne'; 
        }
    }
}
?>