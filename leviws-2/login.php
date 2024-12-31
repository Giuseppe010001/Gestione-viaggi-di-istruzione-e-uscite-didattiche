<?php
session_start();
global $pdo;
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

require 'includes/db.php';
require 'includes/functions.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (loginUser($pdo, $_POST['username'], $_POST['password'])) {
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Login</h2>
    <form method="POST" class="mx-auto" style="max-width: 300px;">
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>
<script src="assets/js/jquery-3.7.1.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>