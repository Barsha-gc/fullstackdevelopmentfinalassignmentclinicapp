<?php
require_once "../config/db.php";
include "../includes/header.php";

$success = "";
$error = "";

/* Fetch doctors */
$doctors = $pdo->query("SELECT id, name FROM doctors ORDER BY name")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name      = trim($_POST["name"]);
    $email     = trim($_POST["email"]);
    $phone     = trim($_POST["phone"]);
    $doctor_id = trim($_POST["doctor_id"]);
    $date      = trim($_POST["date"]);
    $time      = trim($_POST["time"]);

    if ($name && $email && $phone && $doctor_id && $date && $time) {

        $stmt = $pdo->prepare("
            INSERT INTO appointments (patient_name, email, phone, doctor_id, appointment_date, appointment_time)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([$name, $email, $phone, $doctor_id, $date, $time]);

        $success = "Appointment booked successfully!";
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<div class="container">

    <div class="form-card">

        <h3>Book Appointment</h3>

        <?php if ($success): ?>
            <p class="success"><?= $success ?></p>
        <?php endif; ?>

        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST">

            <label>Your Name</label>
            <input type="text" name="name" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Phone Number</label>
            <input type="text" name="phone" required placeholder="98XXXXXXXX">

            <label>Doctor</label>
            <select name="doctor_id" required>
                <option value="">-- Select Doctor --</option>
                <?php foreach ($doctors as $doc): ?>
                    <option value="<?= $doc['id'] ?>">
                        <?= htmlspecialchars($doc['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Date</label>
            <input type="date" name="date" required>

            <label>Time</label>
            <input type="time" name="time" required>

            <button type="submit">Book Appointment</button>

        </form>

    </div>

</div>

<?php include "../includes/footer.php"; ?>
