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
            <h1>Rejestracja</h1> 
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
                            <label>Repeat password</label>
                            <input type='password' name='rpassword'><br>
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
                    </ul>
                    <input type='submit' value='Register' name='submit'>
                    <?php if (array_key_exists('ok',$info)): ?> 
                    <label class="ok"><?php echo $info['ok'] ?></label><?php endif; ?>
                           
                </fieldset>
            </form>        
        </section>
</body> 
</html> 