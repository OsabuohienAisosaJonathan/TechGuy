<?php
// public/login.php

session_start();
require '../config/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the inputs
    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password.';
    } else {
        // Check the user in the database
        $stmt = $pdo->prepare("SELECT user_id, username, password, role_id FROM users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Set session variables upon successful login
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role_id'] = $user['role_id'];

            // Redirect based on role
            if ($user['role_id'] == 1) {
                header('Location: ../admin/dashboard.php'); // Admin Dashboard
            } else {
                header('Location: profile.php'); // Tech Expert or Client Profile
            }
            exit();
        } else {
            $error = 'Incorrect username or password.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

    <h2>Login</h2>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form action="login.php" method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a>.</p>

    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/map.js"></script>

</body>
</html>
