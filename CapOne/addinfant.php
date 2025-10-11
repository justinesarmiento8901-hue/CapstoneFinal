<?php
session_start(); // Ensure session is started
include 'dbForm.php';

// Debugging to confirm session role
error_log("Session Role: " . (isset($_SESSION['user']['role']) ? $_SESSION['user']['role'] : 'Not Set'));
//ichcheck kung yung role ay nakaset sa loob ng user at role if not set else 'Not Set'

if (isset($_POST['submit'])) {
    $parent_id = $_POST['parent_id'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename']; // Updated from middle to middlename
    $surname = $_POST['surname'] ?? '';
    $dateofbirth = $_POST['dateofbirth'];
    $placeofbirth = $_POST['placeofbirth'];
    $sex = $_POST['sex'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $bloodtype = $_POST['bloodtype'];
    $nationality = $_POST['nationality'] ?? '';

    $sql = "INSERT INTO `Infantinfo`(`parent_id`, `firstname`, `middlename`, `surname`, `dateofbirth`, `placeofbirth`, `sex`, `weight`, `height`, `bloodtype`, `nationality`)
            VALUES ('$parent_id', '$firstname', '$middlename', '$surname', '$dateofbirth', '$placeofbirth','$sex', '$weight', '$height', '$bloodtype','$nationality')";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Infant information added successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'view_parents.php';
                    }
                });
            });
        </script>";
    } else {
        error_log("Database Error: " . mysqli_error($con)); // Log database error
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to add infant information!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
    }
}

if (isset($_POST['search'])) {
    $search_query = $_POST['search_query'];
    $search_sql = "SELECT `id`, `first_name`, `last_name` FROM `Parents` WHERE `first_name` LIKE '%$search_query%' OR `last_name` LIKE '%$search_query%'";
    $search_result = mysqli_query($con, $search_sql);
}

if (isset($_POST['fetch_parent_id'])) {
    $search_query = $_POST['search_query'];
    $search_sql = "SELECT `id`, `first_name`, `last_name` FROM `Parents` WHERE `first_name` LIKE '%$search_query%' OR `last_name` LIKE '%$search_query%' LIMIT 1";
    $search_result = mysqli_query($con, $search_sql);
    $parent_data = mysqli_fetch_assoc($search_result);
}

