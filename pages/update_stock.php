<?php
include '../config/db.php';
session_start();

if (isset($_POST['submit'])) {
    if ($_SESSION['user_role'] == 'admin') {

        if (!$con) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        $id = $_POST['id'];
        $quantity = $_POST['quantity'];

        $query = "UPDATE blood_stock SET quantity=? WHERE id=?"; 

        $stmt = $con->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $con->error);
        }

        $stmt->bind_param("ii", $quantity, $id);

        if ($stmt->execute()) {
            echo "Updated successfully";
            header('Location: ../dashboard.php');
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Access denied";
        exit();
    }
}
?>

