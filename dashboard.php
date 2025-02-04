<?php
// Start session and check authentication
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Determine user role
$isAdmin = ($_SESSION['user_role'] === 'admin');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation System - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            background: #2c3e50;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 15px;
            display: block;
        }
        .sidebar a:hover {
            background: #34495e;
        }
        .main-content {
            padding: 20px;
        }
        .card-stat {
            transition: transform 0.3s;
        }
        .card-stat:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="sidebar-header text-center py-4">
                        <h4>Blood Donation System</h4>
                        <p class="text-muted mb-0">Welcome, <?php echo $_SESSION['name']; ?></p>
                    </div>
                    
                    <ul class="nav flex-column">
                        <?php if (!$isAdmin): ?>
                            <!-- Donor Menu -->
                            <li class="nav-item">
                                <a href="?page=profile" class="nav-link">
                                    <i class="fas fa-user me-2"></i> Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="?page=request_blood" class="nav-link">
                                    <i class="fas fa-tint me-2"></i> Request Blood
                                </a>
                            <!-- </li>
                            <li class="nav-item">
                                <a href="?page=search-donors" class="nav-link">
                                    <i class="fas fa-search me-2"></i> Search Donors
                                </a>
                            </li> -->
                            <li class="nav-item">
                                <a href="?page=donation" class="nav-link">
                                    <i class="fas fa-history me-2"></i> Donation History
                                </a>
                            </li>
                        <?php else: ?>
                            <!-- Admin Menu -->
                            <li class="nav-item">
                                <a href="?page=manage_donor" class="nav-link">
                                    <i class="fas fa-users me-2"></i> Manage Donors
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="?page=manage_req" class="nav-link">
                                    <i class="fas fa-list me-2"></i> Blood Requests
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="?page=blood_stock" class="nav-link">
                                    <i class="fas fa-database me-2"></i> Blood Stock
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="?page=reports" class="nav-link">
                                    <i class="fas fa-chart-bar me-2"></i> Reports
                                </a>
                            </li> -->
                        <?php endif; ?>
                        
                        <!-- Common Menu Items -->
                        <!-- <li class="nav-item">
                            <a href="?page=notifications" class="nav-link">
                                <i class="fas fa-bell me-2"></i> Notifications
                                <span class="badge bg-danger ms-2">3</span>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <!-- Top Navigation -->
                <nav class="navbar navbar-light bg-light mb-4">
                    <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target=".sidebar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <h3 class="mb-0"><?php echo ucfirst($_GET['page'] ?? 'Dashboard'); ?></h3>
                </nav>

                <!-- Content Area -->
                <?php
                if (isset($_SESSION['error'])) {
                    echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'])) {
                    echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
                    unset($_SESSION['success']);
                }

                $page = $_GET['page'] ?? 'dashboard';
                $allowed_pages = $isAdmin ? 
                    ['dashboard', 'manage_donor', 'manage_req', 'blood_stock', 'reports', 'notifications','request_blo','dashboardindex'] :
                    ['dashboard', 'profile', 'request_blood', 'search-donors', 'donation', 'notifications','dashboardindex'];

                if (in_array($page, $allowed_pages)) {
                    include "pages/{$page}.php";
                } else {
                    include "pages/404.php";
                }
                ?>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
