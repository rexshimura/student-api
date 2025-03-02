<?php
require_once '../config/database.php';
require_once '../app/controllers/StudentController.php';

$database = new Database();
$db = $database->connect();
$controller = new StudentController($db);

// Routing Logic
$requestMethod = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? null;

try {
    if ($requestMethod === 'GET' && $action === 'all') {
        $controller->getAllStudents();
    } elseif ($requestMethod === 'GET' && isset($_GET['id'])) {
        $controller->getStudentById($_GET['id']);
    } elseif ($requestMethod === 'POST' && $action === 'add') {
        $data = json_decode(file_get_contents("php://input"), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(["message" => "Invalid JSON data"]);
            exit;
        }

        $controller->addStudent($data);
    } elseif ($requestMethod === 'PUT' && $action === 'update') {
        $data = json_decode(file_get_contents("php://input"), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(["message" => "Invalid JSON data"]);
            exit;
        }

        $controller->updateStudent($data);
    } elseif ($requestMethod === 'DELETE' && isset($_GET['id'])) {
        $controller->deleteStudent($_GET['id']);
    } else {
        echo json_encode([
            "message" => "Invalid request.",
            "method" => $requestMethod,
            "action" => $action
        ]);
    }
} catch (Exception $e) {
    echo json_encode(["message" => "Server error", "error" => $e->getMessage()]);
    error_log("Error: " . $e->getMessage());
}

// Log debugging information
error_log("Request Method: " . $requestMethod);
error_log("Action: " . $action);
error_log("Data: " . file_get_contents("php://input"));
?>
