<?php
require_once "../auth/auth_check.php";
require_once "../config/db.php";
require_once "../includes/functions.php";

if (!isset($_GET['id'])) {
    header("Location: patients.php");
    exit;
}

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM patients WHERE id = ?");
$stmt->execute([$id]);

set_flash("Patient deleted successfully!", "danger");
header("Location: patients.php");
exit;
