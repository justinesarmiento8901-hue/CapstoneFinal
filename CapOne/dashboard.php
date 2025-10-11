<?php
session_start();
include 'dbForm.php'; // Ensure this file contains the database connection

// Fetch total infants
$infantCountQuery = "SELECT COUNT(*) AS total_infants FROM infantinfo";
$infantCountResult = mysqli_query($con, $infantCountQuery);
$infantCount = mysqli_fetch_assoc($infantCountResult)['total_infants'];

// Fetch total parents
$parentCountQuery = "SELECT COUNT(*) AS total_parents FROM parents";
$parentCountResult = mysqli_query($con, $parentCountQuery);
$parentCount = mysqli_fetch_assoc($parentCountResult)['total_parents'];

// Fetch all users
$userQuery = "SELECT id, email, role FROM users";
$userResult = mysqli_query($con, $userQuery);

// Handle user deletion
if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];
    $sql = "DELETE FROM users WHERE id = '$id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "<script>
        Swal.fire({
            title: 'Success!',
            text: 'User deleted successfully.',
            icon: 'success'
        }).then(() => {
            window.location.href = 'dashboard.php';
        });
        </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Error!',
            text: 'Failed to delete user.',
            icon: 'error'
        }).then(() => {
            window.location.href = 'dashboard.php';
        });
        </script>";
    }
}

// Handle health worker registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_healthworker'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($password !== $confirmPassword) {
        echo "<script>
        Swal.fire({
            title: 'Error!',
            text: 'Passwords do not match.',
            icon: 'error'
        });
        </script>";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $role = 'healthworker';

        // Include created_at column with NOW() function
        $registerQuery = "INSERT INTO users (name, email, password, role, created_at) VALUES ('$name', '$email', '$hashedPassword', '$role', NOW())";
        $registerResult = mysqli_query($con, $registerQuery);

        if ($registerResult) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Health worker registered successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'dashboard.php';
                });
            });
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Failed to register health worker.',
                icon: 'error'
            });
            </script>";
        }
    }
}

?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #0056b3;
            color: #fff;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 8px;
            transition: background 0.3s ease;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #004494;
        }

        .dropdown-menu {
            background-color: #004494;
            border: none;
        }

        .dropdown-menu a {
            color: #fff;
            padding-left: 30px;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }

        .toggle-btn {
            display: none;
            background-color: #004494;
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            width: 100%;
            text-align: left;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                display: none;
            }

            .sidebar.active {
                display: block;
            }

            .toggle-btn {
                display: block;
            }
        }
    </style>
    <title>Dashboard</title>
</head>
<!-- sidebar -->

<body class="bg-light">
    <button class="toggle-btn" onclick="toggleSidebar()"><i class="bi bi-list"></i> Menu</button>
    <div class="sidebar" id="sidebar">
        <h4 class="mb-4"><i class="bi bi-baby"></i> Infant Record System</h4>
        <a href="#dashboard" class="active"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="addinfant.php"><i class="bi bi-person"></i> Add Infant</a>
        <?php if (isset($_SESSION['user']['role']) && ($_SESSION['user']['role'] === 'admin' || $_SESSION['user']['role'] === 'healthworker')): ?>
            <a href="add_parents.php"><i class="bi bi-person-plus"></i> Add Parent</a>
        <?php endif; ?>
        <a href="view_parents.php"><i class="bi bi-book"></i> Parent Records</a>
        <a href="viewinfant.php"><i class="bi bi-book"></i> Infant Records</a>
        <div class="dropdown">
            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-syringe"></i> Vaccination Schedule</a>
            <div class="dropdown-menu">
                <a href="#upcoming" class="dropdown-item">Upcoming Vaccinations</a>
                <a href="#completed" class="dropdown-item">Completed Vaccinations</a>
            </div>
        </div>
        <a href="#sms"><i class="bi bi-chat-dots"></i> SMS Management</a>
        <a href="login_logs.php"><i class="bi bi-bar-chart"></i>Logs</a>
        <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>

    <!-- start of container -->
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>Admin Dashboard</h3>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card text-white bg-info">
                            <div class="card-body">
                                <h5 class="card-title">Total Infants</h5>
                                <p class="card-text fs-4"><?php echo $infantCount; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card text-white bg-warning">
                            <div class="card-body">
                                <h5 class="card-title">Total Parents</h5>
                                <p class="card-text fs-4"><?php echo $parentCount; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="login_logs.php" class="btn btn-success">View Login Logs</a>
                <?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin'): ?>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#registerHealthWorkerModal">
                        Register Health Worker
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#manageUsersModal">
                        Manage Users
                    </button>
                <?php endif; ?>
                <!-- Add more admin functionality here -->
            </div>
        </div>

        <!-- Modal structure -->
        <div class="modal fade" id="registerHealthWorkerModal" tabindex="-1" aria-labelledby="registerHealthWorkerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerHealthWorkerModalLabel">Register Health Worker</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <button type="submit" name="register_healthworker" class="btn btn-success">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Manage Users -->
        <div class="modal fade" id="manageUsersModal" tabindex="-1" aria-labelledby="manageUsersModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="manageUsersModalLabel">Manage Users</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($user = mysqli_fetch_assoc($userResult)) { ?>
                                    <tr>
                                        <td><?php echo $user['id']; ?></td>
                                        <td><?php echo $user['email']; ?></td>
                                        <td><?php echo $user['role']; ?></td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" onclick="return confirmDelete(<?php echo $user['id']; ?>)">Delete</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the deletion URL
                    window.location.href = `dashboard.php?deleteid=${id}`;
                }
            });
            return false; // Prevent default link behavior
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>