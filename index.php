<?php
session_start();

spl_autoload_register(function ($class) {
    $paths = [__DIR__ . '/controllers/' . $class . '.php', __DIR__ . '/models/' . $class . '.php'];
    foreach ($paths as $file) {
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

//base de datos
require_once __DIR__ . '/config/database.php';

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'trabajadores';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$controllerClass = ucfirst($controller) . 'Controller';

if (class_exists($controllerClass)) {
    $ctrl = new $controllerClass($pdo);
    if (method_exists($ctrl, $action)) {
        $ctrl->{$action}();
        exit;
    }
}

// Si no existe
http_response_code(404);
echo "<h1>404 - Página no encontrada</h1>";
echo "<p>Controller: " . htmlspecialchars($controller) . " action: " . htmlspecialchars($action) . "</p>";

?>
