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


?>
<?php
//=================if button submit is pressed : ===============================
if (isset($_POST['submit-title-desc'])) 
{
//=================query to create table if not exists in database==============
            $adsql = "CREATE TABLE IF NOT EXISTS articles (
                ArticleId INT AUTO_INCREMENT NOT NULL,
                ArticleTitle VARCHAR(50) UNIQUE NOT NULL,
                Article_short VARCHAR(255) NOT NULL,
                Article_full TEXT,
                Article_addAt VARCHAR(50) NOT NULL,
                PRIMARY KEY (ArticleId, ArticleTitle)
                )";
            $adquery = $dbco->query($adsql);
//==============================================================================
//=================Check if input are not empty : ==============================
    if (empty($_POST['article-name']) || empty($_POST['article-desc-short']))
    {
        echo "Un titre et une description courte doivent être entrés";
//=================Check if article title already exists : =====================
        
} elseif (!empty($_POST['article-name'] && !empty($_POST['article-desc-short'])))
        {   
        $article_title = ($_POST['article-name']) ;
        $short_desc = ($_POST['article-desc-short']);
        $full_desc = ($_POST['article-desc-full']);
        $articleDate = date("d-m-Y h:i");

            try {
                $sql = "INSERT INTO articles(
                    ArticleTitle, 
                    Article_short,
                    Article_full,
                    Article_addAt) 
                    VALUES (:title, :shortdesc, :fulldesc, :addat)";
                $add = $dbco->prepare($sql);
                $add->bindValue(':title', $_POST['article-name'], PDO::PARAM_STR);
                $add->bindValue(':shortdesc', $_POST['article-desc-short'], PDO::PARAM_STR);
                $add->bindValue(':fulldesc', $_POST['article-desc-full'], PDO::PARAM_STR);
                $add->bindValue(':addat', $articleDate, PDO::PARAM_STR);
                $add->execute();
        
                            
            } catch(PDOException $e) {
                echo "Erreur :" . $e->getCode() . "<br>";
                echo "Un article porte déjà le même nom";
            }
            

    //==================CREATE INGREDIENTS TABLE IF NOT EXISTS : ===============

    $adsql = "CREATE TABLE IF NOT EXISTS ingredients (
        IngredientId INT AUTO_INCREMENT NOT NULL,
        IngredientName VARCHAR(50) UNIQUE NOT NULL,
        PRIMARY KEY (IngredientId)
        )";
    $adquery = $dbco->query($adsql);

    //=========ADD RECIPES TABLE IF NOT EXISTS : ===============================

            $adRsql = "CREATE TABLE IF NOT EXISTS recipes (
                RecipeName VARCHAR(50) UNIQUE NOT NULL,
                IngrId INT UNIQUE NOT NULL,
                Quantity INT(10),
                Mesure VARCHAR(25),
                FOREIGN KEY (RecipeName) REFERENCES articles(ArticleTitle),
                FOREIGN KEY (IngrId) REFERENCES ingredients(IngredientId)
                 )";
                
            $adRquery = $dbco->query($adRsql);


            header('Location: add-ingredients.php');
            
        } 
    }
?>
<div class="add-article-container">
    <h1>Ajouter un article : </h1>
    <form method="POST" class="add-article-form">

        <label for="article-name">Nom de l'article :
            <input type="text" name="article-name" id="article-name" value="">
        </label>
        <label for="article-desc-short">Description courte :
            <input type="text" name="article-desc-short" id="article-desc-short" value="">
        </label>
        <label for="article-desc-full">Description longue :
            <textarea name="article-desc-full" id="article-desc-full" value=""></textarea>
        </label>
        <button type="submit" name="submit-title-desc">Valider</button>
    </form>
</div>

<?php
include('./php-components/footer.php');
?>