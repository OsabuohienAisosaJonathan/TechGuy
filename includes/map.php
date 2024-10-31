<?php
// public/map.php

session_start();
require '../config/database.php';

// Ensure the user is logged in and has admin privileges
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) { // Assuming role_id 1 is for admin
    http_response_code(403); // Forbidden
    echo json_encode(['error' => 'Unauthorized access']);
    exit();
}

// Set header to return JSON content
header('Content-Type: application/json');

try {
    // Select all users with location enabled (only visible to admin)
    $stmt = $pdo->prepare("
        SELECT u.username, u.role_id, u.location_enabled, l.latitude, l.longitude
        FROM users u
        JOIN locations l ON u.user_id = l.user_id
        WHERE u.location_enabled = 1
    ");
    $stmt->execute();
    $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Map role_id to role names for display purposes
    foreach ($locations as &$location) {
        $location['role'] = ($location['role_id'] == 1) ? 'Admin' : (($location['role_id'] == 2) ? 'Tech Expert' : 'Client');
    }

    // Output the location data as JSON
    echo json_encode($locations);
} catch (Exception $e) {
    // Return a JSON error message in case of failure
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Failed to load locations']);
}
?>
