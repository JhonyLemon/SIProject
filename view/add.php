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
        <h1>Utwórz post</h1><br>
        <?php
        var_dump($_FILES['file']['name']);
        ?>
        <form action="index.php?action=add" method="POST" enctype="multipart/form-data" class="main">
        <fieldset>
                    <ul>
                        <li>
                            <label>Title</label> 
                            <input type="text" name="title" value=""><br>
                            <?php if (array_key_exists('title',$errors)): ?> 
                            <label class="error"><?php echo $errors['title'] ?></label><?php endif; ?>
                        </li>
                        <li>
                            <label>Description</label> 
                            <textarea name="description" rows="4" cols="50"></textarea><br>
                            <?php if (array_key_exists('descriptio',$errors)): ?> 
                            <label class="error"><?php echo $errors['description'] ?></label><?php endif; ?>

                        </li>
                        <li>
                            <label>Select file</label> 
                            <input type="file" name="file" accept="image/jpeg"><br>
                            <?php if (array_key_exists('file',$errors)): ?> 
                            <label class="error"><?php echo $errors['file'] ?></label><?php endif; ?>
                        </li>
                        <li>
                            <input type="submit" value="Dodaj" name='submit'>
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
