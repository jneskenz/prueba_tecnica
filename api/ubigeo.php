<?php
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'departamentos':
        $stmt = $pdo->query('SELECT DISTINCT id, descripcion FROM ubigeodepartamento ORDER BY descripcion');
        echo json_encode($stmt->fetchAll());
        break;
        
    case 'provincias':
        $departamento = $_GET['departamento'] ?? '';
        if ($departamento) {
            $stmt = $pdo->prepare('SELECT DISTINCT id, descripcion FROM ubigeoprovincias WHERE departamento = :dep ORDER BY descripcion');
            $stmt->execute(['dep' => $departamento]);
            echo json_encode($stmt->fetchAll());
        } else {
            echo json_encode([]);
        }
        break;
        
    case 'distritos':
        $provincia = $_GET['provincia'] ?? '';
        $departamento = $_GET['departamento'] ?? '';
        if ($provincia && $departamento) {
            $stmt = $pdo->prepare('SELECT id, descripcion FROM ubigeodistrito WHERE provincia = :prov AND departamento = :dep ORDER BY descripcion');
            $stmt->execute(['prov' => $provincia, 'dep' => $departamento]);
            echo json_encode($stmt->fetchAll());
        } else {
            echo json_encode([]);
        }
        break;
        
    default:
        echo json_encode(['error' => 'Acción no válida']);
        break;
}
