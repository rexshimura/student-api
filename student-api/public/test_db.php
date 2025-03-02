<?php
require_once "../config/database.php";

$db = new Database();
try {
    $conn = $db->connect();
    echo "Database connection successful!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// dont mind this lol