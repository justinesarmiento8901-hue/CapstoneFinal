<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card p-4 shadow-sm w-100" style="max-width: 800px;">
            <h3 class="text-center mb-4">Register</h3>

            <?php if (!empty($errors['user_exist'])): ?>
                <div class="alert alert-warning"><?= $errors['user_exist'] ?></div>
            <?php endif; ?>

            <form method="POST" action="user-account.php">
                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" name="first_name" placeholder="Enter your First Name" required>
                    <?php if (!empty($errors['firstname'])): ?>
                        <small class="text-danger"><?= $errors['firstname'] ?></small>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="last_name" placeholder="Enter your Last Name" required>
                    <?php if (!empty($errors['lastname'])): ?>
                        <small class="text-danger"><?= $errors['lastname'] ?></small>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" class="form-control" name="phone" placeholder="Enter your Phone Number" required>
                    <?php if (!empty($errors['phone'])): ?>
                        <small class="text-danger"><?= $errors['phone'] ?></small>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea class="form-control" name="address" placeholder="Enter your Address" rows="3" required></textarea>
                    <?php if (!empty($errors['address'])): ?>
                        <small class="text-danger"><?= $errors['address'] ?></small>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter your Email" required>
                    <?php if (!empty($errors['email'])): ?>
                        <small class="text-danger"><?= $errors['email'] ?></small>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                    <?php if (!empty($errors['password'])): ?>
                        <small class="text-danger"><?= $errors['password'] ?></small>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" required>
                    <?php if (!empty($errors['confirm_password'])): ?>
                        <small class="text-danger"><?= $errors['confirm_password'] ?></small>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select class="form-select" name="role" required>
                        <option value="" disabled selected>Select your role</option>
                        <option value="parent">Parent</option>
                    </select>
                    <?php if (!empty($errors['role'])): ?>
                        <small class="text-danger"><?= $errors['role'] ?></small>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <div class="g-recaptcha" data-sitekey="6Lc3-QsrAAAAACr7zkgRS1HuGV-sew0EE5tzE4pF"></div>
                </div>
                <button type="submit" name="signup" class="btn btn-success w-100">Submit</button>
            </form>
            <div class="text-center mt-3">
                <p>Already have an account? <a href="index.php">Login here</a></p>
            </div>
        </div>
    </div>
</body>

</html>