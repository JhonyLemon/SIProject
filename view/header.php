<head>
    <link rel='shortcut icon' type='image/x-icon' href='logokrem.ico' />
    <title>Kremóweczka - memy do kawusi</title>
</head>
<header>
    <div id="buttons">
        <?php
        echo '<a class=button href=index.php?action=home><img class="logo" src="logo.png"></a>';
        if (array_key_exists('permission', $_SESSION)) {

            switch ($_SESSION['permission']) {
                case 'admin': {
                        echo '<a class=button href=index.php?action=home>Główna</a>';
                        echo '<a class=button href=index.php?action=lobby>Poczekalnia</a>';
                        echo '<a class=button href=index.php?action=random>Losuj</a>';
                        echo '<a class=button href=index.php?action=add>Dodaj</a>';
                        echo '<a class=button href=index.php?action=users>Użytkownicy</a>';
                        echo '<a class=button href=index.php?action=profil>Profil</a>';
                        echo '<a class=button href=index.php?action=logout>Wyloguj</a>';
                        break;
                    }
                case 'moderator': {
                        echo '<a class=button href=index.php?action=home>Główna</a>';
                        echo '<a class=button href=index.php?action=lobby>Poczekalnia</a>';
                        echo '<a class=button href=index.php?action=random>Losuj</a>';
                        echo '<a class=button href=index.php?action=add>Dodaj</a>';
                        echo '<a class=button href=index.php?action=profil>Profil</a>';
                        echo '<a class=button href=index.php?action=logout>Wyloguj</a>';
                        break;
                    }
                case 'user': {
                        echo '<a class=button href=index.php?action=home>Główna</a>';
                        echo '<a class=button href=index.php?action=lobby>Poczekalnia</a>';
                        echo '<a class=button href=index.php?action=random>Losuj</a>';
                        echo '<a class=button href=index.php?action=add>Dodaj</a>';
                        echo '<a class=button href=index.php?action=profil>Profil</a>';
                        echo '<a class=button href=index.php?action=logout>Wyloguj</a>';
                        break;
                    }
                default: {
                        echo '<a class=button href=index.php?action=home>Główna</a>';
                        echo '<a class=button href=index.php?action=lobby>Poczekalnia</a>';
                        echo '<a class=button href=index.php?action=random>Losuj</a>';
                        echo '<a class=button href=index.php?action=login>Logowanie</a>';
                        echo '<a class=button href=index.php?action=logout>Rejestracja</a>';
                        break;
                    }
            }
        } else {
            echo '<a class=button href=index.php?action=home>Główna</a>';
            echo '<a class=button href=index.php?action=lobby>Poczekalnia</a>';
            echo '<a class=button href=index.php?action=random>Losuj</a>';
            echo '<a class=button href=index.php?action=login>Logowanie</a>';
            echo '<a class=button href=index.php?action=register>Rejestracja</a>';
        }
        ?>
    </div>
</header>