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
        <form action="index.php?action=adduser" method="POST" class="main">
                <fieldset>
                    <ul>
                        <li>
                            <label>Name</label>
                            <input type='text' name='name'><br>
                        </li>
                        <li>
                            <label>SurName</label>
                            <input type='text' name='surname'><br>
                        </li>
                        <li>
                            <label>Login</label>
                            <input type='text' name='login'><br>
                        </li>
                        <li>
                            <label>Password</label>
                            <input type='password' name='password'><br>
                        </li>
                        <li>
                            <label for="perms">Permission</label>
                            <select id="perms" name="permission">
                            <option value="reader">reader</option>
                            <option value="admin">admin</option>
                            </select>
                        </li>
                        <li>
                            <label>Wiek</label>
                            <input type='number' name='age' min='19' max='50'><br>
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