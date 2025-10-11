<?php
session_start(); // ensure this is at the top if not already included
include 'dbForm.php';

// Check if the logged-in user is an admin
$showDeleteButton = isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin';

// Check if the logged-in user is a parent
$isParent = isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'parent';

?>



<?php
// SYNTAX FOR DELETING INFANT INFORMATION
if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];
    $sql = "DELETE FROM infantinfo WHERE id = '$id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        // ✅ LOGGING DELETION
        $logAction = "Deleted infant record with ID $id";
        $userIP = $_SERVER['REMOTE_ADDR'];
        $logQuery = "INSERT INTO logs_del_edit (action, user_ip) VALUES ('$logAction', '$userIP')";
        mysqli_query($con, $logQuery);

        echo "<script>
        Swal.fire({
            title: 'Success!',
            text: 'Infant information deleted successfully.',
            icon: 'success'
        }).then(() => {
            window.location.href = 'viewinfant.php';  // Redirect after success
        });
        </script>";
    } else {
        echo "<script>
        Swal.fire('Error', 'Failed to delete record.', 'error');
        </script>";
    }
}
?>

<?php
// SYNTAX FOR EDITING INFANT INFORMATION
if (isset($_POST['new_submit'])) {
    $id = $_POST['new_id'];
    $new_firstname = $_POST['new_firstname'];
    $new_middlename = $_POST['new_middle'];
    $new_surname = $_POST['new_surname'];
    $new_dateofbirth = $_POST['new_dateofbirth'];
    $new_placeofbirth = $_POST['new_birthplace'];
    $new_nationality = $_POST['new_nationality'];
    $new_weight = $_POST['new_weight'];
    $new_height = $_POST['new_height'];

    $sql = "UPDATE infantinfo SET 
                firstname = '$new_firstname', 
                middlename = '$new_middlename', 
                surname = '$new_surname', 
                dateofbirth = '$new_dateofbirth',
                placeofbirth = '$new_placeofbirth', 
                nationality = '$new_nationality', 
                weight = '$new_weight', 
                height = '$new_height'
            WHERE id = '$id'";

    $result = mysqli_query($con, $sql);
    if ($result) {
        // ✅ LOGGING UPDATE
        $logAction = "Updated infant record with ID $id";
        $userIP = $_SERVER['REMOTE_ADDR'];
        $logQuery = "INSERT INTO logs_del_edit (action, user_ip) VALUES ('$logAction', '$userIP')";
        mysqli_query($con, $logQuery);

        echo "<script>
        Swal.fire({
            title: 'Success!',
            text: 'Infant information updated successfully.',
            icon: 'success'
        }).then(() => {
            window.location.href = 'viewinfant.php';  // Redirect after success
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
    <title>Document</title>
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
        <h4 class="mb-4"><i class="bi bi-baby"></i> Infant Record System</h4>
        <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="addinfant.php"><i class="bi bi-person"></i> Add Infant</a>
        <?php if (isset($_SESSION['user']['role']) && ($_SESSION['user']['role'] === 'admin' || $_SESSION['user']['role'] === 'healthworker')): ?>
            <a href="add_parents.php"><i class="bi bi-person-plus"></i> Add Parent</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['user']['role']) && ($_SESSION['user']['role'] === 'admin' || $_SESSION['user']['role'] === 'healthworker' || $_SESSION['user']['role'] === 'parent')): ?>
            <a href="view_parents.php"><i class="bi bi-book"></i> Parent Records</a>
        <?php endif; ?>
        <a href="viewinfant.php" class="active"><i class="bi bi-book"></i> Infant Records</a>
        <div class="dropdown">
            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-syringe"></i> Vaccination Schedule</a>
            <div class="dropdown-menu">
                <a href="#upcoming" class="dropdown-item">Upcoming Vaccinations</a>
                <a href="#completed" class="dropdown-item">Completed Vaccinations</a>
            </div>
        </div>
        <a href="#sms"><i class="bi bi-chat-dots"></i> SMS Management</a>
        <a href="login_logs.php"><i class="bi bi-bar-chart"></i> Logs</a>
        <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header text-center bg-primary text-white">
                <h4>Infant Information</h4>
            </div>
            <div class="card-body">
                <!-- Search Bar -->
                <form method="GET" action="viewinfant.php" class="mb-3">
                    <div class="input-group">
                        <input type="text" id="search" class="form-control" placeholder="Search by ID, Name, or Birthplace...">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                    </div>
                </form>
                <!-- Table -->
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Middle Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Place of Birth</th>
                            <th scope="col">Sex</th>
                            <th scope="col">Weight</th>
                            <th scope="col">Height</th>
                            <th scope="col">BloodType</th>
                            <th scope="col">Nationality</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // FOR VIEWING INFANT INFORMATION

                        // $sql = "SELECT * FROM infantinfo";
                        $search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

                        if (!empty($search)) {
                            $sql = "SELECT * FROM infantinfo WHERE 
                                id LIKE '%$search%' OR
                                firstname LIKE '%$search%' OR 
                                middlename LIKE '%$search%' OR 
                                surname LIKE '%$search%' OR 
                                placeofbirth LIKE '%$search%'";
                        } else {
                            $sql = "SELECT * FROM infantinfo";
                        }

                        $result = mysqli_query($con, $sql);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                $firstname = $row['firstname'];
                                $middlename = $row['middlename'];
                                $surname = $row['surname'];
                                $dateofbirth = $row['dateofbirth'];
                                $placeofbirth = $row['placeofbirth'];
                                $sex = $row['sex'];
                                $weight = $row['weight'];
                                $height = $row['height'];
                                $bloodtype = $row['bloodtype'];
                                $nationality = $row['nationality']; ?>

                                <tr>
                                    <th scope="row"><?php echo $id; ?></th>
                                    <td><?php echo $firstname; ?></td>
                                    <td><?php echo $middlename; ?></td>
                                    <td><?php echo $surname; ?></td>
                                    <td><?php echo $dateofbirth; ?></td>
                                    <td><?php echo $placeofbirth; ?></td>
                                    <td><?php echo $sex; ?></td>
                                    <td><?php echo $weight; ?></td>
                                    <td><?php echo $height; ?></td>
                                    <td><?php echo $bloodtype; ?></td>
                                    <td><?php echo $nationality; ?></td>
                                    <td>
                                        <?php if (!$isParent): ?>
                                            <!-- Trigger modal using data-bs-toggle and data-bs-target -->
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#formModal_<?php echo $id; ?>">Edit</button>
                                            <?php if ($showDeleteButton): ?>
                                                <a href="viewinfant.php?deleteid=<?php echo $id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                                <!-- Modal for EDIT -->
                                <!-- Modal for EDIT -->
                                <div class="modal fade" id="formModal_<?php echo $id; ?>" tabindex="-1" aria-labelledby="formModalLabel_<?php echo $id; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-primary" id="formModalLabel_<?php echo $id; ?>">Edit Infant Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="viewinfant.php">
                                                    <input type="hidden" name="new_id" value="<?php echo $id; ?>">

                                                    <div class="mb-3">
                                                        <label class="form-label">First Name</label>
                                                        <input type="text" class="form-control" name="new_firstname" value="<?php echo $firstname; ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Middle Name</label>
                                                        <input type="text" class="form-control" name="new_middle" value="<?php echo $middlename; ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Surname</label>
                                                        <input type="text" class="form-control" name="new_surname" value="<?php echo $surname; ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Date of Birth</label>
                                                        <input type="date" class="form-control" name="new_dateofbirth" value="<?php echo $dateofbirth; ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Place of Birth</label>
                                                        <input type="text" class="form-control" name="new_birthplace" value="<?php echo $placeofbirth; ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Nationality</label>
                                                        <input type="text" class="form-control" name="new_nationality" value="<?php echo $nationality; ?>">
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Weight (kg)</label>
                                                            <input type="number" class="form-control" name="new_weight" value="<?php echo $weight; ?>" step="0.01" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Height (cm)</label>
                                                            <input type="number" class="form-control" name="new_height" value="<?php echo $height; ?>" step="0.1" required>
                                                        </div>
                                                    </div>

                                                    <div class="text-center">
                                                        <button type="submit" name="new_submit" class="btn btn-primary w-50">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            } // Close the while loop
                        } // Close the if block
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
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
                window.location.href = `viewinfant.php?deleteid=${id}`;
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

    // Search function AJAX

    $(document).ready(function() {
        $("#search").on("keyup", function() {
            let searchText = $(this).val(); // Get input value
            $.ajax({
                url: "search_infant.php", // PHP file that will handle search
                method: "GET",
                data: {
                    search: searchText
                },
                success: function(response) {
                    $("tbody").html(response); // Update table with results
                }
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>