<?php
require_once "../auth/auth_check.php";
require_once "../config/db.php";
include "../includes/header.php";

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("
        UPDATE appointments
        SET appointment_date=?, appointment_time=?
        WHERE id=?
    ");
    $stmt->execute([$_POST['date'], $_POST['time'], $id]);
    header("Location: appointments.php");
}

$appt = $pdo->prepare("SELECT * FROM appointments WHERE id=?");
$appt->execute([$id]);
$data = $appt->fetch();
?>

<form method="post">
    Date: <input type="date" name="date" value="<?= $data['appointment_date'] ?>"><br>
    Time: <input type="time" name="time" value="<?= $data['appointment_time'] ?>"><br>
    <button>Update</button>
</form>

<?php include "../includes/footer.php"; ?>
