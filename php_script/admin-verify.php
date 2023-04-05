<?php
session_start();
echo "<pre>";
var_dump($_SESSION);
echo "</pre>";
echo "<pre>";
var_dump($_SESSION['administration']);
echo "</pre>";

if ($_SESSION['administration'] === 'JulieS') {
    echo 'Connecté en tant que administrateur';
} else {
    echo 'pas connecté';
}