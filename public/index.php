<?php
// public/index.php

session_start();
require '../config/database.php';

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
$role_id = $isLoggedIn ? $_SESSION['role_id'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Networking & Recruitment Platform</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

    <h1>Welcome to the Tech Networking & Recruitment Platform</h1>

    <?php if ($isLoggedIn): ?>
        <p>Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>

        <!-- Links based on user role -->
        <?php if ($role_id == 1): ?>
            <!-- Admin Dashboard Link -->
            <a href="../admin/dashboard.php">Go to Admin Dashboard</a>
        <?php else: ?>
            <!-- Tech Expert Dashboard / Profile Link -->
            <a href="profile.php">Go to Your Profile</a>
            <a href="map.php">View Map</a>
        <?php endif; ?>

        <form action="logout.php" method="post" style="display:inline;">
            <button type="submit">Logout</button>
        </form>

    <?php else: ?>
        <!-- If user is not logged in, show login and register links -->
        <p><a href="login.php">Login</a> or <a href="register.php">Register</a> to join the platform.</p>
    <?php endif; ?>

<script src="../assets/js/main.js"></script>
<script src="../assets/js/map.js"></script>

</body>
</html>
