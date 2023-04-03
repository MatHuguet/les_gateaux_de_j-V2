<?php
// $file = $_FILES['img'];
// $fileName = $_FILES['img']['name'];
// $fileType = $_FILES['img']['type'];
// $fileSize = $_FILES['img']['size'];
// $fileTmpName = $_FILES['img']['tmp_name'];
// $fileError = $_FILES['img']['error'];


//On vérifie qu'un fichier à bien été téléchargé
// && qu'il ne renvoie aucune erreur:
if (isset($_FILES['img']) && $_FILES['img']['error'] === 0) {
    //Pour l'exercice on affiche les données du fichié
    echo $_FILES['img']['name']."<br>";
echo $_FILES['img']['type']."<br>";
echo $_FILES['img']['size']."<br>";
echo $_FILES['img']['tmp_name']."<br>";
echo $_FILES['img']['error']."<br>";

//Vérification du type autorisé :
    //On défini un tableau avec les ttpes MIMES que l'on souhaite :
    //(voir liste : https://developer.mozilla.org/fr/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Common_types)
    $allowed = [
        'webp' => 'image/webp',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpg',
        'png' => 'image/png',
    ];
//On récupère le nom du fichier, le type Mime et la taille afin de 
//procéder à des vérifications
    $fileName = $_FILES['img']['name'];
    $fileType = $_FILES['img']['type'];
    $fileSize = $_FILES['img']['size'];

    //On récupère l'extension du fichier :
    $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); //ex: on récupère jpg
    //On compare ensuite nos clées de $allowed avec l'extension :
    if(!array_key_exists($extension, $allowed) || !in_array($fileType, $allowed)) {
        //Soit l'extension, soit le type est incorrect
        die("Erreur, format de fichier incorrect");
    }
    //Si le type est correct
    //On peut vérifier la taille du fichier
    //1024*1024 = 1Mo
    if($fileSize > (1024 * 1024) * 2){
        die("Fichier trop volumineux");
    }
    //On va générer un nom unique de fichier au cas ou deux fichiers uploadés
    //portent le même nom
    //md5 converti un nom en donnée héxadécimal de 32 caractères
    //uniqid génère un id aléatoire en fonction de la date de l'heure
    $newname = md5(uniqid());
    echo 'répertoire'.__DIR__.'<br>';
    //__DIR__ récupère le chemin actuel. Ici répertoireI:\xampp\htdocs\les_gateaux_de_j-V2\php-components
    //On place dans une variable le nouveau chemin pour le fichier uploadé
    //avec son nouveau nom et son extension:
    if(!file_exists(__DIR__."/../uploads")){
        mkdir(__DIR__."/../uploads", recursive:false);
    }
    $newfilename = __DIR__ . "/../uploads/$newname.$extension";
    echo $newfilename; //ex de retour : I:\xampp\htdocs\les_gateaux_de_j-V2\php-components../uploads/4b2d418c1865485ba165ad1d5bf4bd71.jpg 
    //On va ensuite déplacer le fichier dans le répertoir sous son nouveau nom
    //Si la fonction moive_upload_file échoue on renvoie une erreur.
    if(!move_uploaded_file($_FILES['img']['tmp_name'], $newfilename)){
        die("L'upload à échoué");
    }
    //Si l'upload réussi, un nouveau fichier apparaît dans le répertoire upload.
    //====++++++ Protection complémentaire pour empêcher l'éxécution d'un fichier
    //stocké ou d'une image contenant un script:
    //chmod, comme en ligne de commande permet de modifier les accès aux
    //utilisateurs :
    chmod($newfilename, 0644);
    //En paramètre on choisi le fichier à protéger, et ensuite le mode de 
    //restriction. 0 pour tous le monde -> 6 permet à l'administrateur de
    //lire et écrire le fichier, les deux 4 pour groupe et utilisateur, afin
    //de n'accéder au fichier qu'en lecture.
}

//Supprimer une image : unlink(__DIR__"/chemin de l'image);

?>

<div class="upload-form">
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" id="img" name="img">
        <input type="submit">
    </form>
</div>