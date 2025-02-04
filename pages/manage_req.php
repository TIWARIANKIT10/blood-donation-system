<?php
include 'config/db.php';

// Authorization check
if ($_SESSION['user_role'] != 'admin') {
    echo "<script>alert('Access denied!'); window.location.href='dashboard.php';</script>";
    exit;
}

$query = "SELECT r.id, u.name, r.blood_group, r.units, r.reason, r.request_date 
          FROM blood_requests r 
          JOIN users u ON r.user_id = u.id 
          WHERE r.status = 'Pending'";

$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Blood Requests</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #c62828;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5em;
        }

        .request-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .request-table th,
        .request-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .request-table th {
            background-color: #c62828;
            color: white;
            font-weight: 600;
        }

        .request-table tr:hover {
            background-color: #f9f9f9;
        }

        .action-links a {
            margin-right: 10px;
            padding: 8px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .approve {
            background-color: #4CAF50;
            color: white;
        }

        .reject {
            background-color: #d32f2f;
            color: white;
        }

        .approve:hover {
            background-color: #388E3C;
        }

        .reject:hover {
            background-color: #b71c1c;
        }

        .nav-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #c62828;
            text-decoration: none;
            font-weight: 500;
        }

        .nav-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="dashboard.php" class="nav-link">&larr; Back to Dashboard</a>
        <h1>Manage Blood Requests</h1>

        <table class="request-table">
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>Donor Name</th>
                    <th>Blood Group</th>
                    <th>Units</th>
                    <th>Reason</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= strtoupper(htmlspecialchars($row['blood_group'])) ?></td>
                        <td><?= htmlspecialchars($row['units']) ?></td>
                        <td><?= htmlspecialchars($row['reason']) ?></td>
                        <td><?= date('M j, Y', strtotime($row['request_date'])) ?></td>
                        <td class="action-links">
                            <a href="pages/update_request.php?id=<?= $row['id'] ?>&status=Approved" class="approve">Approve</a>
                            <a href="pages/update_request.php?id=<?= $row['id'] ?>&status=Rejected" class="reject">Reject</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
