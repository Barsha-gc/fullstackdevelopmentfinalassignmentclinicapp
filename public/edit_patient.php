<?php
require_once "../auth/auth_check.php";
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

if (!isset($_GET['id'])) {
    header("Location: patients.php");
    exit;
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM patients WHERE id = ?");
$stmt->execute([$id]);
$patient = $stmt->fetch();

if (!$patient) {
    set_flash("Patient not found!", "danger");
    header("Location: patients.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE patients SET name = ?, email = ?, phone = ? WHERE id = ?");
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['phone'],
        $id
    ]);
    set_flash("Patient updated successfully!", "success");
    header("Location: patients.php");
    exit;
}
?>

<div class="container">

    <?php display_flash(); ?>

    <div class="form-card">
        <h3>Edit Patient</h3>
        <form method="post">
            <label>Name</label>
            <input type="text" name="name" value="<?= e($patient['name']) ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?= e($patient['email']) ?>" required>

            <label>Phone</label>
            <input type="text" name="phone" value="<?= e($patient['phone']) ?>">

            <button type="submit">Update Patient</button>
            <a href="patients.php" class="btn-primary" style="margin-top:10px; display:inline-block;">Cancel</a>
        </form>
    </div>

</div>

<?php include "../includes/footer.php"; ?>
