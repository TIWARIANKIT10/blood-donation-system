<?php
include('../config/db.php');
session_start();

if ($_SESSION['user_role'] != 'admin') {
    echo "Access denied!";
    exit;
}

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    $query = "UPDATE blood_requests SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        echo "Request status updated successfully!";
        header('Location: manage_requests.php');
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
