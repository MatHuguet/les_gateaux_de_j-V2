<?php
include('./php-components/header.php');
if (isset($_SESSION['admin'])) {
    if ($_SESSION['admin'] === 'JulieS') {
        echo "<div class='connected-as' <p>Connecté en tant que ". $_SESSION['admin'].'<p></div><br>';
    }

} else {
    header('Location: index.php');
}




include('./const/const.php');
include('./php_script/db_conn.php');


            
echo "<h2>Ajouter la liste des ingrédients :</h2>";







include('./php-components/footer.php');
?>