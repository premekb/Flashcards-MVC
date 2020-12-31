<?php
spl_autoload_register('modelLoader');

function modelLoader($className){
    $path = "models/" . $className . ".model.php";
    include_once $path;

    if (!file_exists($path)){
        return false;
    }
}