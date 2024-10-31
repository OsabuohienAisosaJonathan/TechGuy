<?php
// admin/manage_users.php

session_start();
require '../config/database.php';

// Only admins can access this page
if ($_SESSION['role_id'] != 1) { // Assuming role_id 1 is for admin
    header("Location: ../public/index.php");
    exit();
}

// Fetch all users
$stmt = $pdo->prepare("SELECT user_id, username, email, role_id, active FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use associative array for clarity

// Handle user actions (delete or admit)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $user_id = $_POST['user_id'];

    if ($_POST['action'] == 'delete') {
        $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $message = "User deleted successfully.";
    } elseif ($_POST['action'] == 'admit') {
        // Here we "admit" a user by setting them as active
        $stmt = $pdo->prepare("UPDATE users SET active = 1 WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $message = "User admitted successfully.";
    } elseif ($_POST['action'] == 'deactivate') {
        // Deactivate user account
        $stmt = $pdo->prepare("UPDATE users SET active = 0 WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $message = "User deactivated successfully.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<h1>Manage Users</h1>

<?php if (isset($message)): ?>
    <p><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>

<table border="1">
    <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['username']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
            <td><?php echo $user['role_id'] == 1 ? 'Admin' : ($user['role_id'] == 2 ? 'Tech Expert' : 'Client'); ?></td>
            <td><?php echo $user['active'] ? 'Active' : 'Inactive'; ?></td>
            <td>
                <form action="" method="POST" style="display:inline;">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>">

                    <!-- Delete Button -->
                    <button type="submit" name="action" value="delete" onclick="return confirm('Are you sure you want to delete this user?');">
                        Delete
                    </button>

                    <?php if (!$user['active']): ?>
                        <!-- Admit Button -->
                        <button type="submit" name="action" value="admit">
                            Admit
                        </button>
                    <?php else: ?>
                        <!-- Deactivate Button -->
                        <button type="submit" name="action" value="deactivate">
                            Deactivate
                        </button>
                    <?php endif; ?>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<script src="../assets/js/main.js"></script>
<script src="../assets/js/map.js"></script>

</body>
</html>