if (isset($_POST['live_search'])) {
    $search_query = $_POST['search_query'];
    $search_sql = "SELECT `id`, `first_name`, `last_name` 
                   FROM `Parents` 
                   WHERE `id` LIKE '%$search_query%' 
                      OR `first_name` LIKE '%$search_query%' 
                      OR `last_name` LIKE '%$search_query%'";
    $search_result = mysqli_query($con, $search_sql);

    $results = [];
    while ($row = mysqli_fetch_assoc($search_result)) {
        $results[] = $row;
    }
    echo json_encode($results);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infant Record System - Sidebar</title>
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

        /* Add styles for live search results */
        .live-search-results {
            border: 1px solid #ccc;
            max-height: 200px;
            overflow-y: auto;
            background-color: #fff;
            position: absolute;
            z-index: 1000;
            width: 100%;
        }

        .live-search-results div {
            padding: 10px;
            cursor: pointer;
        }

        .live-search-results div:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <button class="toggle-btn" onclick="toggleSidebar()"><i class="bi bi-list"></i> Menu</button>
    <div class="sidebar" id="sidebar">
        <h4 class="mb-4"><i class="bi bi-baby"></i> Infant Record System</h4>
        <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="addinfant.php" class="active"><i class="bi bi-person"></i> Add Infant</a>
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

    <div class="container mt-4">
        <div class="card p-4">
            <h2 class="mb-3">Infant Information Form</h2>



            <!-- Show current session user ID if available -->
            <?php if (isset($_SESSION['user']['id'])): ?>
                <div class="row mb-3">
                    <div class="col-md-8">
                        <p class="text-info">Current Session User ID: <strong><?php echo $_SESSION['user']['id']; ?></strong></p>
                    </div>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="parentId" class="form-label">Parent ID</label>
                        <select class="form-select" name="parent_id" required>
                            <option value="">Select Parent</option>
                            <?php
                            // Fetch all parents from the database
                            $parentQuery = "SELECT id, first_name, last_name FROM parents";
                            $parentResult = mysqli_query($con, $parentQuery);
                            while ($parentRow = mysqli_fetch_assoc($parentResult)) {
                                $selected = '';
                                // Preselect if session user is parent and matches this id
                                if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'parent' && $_SESSION['user']['id'] == $parentRow['id']) {
                                    $selected = 'selected';
                                }
                                // Preselect if parent_data is set (from search)
                                if (isset($parent_data['id']) && $parent_data['id'] == $parentRow['id']) {
                                    $selected = 'selected';
                                }
                                echo "<option value=\"{$parentRow['id']}\" $selected>{$parentRow['id']} - {$parentRow['first_name']} {$parentRow['last_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="firstname" placeholder="Enter first name"
                            style="text-transform:capitalize" required>
                    </div>
                    <div class="col-md-4">
                        <label for="middleName" class="form-label">Middle Name</label> <!-- Updated label -->
                        <input type="text" class="form-control" name="middlename" placeholder="Enter middle name" required>
                    </div>
                    <div class="col-md-4">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="surname" placeholder="Enter last name"
                            style="text-transform:capitalize" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="dateofbirth"
                            min="1900-01-01"
                            max="2025-01-01" required>
                    </div>
                    <div class="col-md-4">
                        <label for="placeOfBirth" class="form-label">Place of Birth</label>
                        <input type="text" class="form-control" name="placeofbirth" placeholder="Enter place of birth"
                            style="text-transform:capitalize" required>
                    </div>
                    <div class="col-md-4">
                        <label for="sex" class="form-label">Sex</label>
                        <select class="form-select" name="sex" required>
                            <option selected>Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="weight" class="form-label">Weight (kg)</label>
                        <input type="number" class="form-control" name="weight" placeholder="Enter weight" required>
                    </div>
                    <div class="col-md-4">
                        <label for="height" class="form-label">Height (cm)</label>
                        <input type="number" class="form-control" name="height" placeholder="Enter height" required>
                    </div>
                    <div class="col-md-4">
                        <label for="bloodType" class="form-label">Blood Type</label>
                        <select class="form-select" name="bloodtype" required>
                            <option selected>Select</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="nationality" class="form-label">Nationality</label>
                        <input type="text" class="form-control" name="nationality" placeholder="Enter nationality"
                            style="text-transform:capitalize" required>
                    </div>
                    <div class="col-md-4">
                        <label for="action">Action</label>
                        <br>
                        <button type="button" id="clearBtn" class="btn btn-danger">Clear</button>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

        document.getElementById("clearBtn").addEventListener("click", function() {
            document.querySelectorAll("input, select").forEach(field => {
                if (field.type !== "submit" && field.type !== "button") {
                    field.value = "";
                }
            });
        });

        $(document).ready(function() {
            $('#searchQuery').on('input', function() {
                const query = $(this).val();
                if (query.length > 0) {
                    $.ajax({
                        url: 'addinfant.php',
                        type: 'POST',
                        data: {
                            live_search: true,
                            search_query: query
                        },
                        success: function(response) {
                            const results = JSON.parse(response);
                            let html = '';
                            results.forEach(result => {
                                html += `<div data-id="${result.id}" data-name="${result.first_name} ${result.last_name}">
                                            ${result.id} - ${result.first_name} ${result.last_name}
                                         </div>`;
                            });
                            $('#liveSearchResults').html(html).show();
                        }
                    });
                } else {
                    $('#liveSearchResults').hide();
                }
            });

            $(document).on('click', '#liveSearchResults div', function() {
                const parentId = $(this).data('id');
                const parentName = $(this).data('name');
                $('#searchQuery').val(parentName);
                $('input[name="parent_id"]').val(parentId);
                $('#liveSearchResults').hide();
            });

            $(document).click(function(e) {
                if (!$(e.target).closest('#searchQuery, #liveSearchResults').length) {
                    $('#liveSearchResults').hide();
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>