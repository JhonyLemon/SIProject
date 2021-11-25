        <header>
            <div id="buttons">
                <?php 
                if (array_key_exists('permission', $_SESSION))
                {
                    switch($_SESSION['permission'])
                    {
                        case 'admin':
                            {
                                echo '<a class=button href=index.php?action=home>Główna</a>';
                                echo '<a class=button href=index.php?action=lobby>Poczekalnia</a>';
                                echo '<a class=button href=index.php?action=random>Losuj</a>';
                                echo '<a class=button href=index.php?action=add>Utwórz post</a>';
                                echo '<a class=button href=index.php?action=users>Użytkownicy</a>';
                                echo '<a class=button href=index.php?action=postval>Walidacja</a>';
                                echo '<a class=button href=index.php?action=settings>Ustawienia</a>';
                                echo '<a class=button href=index.php?action=logout>Wyloguj</a>';
                                break;
                            }
                        case 'moderator':
                            {
                                echo '<a class=button href=index.php?action=home>Główna</a>';
                                echo '<a class=button href=index.php?action=lobby>Poczekalnia</a>';
                                echo '<a class=button href=index.php?action=random>Losuj</a>';
                                echo '<a class=button href=index.php?action=add>Utwórz post</a>';
                                echo '<a class=button href=index.php?action=postval>Walidacja</a>';
                                echo '<a class=button href=index.php?action=settings>Ustawienia</a>';
                                echo '<a class=button href=index.php?action=logout>Wyloguj</a>';
                                break;
                            }
                        case 'user':
                            {
                                echo '<a class=button href=index.php?action=home>Główna</a>';
                                echo '<a class=button href=index.php?action=lobby>Poczekalnia</a>';
                                echo '<a class=button href=index.php?action=random>Losuj</a>';
                                echo '<a class=button href=index.php?action=add>Utwórz post</a>';
                                echo '<a class=button href=index.php?action=settings>Ustawienia</a>';
                                echo '<a class=button href=index.php?action=logout>Wyloguj</a>';
                                break;
                            }
                        default:
                        {
                            echo '<a class=button href=index.php?action=home>Główna</a>';
                            echo '<a class=button href=index.php?action=lobby>Poczekalnia</a>';
                            echo '<a class=button href=index.php?action=random>Losuj</a>';
                            echo '<a class=button href=index.php?action=login>Logowanie</a>';
                            echo '<a class=button href=index.php?action=logout>Rejestracja</a>';
                            break;
                        }
                    }
                }
                else
                {
                    echo '<a class=button href=index.php?action=home>Główna</a>';
                    echo '<a class=button href=index.php?action=lobby>Poczekalnia</a>';
                    echo '<a class=button href=index.php?action=random>Losuj</a>';
                    echo '<a class=button href=index.php?action=login>Logowanie</a>';
                    echo '<a class=button href=index.php?action=register>Rejestracja</a>'; 
                }
                ?>       
            </div>
        </header>