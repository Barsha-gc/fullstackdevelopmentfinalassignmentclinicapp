<?php
session_start();
require_once "../config/db.php";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm = trim($_POST['confirm_password'] ?? '');

    // Basic validation
    if ($email === "" || $password === "" || $confirm === "") {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {

        // Check if email already exists
        $check = $pdo->prepare("SELECT id FROM clinic_users WHERE email = ?");
        $check->execute([$email]);

        if ($check->rowCount() > 0) {
            $error = "Email already registered.";
        } else {

            // Hash password (THIS FIXES YOUR ISSUE)
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert user
            $stmt = $pdo->prepare(
                "INSERT INTO clinic_users (email, password) VALUES (?, ?)"
            );

            if ($stmt->execute([$email, $hashedPassword])) {
                $success = "Registration successful. You can now log in.";
            } else {
                $error = "Something went wrong. Try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
    <div class="form-card">
        <h3>Clinic Registration</h3>

        <?php if ($error): ?>
            <p style="color:red; text-align:center;">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p style="color:green; text-align:center;">
                <?= htmlspecialchars($success) ?>
            </p>
        <?php endif; ?>

        <form method="post" autocomplete="off">

            <label>Email</label>
            <input
                type="email"
                name="email"
                required
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
            >

            <label>Password</label>
            <input
                type="password"
                name="password"
                required
            >

            <label>Confirm Password</label>
            <input
                type="password"
                name="confirm_password"
                required
            >

            <button type="submit">Register</button>

            <p style="text-align:center; margin-top:10px;">
                Already have an account?
                <a href="login.php">Login</a>
            </p>
        </form>
    </div>
</div>

</body>
</html>
