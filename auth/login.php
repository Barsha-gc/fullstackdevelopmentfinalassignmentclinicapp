<?php
session_start();
require_once "../config/db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email === "" || $password === "") {
        $error = "All fields are required.";
    } else {

        $stmt = $pdo->prepare(
            "SELECT id, email, password FROM clinic_users WHERE email = ? LIMIT 1"
        );
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {

            // Login success
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];

            header("Location: ../public/index.php");
            exit;

        } else {
            $error = "Invalid login credentials.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clinic Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
    <div class="form-card">
        <h3>Clinic Login</h3>

        <?php if (!empty($error)): ?>
            <p style="color:red; text-align:center;">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>

        <form method="post" autocomplete="off">

            <label>Email</label>
            <input
                type="email"
                name="email"
                required
                autocomplete="off"
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
            >

            <label>Password</label>
            <input
                type="password"
                name="password"
                required
                autocomplete="off"
            >

            <button type="submit">Login</button>
        </form>
    </div>
</div>

</body>
</html>
