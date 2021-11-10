        <section>
        <?php include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'alert.php'); ?>  
            <h1>Użytkownicy</h1>
            <form action=<?php echo"index.php?action=users&id={$_GET['id']}&do={$_GET['do']}"?> method="POST" class="main">
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
                            <option value="" selected disabled hidden></option>
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
                            <input type='submit' value='Zmień' name='edit'>
                        </li>
                    </ul>
                </fieldset>
            </form>      
        </section>