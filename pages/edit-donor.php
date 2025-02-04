<?php
session_start();
include("../config/db.php");

// Verify admin access
if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] !== "admin") {
    header("Location: index.php");
    exit();
}

$donor = [];
$error = '';

// Fetch donor data when page loads
if (isset($_GET['id'])) {
    $donor_id = intval($_GET['id']);
    $stmt = $con->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $donor_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $donor = $result->fetch_assoc();
    
    if (!$donor) {
        $_SESSION['error'] = "Donor not found";
        header("Location: manage_donor.php");
        exit();
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $donor_id = intval($_POST['donor_id']);
    $name = trim($_POST['name']);
    $blood_group = trim($_POST['blood_group']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    // Basic validation
    if (empty($name) || empty($blood_group) || empty($phone)) {
        $error = "Please fill in all required fields";
    } else {
        $stmt = $con->prepare("UPDATE users SET 
            name = ?, 
            blood_group = ?, 
            email = ?, 
            phone = ?, 
            address = ? 
            WHERE id = ?");
        
        $stmt->bind_param("sssssi", 
            $name,
            $blood_group,
            $email,
            $phone,
            $address,
            $donor_id
        );

        if ($stmt->execute()) {
            $_SESSION['success'] = "Donor updated successfully";
            header("Location: ../dashboard.php");
            exit();
        } else {
            $error = "Error updating donor: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Donor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Donor</h2>
        <a href="../dashboard.php" class="btn btn-secondary mb-3">Back to List</a>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="donor_id" value="<?php echo $donor['id']; ?>">
            
            <div class="mb-3">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" 
                    value="<?php echo htmlspecialchars($donor['name'] ?? ''); ?>" required>
            </div>

            <div class="mb-3">
                <label>Blood Group</label>
                <select name="blood_group" class="form-select" required>
                    <option value="">Select Blood Group</option>
                    <?php
                    $blood_groups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
                    foreach ($blood_groups as $group) {
                        $selected = ($donor['blood_group'] ?? '') == $group ? 'selected' : '';
                        echo "<option value='$group' $selected>$group</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" 
                    value="<?php echo htmlspecialchars($donor['email'] ?? ''); ?>">
            </div>

            <div class="mb-3">
                <label>Phone Number</label>
                <input type="tel" name="phone" class="form-control" 
                    value="<?php echo htmlspecialchars($donor['phone'] ?? ''); ?>" required>
            </div>

            <div class="mb-3">
                <label>Address</label>
                <textarea name="address" class="form-control"><?php 
                    echo htmlspecialchars($donor['address'] ?? ''); 
                ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Donor</button>
        </form>
    </div>
</body>
</html>