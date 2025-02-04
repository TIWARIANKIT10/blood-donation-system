<?php
include('config/db.php'); // Ensure this file correctly initializes $con

if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'donor') {
    $donor_id = $_SESSION['user_id'];

    // Using Prepared Statements to prevent SQL Injection
    $query = "SELECT id, donor_id, blood_group, quantity, donation_date FROM donations WHERE donor_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $donor_id); // Assuming donor_id is an integer
    $stmt->execute();
    $result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Your Donation History</h2>
        <table class="table table-bordered table-striped" >
            <thead class="table" style="background-color:red  color:white">
                <tr>
                    <th>ID</th>
                    <th>Donor ID</th>
                    <th>Blood Group</th>
                    <th>Quantity</th>
                    <th>Donation Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['donor_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['blood_group']); ?></td>
                        <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($row['donation_date']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
    $stmt->close();
} else {
    echo "<div class='alert alert-danger'>Role does not match.</div>";
}
?>
