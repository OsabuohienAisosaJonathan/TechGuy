<?php
// includes/auth.php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header('Location: ../public/login.php');
    exit();
}

// Check for specific role access if necessary
function requireRole($requiredRoleId) {
    if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != $requiredRoleId) {
        // If the user does not have the required role, redirect to the index page with an error message
        header('Location: ../public/index.php');
        exit();
    }
}

// Example usage:
// requireRole(1); // Restrict access to only Admin (role_id = 1)
