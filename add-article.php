<?php
include('./const/const.php');
include('./php_script/db_conn.php');
include('./php-components/header.php');

?>
<?php
if (isset($_POST['submit-title-desc'])) 
{
    if (empty($_POST['article-name']) || empty($_POST['article-desc-short']))
    {
        echo "Un titre et une description courte doivent être entrés";
        
        

    } elseif (!empty($_POST['article-name']) || !empty($_POST['article-desc-short']))  {
        $article_title = $_POST['article-name'];
        $short_desc = $_POST['article-desc-short'];
        $full_desc = $_POST['article-desc-full'];
        //query to create table if not exists in database
        $adsql = "CREATE TABLE IF NOT EXISTS articles (
            Id INT AUTO_INCREMENT NOT NULL,
            ArticleTitle VARCHAR(50) UNIQUE NOT NULL,
            Article_short VARCHAR(255) NOT NULL,
            Article_full TEXT NULL,
            PRIMARY KEY (Id)
            )";
        $adquery = $dbco->query($adsql);
        //Avant création de la table, vérification de doublons :
        $verif_sql = "SELECT ArticleTitle FROM `articles` WHERE `ArticleTitle` = '$article_title'";
        $verif_query = $dbco->query($verif_sql);
        $veriffetch = $verif_query->fetchAll();

        
    } 

};   

  

       


              

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
        if (isset($_POST['submit-title-desc'])) {

            if ($article_title)
            {
                

                 $adsql = "INSERT INTO articles (
                    ArticleTitle, 
                    Article_short, 
                    Article_full)
                    VALUES (
                        :title,
                        :short_desc,
                        :full_desc)";
                    $q = $dbco->prepare($adsql);
                    $q->bindValue(':title', $article_title, PDO::PARAM_STR);
                    $q->bindValue(':short_desc', $short_desc, PDO::PARAM_STR);
                    $q->bindValue(':full_desc', $full_desc, PDO::PARAM_STR);
                    $q->execute();

                    header('Location: add-ingredients.php');

            } else {
                echo "Un article portant le même nom existe déjà !";
        


                    }

        }
include('./php-components/footer.php');
?>