<?php
session_start(); // Ensure session is started
include 'dbForm.php'; // Include database connection file

// Check if the logged-in user is an admin
$showDeleteButton = isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin';

$isParent = isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'parent';

// Handle deletion
if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];
    $sql = "DELETE FROM parents WHERE id = '$id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        // Log deletion
        $logAction = "Deleted parent record with ID $id";
        $userIP = $_SERVER['REMOTE_ADDR'];
        $logQuery = "INSERT INTO logs_del_edit (action, user_ip) VALUES ('$logAction', '$userIP')";
        mysqli_query($con, $logQuery);

        echo "<script>
        Swal.fire({
            title: 'Success!',
            text: 'Parent information deleted successfully.',
            icon: 'success'
        }).then(() => {
            window.location.href = 'view_parents.php';
        });
        </script>";
    } else {
        echo "<script>
        Swal.fire('Error', 'Failed to delete record.', 'error');
        </script>";
    }
}

// Handle editing
if (isset($_POST['update_submit'])) {
    $id = $_POST['update_id'];
    $first_name = $_POST['update_first_name'];
    $last_name = $_POST['update_last_name'];
    $phone = $_POST['update_phone_number'];
    $email = $_POST['update_email'];
    $address = $_POST['update_address'];

    $sql = "UPDATE parents SET 
                first_name = '$first_name', 
                last_name = '$last_name', 
                phone = '$phone', 
                email = '$email', 
                address = '$address'
            WHERE id = '$id'";

    $result = mysqli_query($con, $sql);
    if ($result) {
        // Log update
        $logAction = "Updated parent record with ID $id";
        $userIP = $_SERVER['REMOTE_ADDR'];
        $logQuery = "INSERT INTO logs_del_edit (action, user_ip) VALUES ('$logAction', '$userIP')";
        mysqli_query($con, $logQuery);

        echo "<script>
        Swal.fire({
            title: 'Success!',
            text: 'Parent information updated successfully.',
            icon: 'success'
        }).then(() => {
            window.location.href = 'view_parents.php';
        });
        </script>";
    } else {
        echo "<script>
        Swal.fire('Error', 'Failed to update record.', 'error');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Parent Records</title>
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

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
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
</head>

<body>
    <!-- Sidebar Menu -->
    <button class="toggle-btn" onclick="toggleSidebar()"><i class="bi bi-list"></i> Menu</button>
    <div class="sidebar" id="sidebar">
        <h4 class="mb-4"><i class="bi bi-people"></i> Parent Record System</h4>
        <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="addinfant.php"><i class="bi bi-person"></i> Add Infant</a>
        <?php if (isset($_SESSION['user']['role']) && ($_SESSION['user']['role'] === 'admin' || $_SESSION['user']['role'] === 'healthworker')): ?>
            <a href="add_parents.php"><i class="bi bi-person-plus"></i> Add Parent</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['user']['role']) && ($_SESSION['user']['role'] === 'admin' || $_SESSION['user']['role'] === 'healthworker' || $_SESSION['user']['role'] === 'parent')): ?>
            <a href="view_parents.php" class="active"><i class="bi bi-book"></i> Parent Records</a>
        <?php endif; ?>
        <a href="viewinfant.php"><i class="bi bi-book"></i> Infant Records</a>
        <div class="dropdown">
            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-syringe"></i> Vaccination Schedule</a>
            <div class="dropdown-menu">
                <a href="#upcoming" class="dropdown-item">Upcoming Vaccinations</a>
                <a href="#completed" class="dropdown-item">Completed Vaccinations</a>
            </div>
        </div>
        <a href="sms.php"><i class="bi bi-chat-dots"></i> SMS Management</a>
        <a href="login_logs.php"><i class="bi bi-bar-chart"></i> Logs</a>
        <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
    <div class="content">
        <div class="container mt-4">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Parent Information</h4>
                </div>
                <div class="card-body">
                    <!-- Add Infant Button -->
                    <div class="mb-3 text-start">
                        <a href="addinfant.php" class="btn btn-primary">Add Infant</a>
                    </div>
                    <!-- Search Bar -->
                    <form method="GET" action="view_parents.php" class="mb-3">
                        <div class="input-group">
                            <input type="text" id="search" class="form-control" placeholder="Search by ID, Name, or Email...">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                        </div>
                    </form>
                    <!-- Table -->
                    <table class="table table-bordered table-striped text-center">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                                <th scope="col">Infant IDs</th>
                                <th scope="col">Infant Names</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

                            // if (isset($_GET['search'])) {
                            //     $search = mysqli_real_escape_string($con, $_GET['search']);
                            // } else {
                            //     $search = '';
                            // }


                            if (!empty($search)) {
                                $sql = "SELECT parents.*, 
                                           GROUP_CONCAT(infantinfo.id SEPARATOR ', ') AS infant_ids, 
                                           GROUP_CONCAT(infantinfo.firstname SEPARATOR ', ') AS infant_names
                                        FROM parents
                                        LEFT JOIN infantinfo ON parents.id = infantinfo.parent_id
                                        WHERE 
                                            parents.id LIKE '%$search%' OR
                                            parents.first_name LIKE '%$search%' OR 
                                            parents.last_name LIKE '%$search%' OR 
                                            parents.email LIKE '%$search%'
                                        GROUP BY parents.id";
                            } else {
                                $sql = "SELECT parents.*, 
                                           GROUP_CONCAT(infantinfo.id SEPARATOR ', ') AS infant_ids, 
                                           GROUP_CONCAT(infantinfo.firstname SEPARATOR ', ') AS infant_names
                                        FROM parents
                                        LEFT JOIN infantinfo ON parents.id = infantinfo.parent_id
                                        GROUP BY parents.id";
                            }

                            $result = mysqli_query($con, $sql);
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['id']; // Corrected column name from 'parent_id' to 'id'
                                    $first_name = $row['first_name'];
                                    $last_name = $row['last_name'];
                                    $phone = $row['phone'];
                                    $email = $row['email'];
                                    $address = $row['address']; ?>

                                    <tr>
                                        <th scope="row"><?php echo $id; ?></th>
                                        <td><?php echo $first_name; ?></td>
                                        <td><?php echo $last_name; ?></td>
                                        <td><?php echo $phone; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $address; ?></td>
                                        <td><?php echo $row['infant_ids'] ?: 'N/A'; ?></td> <!-- Display concatenated Infant IDs -->
                                        <td><?php echo $row['infant_names'] ?: 'N/A'; ?></td> <!-- Display concatenated Infant Names -->
                                        <td>
                                            <?php if (!$isParent): // Allow actions only if the user is not a parent 
                                            ?>
                                                <button class="btn btn-success btn-sm" onclick="confirmEdit(<?php echo $id; ?>)">Edit</button>
                                                <?php if ($showDeleteButton): ?>
                                                    <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $id; ?>)">Delete</button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <a href="view_details.php?parent_id=<?php echo $id; ?>" class="btn btn-info btn-sm">Details</a>
                                        </td>
                                    </tr>

                                    <!-- Modal for EDIT -->
                                    <div class="modal fade" id="formModal_<?php echo $id; ?>" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-primary" id="formModalLabel">Edit Parent Information</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="view_parents.php">
                                                        <input type="hidden" name="update_id" value="<?php echo $id; ?>">
                                                        <div class="mb-3">
                                                            <label for="first_name" class="form-label">First Name</label>
                                                            <input type="text" class="form-control" name="update_first_name" value="<?php echo $first_name; ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="last_name" class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" name="update_last_name" value="<?php echo $last_name; ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="phone_number" class="form-label">Phone Number</label>
                                                            <input type="text" class="form-control" name="update_phone_number" value="<?php echo $phone; ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" class="form-control" name="update_email" value="<?php echo $email; ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="address" class="form-label">Address</label>
                                                            <textarea class="form-control" name="update_address"><?php echo $address; ?></textarea>
                                                        </div>
                                                        <div class="text-center">
                                                            <button type="submit" name="update_submit" class="btn btn-primary w-50">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
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
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `view_parents.php?deleteid=${id}`;
                }
            });
        }

        function confirmEdit(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to edit this entry?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, edit it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var myModal = new bootstrap.Modal(document.getElementById(`formModal_${id}`));
                    myModal.show();
                }
            });
        }

        $(document).ready(function() {
            $("#search").on("keyup", function() {
                let searchText = $(this).val();
                $.ajax({
                    url: "search_parents.php",
                    method: "POST",
                    data: {
                        search: searchText
                    },
                    success: function(response) {
                        $("table tbody").html(response);
                    },
                    error: function() {
                        console.error("An error occurred while processing the search request.");
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>