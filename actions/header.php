            <div id="buttons">
                <?php 
                if (array_key_exists('user', $_SESSION))
                {
                    switch($_SESSION['perm'])
                    {
                        case 'admin':
                            {
                                echo '<a class=button href=index.php?action=books>Książki</a>';
                                echo '<a class=button href=index.php?action=users>Użytkownicy</a>';
                                echo '<a class=button href=index.php?action=addbook>Dodaj Książkę</a>';
                                echo '<a class=button href=index.php?action=adduser>Dodaj użytkownika</a>';
                                echo '<a class=button href=index.php?action=logout>Wyloguj</a>';
                                break;
                            }
                        case 'reader':
                            {
                                echo '<a class=button href=index.php?action=books>Książki</a>';
                                echo '<a class=button href=index.php?action=borrowedbooks>Książki Pożyczone</a>';
                                echo '<a class=button href=index.php?action=logout>Wyloguj</a>';
                                break;
                            }
                        default:
                        {
                            echo '<a class=button href=index.php?action=logout>Wyloguj</a>';
                            break;
                        }
                    }
                }
                ?>       
            </div>