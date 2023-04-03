<?php
 require_once './php_script/db_conn.php';
 $sql = 'SELECT * FROM recipes WHERE recipe_id = 1';
 $q = $dbco->query($sql);
 $recipe = $q->fetch();
 echo '<pre>';
 var_dump($recipe);
 echo "</pre>";

 ?>


<content class="cards">
    <div class="card c1">
        <p><?= $recipe["desc_short"] ?></p>
        <?=  header("Content-type: image/jpg"); 
         $recipe["images"]; ?>
    </div>

</content>