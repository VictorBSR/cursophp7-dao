<?php

ini_set('display_errors', '1');
spl_autoload_register(function($class_name){

    $filename = "class".DIRECTORY_SEPARATOR.$class_name.".php";

    if (file_exists($filename)) {
        require_once($filename);
    }
});


?>