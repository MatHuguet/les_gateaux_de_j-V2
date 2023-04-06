<?php
if (isset($_SESSION['admin'])) {
    if ($_SESSION['admin'] === 'JulieS') {
        echo '<h2>Bienvenue! Connecté en tant que '. $_SESSION['admin'].'</h2><br>';
        include('./php-components/admin-main-menu.php');
    }

} else {
    echo '<h2>Bienvenue !</h2>';
}