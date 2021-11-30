<!DOCTYPE html> 
<html> 
<head> 
<link rel="stylesheet" href="style.css" />
<meta charset="utf-8" /> 
<meta name="description" content="Opis strony" /> 
<meta name="keywords" content="Wyrazy kluczowe" /> 
<title>Tytuł strony</title> 
</head> 
<body> 
        <section>
                <?php if(array_key_exists('do',$_GET) && array_key_exists('id',$_GET)): ?>
                        <?php if($_GET['do']=='view'): ?>
                                <?php include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'view.php'); ?>
                        <?php elseif($_GET['do']=='delete'): ?>
                                <?php include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'delete.php'); ?>
                        <?php elseif($_GET['do']=='edit'): ?>      
                                <?php include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'edit.php'); ?>  
                        <?php endif; ?>
                <?php else: ?>
                        <?php include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'user_table.php'); ?>
                <?php endif; ?>
        </section>
</body> 
</html>