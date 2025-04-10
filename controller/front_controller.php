<?php
function console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}
define('CONTROLLERS_FOLDER', "controller/");
define('DEFAULT_CONTROLLER', "productos");
define('DEFAULT_ACTION', "home");

$controller = DEFAULT_CONTROLLER;

if (!empty($_GET['controlador'])) {
    $controller = $_GET['controlador'];
}

$action = DEFAULT_ACTION;
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}
$controller = CONTROLLERS_FOLDER . $controller . '_controller.php';
try {
    if (is_file($controller)) {
        require_once($controller);
    } else {
        throw new Exception('El controlador no existe - 404 not found');
    }
    if (is_callable($action)) {
        $action();
    } else {
        throw new Exception('La acción no existe - 404 not found');
    }
} catch (Exception $e) {
    console_log($e->getMessage());
}
