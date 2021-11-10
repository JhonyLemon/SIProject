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
        <section>
        <?php include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'alert.php'); ?>  
        <form action="index.php?action=addbook" method="POST" class="main">
                <fieldset>
                    <ul>
                        <li>
                            <label>Title</label>
                            <input type='text' name='title'><br>
                        </li>
                        <li>
                            <label>Authors</label>
                            <input type='text' name='author'><br>
                        </li>
                        <li>
                            <label>Number</label>
                            <input type='number' name='number' min='0' max='200'><br>
                            <?php if (isset($Error)): ?> 
                            <label class="error"><?php echo $Error ?></label><?php endif; ?>
                        </li>
                        <li>
                            <input type='submit' value='Prześlij' name='submit'>
                        </li>
                    </ul>
                </fieldset>
            </form> 
        </section>
        <footer>
            <?php include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'footer.php'); ?>
        </footer>
</body> 
</html>