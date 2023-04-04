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
//Création de la table si elle n'existe pas :

$sql = "CREATE TABLE IF NOT EXISTS administration (admin VARCHAR(100), password VARCHAR(100)" ;
$q = $dbco->query($sql);
$sql = "INSERT INTO `administration` (`admin`, `password`) VALUES (`:adminName`, `:adminPass`)";
$q = $dbco->prepare($sql);
$q->bindValue(':adminName', 'JulieS', PDO::PARAM_STR);
$q->bindValue(':adminPass', 'mamour', PDO::PARAM_STR);
$q->execute();

//======================================================================
//On récupère l'username:
//on vérifie que les cases sont bien remplies:
    //1:Vérifier le bouton submit:
        if(isset($_POST["submit"])){
            if(empty($_POST["username"])) {
                die( "Merci de remplir les champs pour vous connecter");
            }
            if(empty($_POST['password'])){
                die("Merci de remplir les champs pour vous connecter");
            }
            $admin_sql = "SELECT * FROM `administration` WHERE `admin` = :admin";
            $admin_request = $dbco->prepare($admin_sql);
            $admin_request->bindValue(":admin", $_POST["username"], PDO::PARAM_STR);
            $admin_request->execute();
            $admin = $admin_request->fetch();
            echo "<pre>";
            var_dump($admin);
            echo "</pre>";
            echo $admin['password'];
            echo $_POST['password'];
            //Si l'utilisateur n'existe pas:
            if(!$admin) {
              die("Utilisateur non trouvé");  
            }
            //Si l'utilisateur existe, on peut vérifier le mot de passe :
            echo "<pre>";
            var_dump($_POST);
            echo "</pre>";
            var_dump($admin['password']);
            echo "<pre>";
            var_dump(password_verify($_POST['password'], $admin['password']));
            echo "</pre>";
            if($_POST['password'] === $admin['password']){
                echo "ça marche comme ça";
            }
            
            // echo $admin['password'];
            // $admin_request->bindValue(":admin", "$useradmin");
            // $admin_request->execute();
            
            // if(!$admin){
            //     echo "L'utilisateur et/ou le mot de passe sont incorrects";
            // }

            // $userpass = strip_tags($_POST['password']);
            // $pass_sql = ('SELECT password FROM administration WHERE admin = $admin');
            // $pass_request = $dbco->query($pass_sql);
            // $pass_request->fetch();
            // print_r($pass_request);










        }

    // if (!isset($_POST['username']) && empty($_POST['username']
    // ))
    // {
    //     die('Erreur : merci de remplir les identifiants');
    // }
    // $sql = "SELECT admin FROM administration WHERE admin = :useradmin";
    // $query = $dbco->prepare($sql);
    // $query->bindValue(":useradmin", $_POST['username'], PDO::PARAM_STR);
    // $query->execute();
    // $useradmin = $query->fetch();
    
    // if (!$useradmin){
    //     echo "Erreur : l'utilisateur et/ou le mot de passe sont incorrects";
    // }

    // if ($_POST['username'] === $useradmin['admin']){
    //     $admin = $useradmin['admin'];
    //     echo "Bienvenue '.$admin.'";
    // }
    // //Vérification du mot de passe
    // $sql = "SELECT password FROM administration WHERE admin = $admin";

    
?>