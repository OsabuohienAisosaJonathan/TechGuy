<?php
// includes/functions.php

/**
 * Redirects to a specified page with an optional message.
 *
 * @param string $location URL to redirect to.
 * @param string|null $message Optional message to display.
 */
function redirectTo($location, $message = null) {
    if ($message) {
        $_SESSION['flash_message'] = $message;
    }
    header("Location: $location");
    exit();
}

/**
 * Displays a flash message if it exists in the session.
 */
function displayFlashMessage() {
    if (isset($_SESSION['flash_message'])) {
        echo '<p style="color: green;">' . htmlspecialchars($_SESSION['flash_message']) . '</p>';
        unset($_SESSION['flash_message']);
    }
}

/**
 * Validates an email address.
 *
 * @param string $email The email address to validate.
 * @return bool True if valid, false otherwise.
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Hashes a password using password_hash.
 *
 * @param string $password The password to hash.
 * @return string The hashed password.
 */
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * Checks if the user is logged in.
 *
 * @return bool True if logged in, false otherwise.
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Gets the user role.
 *
 * @return int|null The role ID or null if not logged in.
 */
function getUserRole() {
    return isset($_SESSION['role_id']) ? $_SESSION['role_id'] : null;
}

/**
 * Fetches user data from the database by user ID.
 *
 * @param PDO $pdo The PDO database connection.
 * @param int $user_id The user ID to fetch.
 * @return array|null The user data or null if not found.
 */
function getUserById($pdo, $user_id) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id LIMIT 1");
    $stmt->execute(['user_id' => $user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
