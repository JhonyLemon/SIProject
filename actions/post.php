<?php
if(isset($_SESSION['user']))
{
if(isset($_GET['id']))
{
    try { 
    $db->beginTransaction();
    $add = $db->prepare('INSERT INTO borrowedbooks (iduser, idbook) VALUES(:user, :book)');
    $add->bindValue(':user', $_SESSION['id'], PDO::PARAM_INT); 
    $add->bindValue(':book', $_GET['id'], PDO::PARAM_INT); 
    $add->execute();
    $add->closeCursor();
    $db->commit();
    $ok='Wypożyczono książkę';
    }
    catch(PDOException $e)
    {
        $db->rollBack();
        $alert='Operacja nie powiodła się';
    }
    
}
$stmt = $db->prepare("SELECT idbook FROM borrowedbooks WHERE iduser=:id");
$stmt->bindValue(':id', $_SESSION['id'], PDO::PARAM_INT); 
$stmt->execute();
$user_books = $stmt->fetchAll();
$stmt = null;
$stmt = $db->prepare("SELECT * FROM book");
$stmt->execute();
}
else
redirect('form');
?>
