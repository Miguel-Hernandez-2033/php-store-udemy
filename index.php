<?php
session_start();
require_once('autoload.php');
require_once('config/db.php');
require_once('config/parameters.php');
require_once('helpers/utilities.php');
require_once('views/layouts/header.php');
require_once('views/layouts/sidebar.php');


function show_error(){
    $error = new errorController();
    $error->index();
}


if (isset($_GET['controller'])) {
    $controller_name = $_GET['controller'] . 'Controller';
} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $controller_name = default_controller;
} else {
    show_error();
    exit();
}


if(class_exists($controller_name)){

    $controller = new $controller_name();

    if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
        $action = $_GET['action'];
        $controller->$action();
    } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
        $default_action = default_action;

        $controller->$default_action();
    } else {
        show_error();
    }
}else{
    
    show_error();
    //echo "La pagina no existe";
}

require_once('views/layouts/footer.php');

