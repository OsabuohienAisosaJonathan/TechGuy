<?php
// fetch_locations.php
require '../config/database.php';

$stmt = $pdo->query("SELECT username, email, latitude, longitude FROM users WHERE location_enabled = 1");
$locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($locations);
?>
