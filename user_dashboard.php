<?php
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: login.php");
    die();
}

// Assuming role check has already been done in index.php
// If this page is directly accessed, ensure role is not admin
if ($_SESSION['SESSION_ROLE'] === 'admin') {
    header("Location: admin_dashboard.php"); // Redirect admin to admin dashboard
    die();
}

// Include necessary files and configurations
include 'connection/config.php';

// Retrieve user data based on session email
$query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $name = $row['name'];
} else {
    // Handle case where user data is not found (although this should not happen if user is logged in)
    header("Location: login.php");
    die();
}
// Get the current page filename
$current_page = basename($_SERVER['PHP_SELF']);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
     <!-- local files -->
     <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    
    <style>
        /* Custom styles for content */
        .content {
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #48d1cc;
            color: #fff;
            border-radius: 10px 10px 0 0;
        }
        .card-body {
            padding: 20px;
        }
        .card-body h5 {
            color: #0cc0df;
        }
        .row {
            margin-top: 20px;
        }
        .custom-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .custom-card i {
            font-size: 40px;
            color: #0cc0df;
        }
        .custom-card h4 {
            margin-top: 10px;
            color: #333;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<?php include('user_sidebar.php'); ?>

<!-- Page Content -->
<div class="content">
    <h1>Welcome, <?php echo $name; ?>!</h1>

    <div class="row">
        <div class="col-md-3">
            <div class="card custom-card">
                <i class="fas fa-cloud-upload-alt"></i>
                <h4>Upload Documents</h4>
                <a href="user_upload.php" class="btn btn-primary mt-3">Go to Upload</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card custom-card">
                <i class="fas fa-file-alt"></i>
                <h4>View Documents</h4>
                <a href="user_documents.php" class="btn btn-secondary mt-3">Go to Documents</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card custom-card">
                <i class="fas fa-folder"></i>
                <h4>Manage Folders</h4>
                <a href="user_folders.php" class="btn btn-success mt-3">Go to Folders</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card custom-card">
                <i class="fas fa-user-friends"></i>
                <h4>Manage Friends</h4>
                <a href="user_friends.php" class="btn btn-info mt-3">Go to Friends</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card custom-card">
                <i class="fas fa-lock"></i>
                <h4>PIN Setup</h4>
                <a href="User_pinsetup.php" class="btn btn-warning mt-3">Go to PIN Setup</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

</body>
</html>