<?php
require 'dbForm.php';
session_start();
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body class="bg-light">
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
      <h3 class="text-center mb-4">Sign In</h3>

      <?php if (!empty($errors['login'])): ?>
        <div class="alert alert-danger"><?= $errors['login'] ?></div>
      <?php endif; ?>

      <form method="POST" action="user-account.php">
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" required>
        </div>
        <div class="mb-3">
          <div class="g-recaptcha" data-sitekey="6Lc3-QsrAAAAACr7zkgRS1HuGV-sew0EE5tzE4pF"></div>
        </div>
        <button type="submit" name="signin" class="btn btn-primary w-100">Login</button>
      </form>

      <p class="text-center mt-3">Don't have an account? <a href="register.php">Register</a></p>
    </div>
  </div>
</body>

</html>