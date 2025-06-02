<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// CORS Headers para hindi blocked
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header('Content-Type: application/json');

// Database connection (PDO)
require_once '../config/database1.php'; // make sure PDO connection

try {
    $departmentId = 8; // LOGISTIC 1

    $sql = "SELECT 
                d.name AS department_name,
                b.year,
                b.allocated_amount,
                b.used_amount
            FROM 
                budget_allocations b
            JOIN 
                departments d ON b.department_id = d.id
            WHERE 
                b.department_id = :dept_id AND b.status = 'Active'";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':dept_id', $departmentId, PDO::PARAM_INT);
    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
