<?php
// public/profile.php

session_start();
require '../config/database.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$role_id = $_SESSION['role_id'];
$message = '';

// Handle location visibility toggle for Tech Experts
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $role_id == 2) { // Assuming role_id 2 is for Tech Expert
    $location_enabled = isset($_POST['location_enabled']) ? 1 : 0;
    
    $stmt = $pdo->prepare("UPDATE users SET location_enabled = :location_enabled WHERE user_id = :user_id");
    $stmt->execute(['location_enabled' => $location_enabled, 'user_id' => $user_id]);
    
    $message = 'Location visibility updated successfully.';
}

// Fetch user data
$stmt = $pdo->prepare("SELECT username, email, role_id, location_enabled FROM users WHERE user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found.";
    exit();
}

// Determine role for display
$role = ($user['role_id'] == 1) ? 'Admin' : (($user['role_id'] == 2) ? 'Tech Expert' : 'Client');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

    <h2>Your Profile</h2>

    <?php if ($message): ?>
        <p style="color: green;"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><strong>Role:</strong> <?php echo htmlspecialchars($role); ?></p>

    <!-- Location visibility toggle for Tech Experts -->
    <?php if ($role_id == 2): ?>
        <form action="profile.php" method="post">
            <div>
                <label>
                    <input type="checkbox" name="location_enabled" <?php echo $user['location_enabled'] ? 'checked' : ''; ?>>
                    Enable Location Visibility
                </label>
            </div>
            <button type="submit">Update Location Settings</button>
        </form>
    <?php endif; ?>

    <p><a href="index.php">Back to Home</a></p>
    <form action="logout.php" method="post" style="display:inline;">
        <button type="submit">Logout</button>
    </form>
    
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/map.js"></script>

</body>
</html>
