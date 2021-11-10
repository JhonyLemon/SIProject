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
        <header>
            <?php include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'header.php'); ?>      
        </header>
            <?php if(!array_key_exists('id',$_GET) && !array_key_exists('do',$_GET)): ?>
            <?php include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'userstable.php'); ?>
            <?php elseif(array_key_exists('id',$_GET) && array_key_exists('do',$_GET)): ?>
            <?php include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.$do.'.php'); ?>
            <?php endif;?>
        <footer>
            <?php include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'footer.php'); ?>
        </footer>
</body> 
</html>