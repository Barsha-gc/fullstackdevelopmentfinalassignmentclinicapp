<?php
require_once "../auth/auth_check.php";
require_once "../config/db.php";
require_once "../includes/functions.php";
include "../includes/header.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare(
        "INSERT INTO patients (name, email, phone) VALUES (?, ?, ?)"
    );
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['phone']
    ]);
    set_flash("Patient added successfully!", "success");
    header("Location: patients.php");
    exit;
}

$patients = $pdo->query("SELECT * FROM patients");
?>

<div class="container">

    <?php display_flash(); ?>

    <!-- CENTERED ADD PATIENT FORM -->
    <div class="center-page">
        <div class="form-card">
            <h3>Add Patient</h3>

            <form method="post">
                <label>Name</label>
                <input type="text" name="name" required>

                <label>Email</label>
                <input type="email" name="email" required>

                <label>Phone</label>
                <input type="text" name="phone" required>

                <button type="submit">Add Patient</button>
            </form>
        </div>
    </div>

    <!-- PATIENT LIST -->
    <div class="table-card">
        <h3>Patients List</h3>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($patients as $p): ?>
                        <tr>
                            <td><?= e($p['name']) ?></td>
                            <td><?= e($p['email']) ?></td>
                            <td><?= e($p['phone']) ?></td>
                            <td class="actions">
                                <a href="edit_patient.php?id=<?= $p['id'] ?>" class="btn-edit">Edit</a>
                                <a href="delete_patient.php?id=<?= $p['id'] ?>" class="btn-delete"
                                   onclick="return confirm('Are you sure?')">
                                   Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if ($patients->rowCount() == 0): ?>
                        <tr>
                            <td colspan="4" style="text-align:center;">No patients found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php include "../includes/footer.php"; ?>
