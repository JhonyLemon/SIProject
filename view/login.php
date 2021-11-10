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
        </header>
        <section>
            <h1>Rejestracja</h1> 
            <form action="index.php?action=form" method="POST" class="main">
                <fieldset>
                    <ul>
                        <li>
                            <label>Login</label>
                            <input type='text' name='log'><br>
                        </li>
                        <li>
                            <label>Password</label>
                            <input type='password' name='pass'><br>
                        </li>
                        <li>
                            <label>Wiek</label>
                            <input type='number' name='age' min='1' max='200'><br>
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
            <p>© Footer</p>
        </footer>
</body> 
</html> 