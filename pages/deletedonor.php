<?php
session_start();
include("../config/db.php");

// Ensure only admin can access this page
if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] !== "admin") {
    header("Location: ../dashboard.php");
    exit();
}

// Check if donor ID is provided
if (isset($_GET['id'])) {
    $donor_id = intval($_GET['id']);
    
    // Prepare the delete statement
    $stmt = $con->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $donor_id);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Donor deleted successfully!";
    } else {
        $_SESSION['error'] = "Failed to delete donor.";
    }
    
    $stmt->close();
    $con->close();
    
    header("Location: ../dashboard.php");
    exit();
} else {
    $_SESSION['error'] = "Invalid request.";
    header("Location: manage_donor.php");
    exit();
}
?>