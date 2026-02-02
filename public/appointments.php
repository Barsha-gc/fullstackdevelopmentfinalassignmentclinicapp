<?php
require_once "../auth/auth_check.php";
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

$sql = "
SELECT a.id, p.name AS patient, d.name AS doctor, a.appointment_date, a.appointment_time
FROM appointments a
JOIN patients p ON a.patient_id = p.id
JOIN doctors d ON a.doctor_id = d.id
ORDER BY a.appointment_date DESC
";

$appointments = $pdo->query($sql)->fetchAll();
?>

<div class="container">

    <!-- PAGE HEADER -->
    <div class="page-header">
        <h3>Appointments</h3>

        <div style="display:flex; gap:10px; justify-content:center; flex-wrap:wrap; margin-top:15px;">
            <a href="add_appointment.php" class="btn-edit">+ Add Appointment</a>

            <input
                type="text"
                id="search_patient"
                placeholder="Search Patient"
                style="padding:10px; border-radius:6px; border:1px solid #ccc;"
            >

            <input
                type="text"
                id="search_doctor"
                placeholder="Search Doctor"
                style="padding:10px; border-radius:6px; border:1px solid #ccc;"
            >
        </div>
    </div>

    <!-- SEARCH RESULTS -->
    <div id="search-results"></div>

    <!-- DEFAULT TABLE -->
    <div class="table-card" id="default-table">
        <div class="table-responsive">
            <table>
                <tr>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>

                <?php foreach ($appointments as $a): ?>
                    <tr>
                        <td><?= e($a['patient']) ?></td>
                        <td><?= e($a['doctor']) ?></td>
                        <td><?= e($a['appointment_date']) ?></td>
                        <td><?= e($a['appointment_time']) ?></td>
                        <td class="actions">
                            <a class="btn-edit" href="edit_appointment.php?id=<?= $a['id'] ?>">Edit</a>
                            <a
                                class="btn-delete"
                                href="delete_appointment.php?id=<?= $a['id'] ?>"
                                onclick="return confirm('Delete this appointment?')"
                            >
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>
        </div>
    </div>

</div>

<script>
const patientInput = document.getElementById("search_patient");
const doctorInput  = document.getElementById("search_doctor");
const resultsBox   = document.getElementById("search-results");
const defaultTable = document.getElementById("default-table");

function runSearch() {
    const patient = patientInput.value.trim();
    const doctor  = doctorInput.value.trim();

    if (patient === "" && doctor === "") {
        resultsBox.innerHTML = "";
        defaultTable.style.display = "block";
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "search_ajax.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        defaultTable.style.display = "none";
        resultsBox.innerHTML = this.responseText;
    };

    xhr.send(
        "patient=" + encodeURIComponent(patient) +
        "&doctor=" + encodeURIComponent(doctor)
    );
}

patientInput.addEventListener("keyup", runSearch);
doctorInput.addEventListener("keyup", runSearch);
</script>

<?php include "../includes/footer.php"; ?>
