<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
            max-width: 640px;
            margin: 0 auto;
        }

        .help-text {
            font-size: 0.9rem;
            color: #6c757d;
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
        <a href="sms.php" class="active"><i class="bi bi-chat-dots"></i> SMS Management</a>
        <a href="login_logs.php"><i class="bi bi-bar-chart"></i> Logs</a>
        <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>

    <div class="content">
        <div class="container mt-4">
            <div class="card p-4 shadow-sm">
                <h3 class="mb-3"><i class="bi bi-chat-dots"></i> Send SMS</h3>
                <form id="messageForm">
                    <div class="mb-3">
                        <label for="number" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="number" placeholder="09XXXXXXXXX or +63XXXXXXXXXX" required>
                        <div class="help-text">Use PH format 09XXXXXXXXX or +63XXXXXXXXXX.</div>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="4" maxlength="765" placeholder="Type your message..." required></textarea>
                        <div class="form-text"><span id="charCount">0</span>/765</div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Send</button>
                        <button type="reset" class="btn btn-secondary">Clear</button>
                    </div>
                </form>
                <div class="mt-3" id="result" style="display:none;"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
        const messageInput = document.getElementById('message');
        const charCount = document.getElementById('charCount');
        messageInput.addEventListener('input', function() {
            charCount.textContent = this.value.length;
        });
    </script>
    <!-- apiKey.js omitted since API key input removed and key must be pre-saved -->
    <script src="script.js"></script>
</body>

</html>