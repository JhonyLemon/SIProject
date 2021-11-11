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
            <h1>Register</h1> 
            <form action="index.php?action=register" method="POST" class="main">
                <fieldset>
                    <ul>
                        <li>
                            <label>Login</label>
                            <input type='text' name='login'><br>
                        </li>
                        <li>
                            <label>E-mail</label>
                            <input type='email' name='email'><br>
                        </li>
                        <li>
                            <label>Password</label>
                            <input type='password' name='password'><br>
                        </li>
                        <li>
                            <label>Birthday</label>
                            <input type='date' name='birthday' maxlength='40'><br>
                        </li>
                        <li>
                            <?php if (isset($Error)): ?> 
                            <label class="error"><?php echo $Error ?></label><?php endif; ?>
                        </li>
                        <li>
                            <input type='submit' value='Register' name='submit'>
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