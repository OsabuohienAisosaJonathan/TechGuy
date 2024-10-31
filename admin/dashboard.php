<?php
// admin/dashboard.php

require '../config/database.php';
require '../includes/auth.php'; // Ensure user is logged in
require '../includes/functions.php'; // Include utility functions

// Ensure the user is an admin
requireRole(1); // Assuming role_id 1 is for Admin

// Fetch all users from the database
$stmt = $pdo->query("SELECT user_id, username, email, role_id, location_enabled FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

    <h2>Admin Dashboard</h2>

    <h3>User Management</h3>
    
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Location Visibility</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo $user['role_id'] == 1 ? 'Admin' : ($user['role_id'] == 2 ? 'Tech Expert' : 'Client'); ?></td>
                    <td><?php echo $user['location_enabled'] ? 'Enabled' : 'Disabled'; ?></td>
                    <td>
                        <form action="manage_users.php" method="post" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                            <button type="submit" name="action" value="admit">Admit</button>
                            <button type="submit" name="action" value="delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p><a href="../public/index.php">Back to Home</a></p>
    <form action="../public/logout.php" method="post" style="display:inline;">
        <button type="submit">Logout</button>
    </form>

<script src="../assets/js/main.js"></script>
<script src="../assets/js/map.js"></script>

</body>
</html>
