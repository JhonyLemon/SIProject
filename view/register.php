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
                            <?php if (array_key_exists('login',$Error)): ?> 
                            <label class="error"><?php echo $Error['login'] ?></label><?php endif; ?>
                        </li>
                        <li>
                            <label>E-mail</label>
                            <input type='email' name='email'><br>
                            <?php if (array_key_exists('email',$Error)): ?> 
                            <label class="error"><?php echo $Error['email'] ?></label><?php endif; ?>
                        </li>
                        <li>
                            <label>Password</label>
                            <input type='password' name='password'><br>
                            <?php if (array_key_exists('password',$Error)): ?> 
                            <label class="error"><?php echo $Error['password'] ?></label><?php endif; ?>
                        </li>
                        <li>
                            <label>Birthday</label>
                            <input type='date' name='birthday' maxlength='40'><br>
                        </li>
                        <li>
                            <?php if (array_key_exists('action',$Error)): ?> 
                            <label class="error"><?php echo $Error['action'] ?></label><?php endif; ?>
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