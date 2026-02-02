<?php
require_once "../auth/auth_check.php";
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

if (!isset($_GET['id'])) {
    header("Location: doctors.php");
    exit;
}

$id = $_GET['id'];

/* FETCH DOCTOR */
$stmt = $pdo->prepare("SELECT * FROM doctors WHERE id = ?");
$stmt->execute([$id]);
$doctor = $stmt->fetch();

if (!$doctor) {
    header("Location: doctors.php");
    exit;
}

/* UPDATE DOCTOR */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("UPDATE doctors SET name = ?, specialization = ? WHERE id = ?");
    $stmt->execute([
        $_POST['name'],
        $_POST['specialization'],
        $id
    ]);
    header("Location: doctors.php");
}
?>

<div class="container">
    <div class="form-card">
        <h3>Edit Doctor</h3>

        <form method="post">
            <label>Name</label>
            <input type="text" name="name" value="<?= e($doctor['name']) ?>" required>

            <label>Specialization</label>
            <input type="text" name="specialization" value="<?= e($doctor['specialization']) ?>">

            <button class="btn-primary">Update Doctor</button>
            <a href="doctors.php" class="btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php include "../includes/footer.php"; ?>
