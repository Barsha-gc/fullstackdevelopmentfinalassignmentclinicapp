<?php
require_once "../auth/auth_check.php";
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

if (isset($_POST['add_doctor'])) {
    $stmt = $pdo->prepare(
        "INSERT INTO doctors (name, specialization) VALUES (?, ?)"
    );
    $stmt->execute([
        $_POST['name'],
        $_POST['specialization']
    ]);
}

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM doctors WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header("Location: doctors.php");
    exit;
}

$doctors = $pdo->query("SELECT * FROM doctors");
?>

<div class="container">

    <div class="center-page">
        <div class="form-card">
            <h3>Add Doctor</h3>

            <form method="post">
                <label>Doctor Name</label>
                <input type="text" name="name" required>

                <label>Specialization</label>
                <input type="text" name="specialization">

                <button type="submit" name="add_doctor">Add Doctor</button>
            </form>
        </div>
    </div>
    
    <div class="table-card">
        <h3>Doctors List</h3>

        <div class="table-responsive">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Specialization</th>
                    <th>Actions</th>
                </tr>

                <?php foreach ($doctors as $d): ?>
                    <tr>
                        <td><?= e($d['name']) ?></td>
                        <td><?= e($d['specialization']) ?></td>
                        <td class="actions">
                            <a class="btn-edit" href="edit_doctor.php?id=<?= $d['id'] ?>">Edit</a>
                            <a class="btn-delete"
                               href="doctors.php?delete=<?= $d['id'] ?>"
                               onclick="return confirm('Delete this doctor?')">
                               Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

</div>

<?php include "../includes/footer.php"; ?>
