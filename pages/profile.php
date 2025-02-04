<?php

include("config/db.php");  // Database connection

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Fetch donor details from the users table
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists
if ($result->num_rows === 0) {
    $_SESSION['error'] = "User not found!";
    header("Location: index.php");
    exit();
}

$user = $result->fetch_assoc();

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $blood_group = htmlspecialchars($_POST['blood_group']);
    $city = htmlspecialchars($_POST['city']);

    // Update the donor's profile
    $update_query = "UPDATE users SET name = ?, phone = ?, blood_group = ?, city = ? WHERE id = ?";
    $update_stmt = $con->prepare($update_query);
    $update_stmt->bind_param("ssssi", $name, $phone, $blood_group, $city, $user_id);

    if ($update_stmt->execute()) {
        $_SESSION['success'] = "Profile updated successfully!";
        header("Location: profile.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to update profile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="mb-4 text-danger">Donor Profile</h2>

            <!-- Display success/error messages -->
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
            <?php endif; ?>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
            <?php endif; ?>

            <form method="POST" action="profile.php">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email (Cannot be changed)</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="blood_group" class="form-label">Blood Group</label>
                    <input type="text" class="form-control" id="blood_group" name="blood_group" value="<?php echo htmlspecialchars($user['blood_group']); ?>" required>
                </div>
                <!-- <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlspecialchars($user['city']); ?>" required>
                </div> -->
                <button type="submit" class="btn btn-primary">Update Profile</button>
                <a href="dashboard.php" class="btn btn-secondary ms-2">Back to Dashboard</a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
