<?php
session_start();
spl_autoload_register(function ($class_name) {
    if (file_exists('app/controllers/' . $class_name . '.php')) {
        require_once 'app/controllers/' . $class_name . '.php';
    } elseif (file_exists('app/models/' . $class_name . '.php')) {
        require_once 'app/models/' . $class_name . '.php';
    } elseif (file_exists('app/models/DAO/' . $class_name . '.php')) {
        require_once 'app/models/DAO/' . $class_name . '.php';
    }
});

$url = $_GET['url'] ?? 'home';
$url = explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));
$controllerName = ucfirst(strtolower($url[0])) . 'Controller';
$method = $url[1] ?? 'index';   
$params = array_slice($url, 2);

if (file_exists('app/controllers/' . $controllerName . '.php')) {
    $controller = new $controllerName;
    if (method_exists($controller, $method)) {
        call_user_func_array([$controller, $method], $params);
    } else {
        echo $method;   
    }
} else {    
   echo 'deo ton tai cai controller nay ' . $controllerName;
}

?>
