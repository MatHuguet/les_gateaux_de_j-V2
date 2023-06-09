<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title><?= $title ?></title>
</head>

<body>
    <header>
        <div class="header">
            <img class="head-img" src="../img/logoJ_1.webp" alt="Les gâteaux de Julie">
        </div>
    </header>

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

$sql = "CREATE TABLE IF NOT EXISTS administration(
    Id INT AUTO_INCREMENT PRIMARY KEY,
    admin VARCHAR(100), 
    password VARCHAR(100)
    )" ;


$q = $dbco->query($sql);
$sql = "INSERT INTO administration(
    admin, 
    password) 
    VALUES (:adminName, :adminPass)";
$q = $dbco->prepare($sql);
$q->bindValue(':adminName', 'JulieS', PDO::PARAM_STR);
$q->bindValue(':adminPass', 'mamour', PDO::PARAM_STR);
$q->execute();

$sql = "DELETE FROM administration WHERE `Id` > 1";
$q = $dbco->query($sql);

//======================================================================
//On récupère l'username:
//on vérifie que les cases sont bien remplies:
    //1:Vérifier le bouton submit:
        if(isset($_POST["submit"])){
            if(empty($_POST["username"])) {
                die( "Merci de remplir les champs pour vous connecter");
            }
            if(empty($_POST['password'])){
                echo "Merci de remplir les champs pour vous connecter";
                echo "<p>Revenir à la page de <a href='index.php'>connexion</a></p>";
            }
            $admin_sql = "SELECT * FROM `administration` WHERE `admin` = :admin";
            $admin_request = $dbco->prepare($admin_sql);
            $admin_request->bindValue(":admin", $_POST["username"], PDO::PARAM_STR);
            $admin_request->execute();
            $admin = $admin_request->fetch();
            

            //Si l'utilisateur n'existe pas:
            if(!$admin) {
              echo "Utilisateur non trouvé"; 
              echo "<p>Revenir à la page de <a href='../connect.php'>connexion</a></p>";
            }
            //Si l'utilisateur existe, on peut vérifier le mot de passe :

            if($_POST['password'] !== $admin['password']){
                echo "Nom d'utilisateur et/ou mot de passe incorrects";
                echo "<p>Revenir à la page de <a href='../connect.php'>connexion</a></p>";
                die();
            } else {
                session_start();
                echo "ça marche comme ça";
                
                $_SESSION['admin'] = $admin['admin']; 
                header('Location:../index.php');
            }
        }


    include_once('../php-components/footer.php');
?>