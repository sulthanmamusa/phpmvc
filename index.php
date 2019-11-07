<?php
error_reporting(1);
$parse_url = parse_url($_SERVER['REQUEST_URI']);
$script_name = str_replace('/index.php','',$_SERVER['SCRIPT_NAME']);
$cap = str_replace($script_name.'/', '', $parse_url['path']);
$url = explode('/', $cap);
$constroller = $url[0] ? $url[0] : 'home';
$action = $url[1] ? $url[1] : 'index';
$params = array_slice($url, 2);
$query = $parse_url['query'];
if(file_exists('controllers/'.$constroller.'_controller.php')) {
    require_once('controllers/'.$constroller.'_controller.php');
    $constrollerClass = ucfirst($constroller)."Controller";
    if(class_exists($constrollerClass)){
        $obj = new $constrollerClass;
        if(method_exists($obj, $action)) {
            echo $obj->$action();
        } else {
            echo 'action does not exist';
        }
    } else {
        echo 'controller deos not exist';
    }
} else {
    echo 'page not found';
}

?>