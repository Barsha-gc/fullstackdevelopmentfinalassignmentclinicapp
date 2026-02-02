<?php
session_start();
include "../includes/header.php";
?>

<div class="home-container">

    <div class="welcome-box">
        <h2>Welcome to the Clinic Appointment Scheduling System</h2>

        <p>
            This system allows patients to book appointments easily,
            while administrators manage doctors, patients, and schedules.
        </p>

        <?php if (isset($_SESSION['user_id'])): ?>
            <p style="margin-top:10px; font-weight:bold;">
                Logged in as: <?= htmlspecialchars($_SESSION['user_email']) ?>
            </p>
        <?php endif; ?>
    </div>

    <div class="features">

        <?php if (!isset($_SESSION['user_id'])): ?>
            <div class="feature-card">
                <h3>Book Appointment</h3>
                <p>Patients can book appointments without login.</p>
                <a href="book_appointment.php" class="btn-edit">
                    Book Now
                </a>
            </div>
        <?php endif; ?>


        <!-- Admin Panel -->
        <div class="feature-card">
            <h3>Admin Panel</h3>
            <p>Admins manage patients, doctors, and appointments.</p>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="patients.php" class="btn-edit">
                    Go to Admin Panel
                </a>
            <?php else: ?>
                <a href="../auth/login.php" class="btn-edit">
                    Admin Login
                </a>
            <?php endif; ?>
        </div>

    </div>

    <?php if (isset($_SESSION['user_id'])): ?>
        <div style="text-align:center; margin-top:30px;">
            <a href="../auth/logout.php" style="color:red; font-weight:bold;">
                Logout
            </a>
        </div>
    <?php endif; ?>

</div>

<?php include "../includes/footer.php"; ?>
