<?php
$file = $_FILES['img'];
$fileName = $_FILES['img']['name'];
$fileType = $_FILES['img']['type'];
$fileSize = $_FILES['img']['size'];
$fileTmpName = $_FILES['img']['tmp_name'];
$fileError = $_FILES['img']['error'];


//On vérifie qu'un fichier à bien été téléchargé
// && qu'il ne renvoie aucune erreur:
if (isset($file) && $fileError === 0) {
    echo $fileName."<br>";
echo $fileType."<br>";
echo $fileSize."<br>";
echo $fileTmpName."<br>";
echo $fileError."<br>";
}