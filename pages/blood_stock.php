<?php

include 'config/db.php';

// Fix authorization check
if ($_SESSION['user_role'] != 'admin') {
    echo "<script>alert('Access denied!'); window.location.href='dashboard.php';</script>";
    exit;
}

$query = "SELECT * FROM blood_stock";
$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Stock Management</title>
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
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        h1 {
            color: #c62828;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5em;
        }

        .stock-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .stock-table th,
        .stock-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .stock-table th {
            background-color: #c62828;
            color: white;
            font-weight: 600;
        }

        .stock-table tr:hover {
            background-color: #f9f9f9;
        }

        .update-form {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .update-form input[type="number"] {
            padding: 8px;
            width: 100px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .update-form button {
            background-color: #c62828;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .update-form button:hover {
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
        <h1>Blood Stock Management</h1>
        
        <table class="stock-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Blood Group</th>
                    <th>Quantity (ml)</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= strtoupper($row['blood_group']) ?></td>
                    <td><?= number_format($row['quantity']) ?></td>
                    <td><?= date('M j, Y H:i', strtotime($row['updated_at'])) ?></td>
                    <td>
                        <form class="update-form" action="pages/update_stock.php" method="post">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="number" name="quantity" 
                                   placeholder="Quantity" 
                                   min="0" 
                                   required
                                   value="<?= $row['quantity'] ?>">
                            <button type="submit" name="submit">Update</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>