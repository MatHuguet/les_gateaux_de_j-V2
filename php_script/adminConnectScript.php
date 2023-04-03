<?php 
//DSN
require_once('../const/const.php');
$dsn = "mysql:dbname=".DB_NAME.";host=".DB_HOST;
try {
$dbco = new PDO($dsn, DB_USER,DB_PASS);
$dbco->exec("SET NAMES utf8"); //ajuste les valeurs en UTF8 pour une meilleur écriture et lecture
//définir le mode de lecture fetch() des données :
$dbco->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); //le mode de fetch par défaut est
//défini sur "associatif"

} catch(PDOException $e){
die("Erreur : ".$e->getMessage());
}
//======================================================================
//On récupère l'username:
//on vérifie que les cases sont bien remplies:
    if (!isset($_POST['username']) && $_POST['password'] && empty($_POST['username']
    && empty($_POST['password'])))
    {
        die('Erreur : merci de remplir les identifiants');
    }
    $sql = "SELECT admin FROM administration WHERE admin = :useradmin";
    $query = $dbco->prepare($sql);
    $query->bindValue(":useradmin", $_POST['username'], PDO::PARAM_STR);
    $query->execute();
    $useradmin = $query->fetch();
    
    if (!$useradmin){
        echo "Erreur : l'utilisateur et/ou le mot de passe sont incorrects";
    }

    if ($_POST['username'] === $useradmin['admin']){
        $admin = $useradmin['admin'];
        echo "Bienvenue '.$admin.'<br>";
    }
    $sql = "SELECT password FROM administration WHERE admin = $admin";

    
?>