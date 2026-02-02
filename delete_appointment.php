<?php
require_once "../auth/auth_check.php";
require_once "../config/db.php";

$stmt = $pdo->prepare("DELETE FROM appointments WHERE id=?");
$stmt->execute([$_GET['id']]);

header("Location: appointments.php");
