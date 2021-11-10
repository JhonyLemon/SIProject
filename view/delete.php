        <section>
            <?php include(_ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'alert.php'); ?>  
            <h1>Użytkownicy</h1>
            <form action=<?php echo"index.php?action=users&id={$_GET['id']}&do={$_GET['do']}"?> method="POST" class="main">
                <fieldset>
                    <ul>
                        <li>
                            <p>Czy jesteś pewien że chcesz usunąć użytkownika, jest to nie odwracalna operacja</p>
                            <input type='submit' value='Usuń' name='delete'>
                        </li>
                    </ul>
                </fieldset>
            </form>    
        </section>