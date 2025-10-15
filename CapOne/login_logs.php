<?php
require 'dbForm.php';
session_start();

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  http_response_code(403); // Forbidden
  echo "<h1>403 Forbidden</h1><p>You do not have permission to access this page.</p>";
  exit;
}

// Fetch all login logs (both successful and failed)
$query = "SELECT * FROM user_logins ORDER BY timestamp DESC";
$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login Logs</title>
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
</head>

<body class="bg-light">
  <button class="toggle-btn" onclick="toggleSidebar()"><i class="bi bi-list"></i> Menu</button>
  <div class="sidebar" id="sidebar">
    <h4 class="mb-4"><i class="bi bi-baby"></i> Infant Record System</h4>
    <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="addinfant.php"><i class="bi bi-person"></i> Add Infant</a>
    <a href="add_parents.php"><i class="bi bi-person-plus"></i> Add Parent</a>
    <a href="viewinfant.php"><i class="bi bi-book"></i> Infant Records</a>
    <a href="view_parents.php"><i class="bi bi-book"></i> Parent Records</a>
    <div class="dropdown">
      <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-syringe"></i> Vaccination Schedule</a>
      <div class="dropdown-menu">
        <a href="#upcoming" class="dropdown-item">Upcoming Vaccinations</a>
        <a href="#completed" class="dropdown-item">Completed Vaccinations</a>
      </div>
    </div>
    <a href="sms.php"><i class="bi bi-chat-dots"></i> SMS Management</a>
    <a href="login_logs.php" class="active"><i class="bi bi-bar-chart"></i>Logs</a>
    <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
  </div>
  <div class="container mt-5">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h4 class="mb-0">User Login Logs</h4>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-bordered table-striped table-hover">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>User ID</th>
              <th>Email</th>
              <th>IP Address</th>
              <th>Status</th>
              <th>Reason</th>
              <th>Timestamp</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
              <?php $i = 1; ?>
              <?php while ($row = $result->fetch_assoc()): ?>
                <tr class="<?= $row['success'] ? 'table-success' : 'table-danger' ?>">
                  <td><?= $i++ ?></td>
                  <td><?= $row['user_id'] ?? 'N/A' ?></td>
                  <td><?= htmlspecialchars($row['email']) ?></td>
                  <td><?= htmlspecialchars($row['ip_address']) ?></td>
                  <td>
                    <?= $row['success'] ? '<span class="badge bg-success">Success</span>' : '<span class="badge bg-danger">Failed</span>' ?>
                  </td>
                  <td><?= htmlspecialchars($row['reason']) ?></td>
                  <td><?= date("Y-m-d H:i:s", strtotime($row['timestamp'])) ?></td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr>
                <td colspan="7" class="text-center text-muted">No login logs found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('active');
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>