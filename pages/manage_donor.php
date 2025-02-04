<?php

include("config/db.php");

// Ensure only admin can access this page
if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] !== "admin") {
    header("Location: ../dashboard.php");
    exit();
}

// Fetch donors from the database
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$query = "SELECT * FROM users WHERE name LIKE ? OR blood_group LIKE ? ORDER BY id DESC";
$stmt = $con->prepare($query);
$search_param = "%$search%";
$stmt->bind_param("ss", $search_param, $search_param);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Donors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4 text-danger">Manage Donors</h2>

        <!-- Display success/error messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <!-- Search Form -->
        <!-- <form class="row mb-3" method="GET" action="">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Search by Name or Blood Group" value="<?php echo htmlspecialchars($search); ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form> -->

        <!-- Donor Table -->
        <table class="table table-bordered text-center">
            <thead class="table-" style=" background-color: #c62828;   color: white;">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Blood Group</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo strtoupper(htmlspecialchars($row['blood_group'])); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td>
                            <a href="pages/edit-donor.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <button onclick="confirmDelete(<?php echo $row['id']; ?>)" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "pages/deletedonor.php?id=" + id;
                }
            });
        }
    </script>
</body>
</html>

