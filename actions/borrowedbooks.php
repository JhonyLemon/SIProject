<?php
if(isset($_SESSION['user']))
{
if(isset($_GET['id']))
{
    try { 
    $db->beginTransaction();
    $delete = $db->prepare("DELETE FROM borrowedbooks WHERE idbook=:id AND iduser=:user");
    $delete->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $delete->bindValue(':user', $_SESSION['id'], PDO::PARAM_INT);
    $delete->execute();
    $delete->closeCursor();
    $db->commit();
    $ok='Oddano książkę';
    }
    catch(PDOException $e)
    {
        $db->rollBack();
        $alert='Operacja nie powiodła się';
    }
    
}
$stmt = $db->prepare("SELECT id,title,authors FROM book RIGHT JOIN borrowedbooks ON id=idbook WHERE borrowedbooks.iduser=:id");
$stmt->bindValue(':id', $_SESSION['id'], PDO::PARAM_INT); 
$stmt->execute();
}
else
redirect('form');
?>
