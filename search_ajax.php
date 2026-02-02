<?php
require_once "../config/db.php";
require_once "../includes/functions.php";

$patient = trim($_POST['patient'] ?? '');
$doctor  = trim($_POST['doctor'] ?? '');

$sql = "
SELECT 
    p.name AS patient,
    d.name AS doctor,
    a.appointment_date,
    a.appointment_time
FROM appointments a
JOIN patients p ON a.patient_id = p.id
JOIN doctors d ON a.doctor_id = d.id
WHERE 1=1
";

$params = [];

if ($patient !== '') {
    $sql .= " AND p.name LIKE ?";
    $params[] = "%$patient%";
}

if ($doctor !== '') {
    $sql .= " AND d.name LIKE ?";
    $params[] = "%$doctor%";
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$results = $stmt->fetchAll();

if (!$results) {
    echo "<p style='text-align:center; margin-top:20px;'>No results found.</p>";
    exit;
}

echo "<div class='table-card'>";
echo "<div class='table-responsive'>";
echo "<table>";

echo "<tr>
        <th>Patient</th>
        <th>Doctor</th>
        <th>Date</th>
        <th>Time</th>
      </tr>";

foreach ($results as $row) {
    echo "<tr>
            <td>" . e($row['patient']) . "</td>
            <td>" . e($row['doctor']) . "</td>
            <td>" . e($row['appointment_date']) . "</td>
            <td>" . e($row['appointment_time']) . "</td>
          </tr>";
}

echo "</table>";
echo "</div>";
echo "</div>";
