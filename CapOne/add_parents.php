<?php
include 'dbForm.php';
session_start();
$role = $_SESSION['user']['role'] ?? '';
if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $query = "INSERT INTO parents (first_name, last_name, phone, email, address) 
              VALUES ('$first_name', '$last_name', '$phone', '$email', '$address')";

    if (mysqli_query($con, $query)) {
        // Also create a corresponding users account with role 'parent' if missing
        $fullName = mysqli_real_escape_string($con, trim($first_name . ' ' . $last_name));
        $emailEsc = mysqli_real_escape_string($con, $email);
        $accountNote = '';

        $check = mysqli_query($con, "SELECT id FROM users WHERE email = '$emailEsc' LIMIT 1");
        if ($check && mysqli_num_rows($check) === 0) {
            // Generate temporary password
            $tempPassword = '';
            try {
                $tempPassword = bin2hex(random_bytes(4)); // 8-char hex
            } catch (Exception $e) {
                $tempPassword = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789'), 0, 8);
            }
            $hashed = password_hash($tempPassword, PASSWORD_BCRYPT);
            $createdAt = date('Y-m-d');
            $insertUserSql = "INSERT INTO users (email, password, name, role, created_at) VALUES ('$emailEsc', '$hashed', '$fullName', 'parent', '$createdAt')";
            if (mysqli_query($con, $insertUserSql)) {
                $accountNote = "\nLogin Email: $email\nTemporary Password: $tempPassword";
            } else {
                $accountNote = "\n(Note: Failed to auto-create login account.)";
            }
        } else {
            $accountNote = "\n(Account already exists for this email.)";
        }

        $successMsg = "Parent added successfully!" . $accountNote;

        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: " . json_encode($successMsg) . ",
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
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to add parent information!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Record System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/theme.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <!-- Sidebar Menu -->
    <button class="toggle-btn" id="sidebarToggle"><i class="bi bi-list"></i> Menu</button>
    <div class="sidebar" id="sidebar">
        <h4 class="mb-4"><i class="bi bi-people"></i> Parent Record System</h4>
        <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="addinfant.php"><i class="bi bi-person-fill-add"></i> Add Infant</a>
        <?php if ($role === 'admin' || $role === 'healthworker'): ?>
            <a href="add_parents.php" class="active"><i class="bi bi-person-plus"></i> Add Parent</a>
            <a href="view_parents.php"><i class="bi bi-people"></i> Parent Records</a>
        <?php endif; ?>
        <a href="viewinfant.php"><i class="bi bi-journal-medical"></i> Infant Records</a>
        <a href="account_settings.php"><i class="bi bi-gear"></i> Account Settings</a>
        <?php if ($role !== 'parent'): ?>
            <a href="vaccination_schedule.php"><i class="bi bi-journal-medical"></i> Vaccination Schedule</a>
            <a href="sms.php"><i class="bi bi-chat-dots"></i> SMS Management</a>
            <a href="login_logs.php"><i class="bi bi-clipboard-data"></i> Logs</a>
        <?php endif; ?>
        <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>

    <div class="content-area">
        <div class="container-fluid mt-4">
            <div class="card card-shadow p-4">
                <h3 class="dashboard-title mb-4"><i class="bi bi-person-plus"></i>Parent Information Form</h3>
                <form method="POST" class="row g-3">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" placeholder="Enter first name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" placeholder="Enter last name" required>
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" name="phone" placeholder="09XXXXXXXXX">
                        <div class="form-help">Use PH format 09XXXXXXXXX or +63XXXXXXXXXX.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" name="address" rows="3" placeholder="Enter address"></textarea>
                    </div>

                    <div class="col-12 d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-outline-danger"><i class="bi bi-eraser"></i>Clear</button>
                        <button type="submit" name="submit" class="btn btn-outline-primary"><i class="bi bi-save"></i>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>