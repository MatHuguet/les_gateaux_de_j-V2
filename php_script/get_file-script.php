<?php

$fileName = $_FILES['img']['name'];
$fileType = $_FILES['img']['type'];
$fileSize = $_FILES['img']['size'];
$fileTmpName = $_FILES['img']['tmp_name'];
$fileError = $_FILES['img']['error'];

echo $fileName."<br>";
echo $fileType."<br>";
echo $fileSize."<br>";
echo $fileTmpName."<br>";
echo $fileError."<br>";