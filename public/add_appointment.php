<?php
require_once "../auth/auth_check.php";
require_once "../config/db.php";
include "../includes/header.php";

$patients = $pdo->query("SELECT id, name FROM patients ORDER BY name")->fetchAll();

$doctors = $pdo->query("SELECT id, name FROM doctors ORDER BY name")->fetchAll();

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $patient_id = $_POST['patient'];
    $doctor_id  = $_POST['doctor'];
    $date       = $_POST['date'];
    $time       = $_POST['time'];

    $check = $pdo->prepare("
        SELECT COUNT(*) 
        FROM appointments 
        WHERE doctor_id = ? 
        AND appointment_date = ? 
        AND appointment_time = ?
    ");
    $check->execute([$doctor_id, $date, $time]);

    if ($check->fetchColumn() > 0) {
        $error = "❌ Time slot already booked for this doctor.";
    } else {
        $stmt = $pdo->prepare("
            INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$patient_id, $doctor_id, $date, $time]);

        header("Location: appointments.php");
        exit;
    }
}
?>

<div class="center-page">
    <div class="form-card">

        <h3>Add New Appointment</h3>

        <?php if (!empty($error)): ?>
            <p style="color:red; text-align:center; font-weight:bold;">
                <?= $error ?>
            </p>
        <?php endif; ?>

        <form method="post">

            <label>Patient</label>
            <select name="patient" required>
                <option value="">-- Select Patient --</option>
                <?php foreach ($patients as $p): ?>
                    <option value="<?= $p['id'] ?>">
                        <?= htmlspecialchars($p['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Doctor</label>
            <select name="doctor" required>
                <option value="">-- Select Doctor --</option>
                <?php foreach ($doctors as $d): ?>
                    <option value="<?= $d['id'] ?>">
                        <?= htmlspecialchars($d['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Appointment Date</label>
            <input type="date" name="date" required>

            <label>Appointment Time</label>
            <input type="time" name="time" required>

            <button type="submit">Book Appointment</button>

        </form>
    </div>
</div>

<?php include "../includes/footer.php"; ?>
