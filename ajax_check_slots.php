<?php
require_once "../auth/auth_check.php";
require_once "../config/db.php";

/* Get values safely */
$doctorName = $_GET['doctor'] ?? '';
$date = $_GET['date'] ?? '';

if (!$doctorName || !$date) {
    echo json_encode([]);
    exit;
}

/* Find doctor ID from name */
$stmt = $pdo->prepare("SELECT id FROM doctors WHERE name = ?");
$stmt->execute([$doctorName]);
$doctor = $stmt->fetch();

if (!$doctor) {
    echo json_encode([]);
    exit;
}

$doctorId = $doctor['id'];

/* Get booked slots */
$stmt = $pdo->prepare("
    SELECT appointment_time 
    FROM appointments
    WHERE doctor_id = ? AND appointment_date = ?
");
$stmt->execute([$doctorId, $date]);

echo json_encode($stmt->fetchAll(PDO::FETCH_COLUMN));
