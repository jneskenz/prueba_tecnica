<?php
// Ajusta estos parámetros según tu entorno (Laragon suele usar root sin password)
$dbHost = '127.0.0.1';
$dbName = 'prueba_tecnica';
$dbUser = 'root';
$dbPass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass, $options);
} catch (PDOException $e) {
    // En producción mostrar un mensaje más neutro
    die('Error de conexión a la base de datos: ' . $e->getMessage());
}

?>
