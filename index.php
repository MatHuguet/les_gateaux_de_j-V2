<?php
require('php_script/db_conn.php');
// include('php_script/admin-verify.php');

$title = "Accueil";


include './php-components/header.php';



include './php-components/navbar.php';

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';

include './php-components/footer.php';


?>