function checkSlots() {
    const doctor = document.querySelector("[name='doctor']").value;
    const date = document.getElementById("date").value;

    if (!doctor || !date) {
        document.getElementById("slots").innerText = "Please select doctor and date.";
        return;
    }

    fetch(`ajax_check_slots.php?doctor=${encodeURIComponent(doctor)}&date=${encodeURIComponent(date)}`)
        .then(res => res.json())
        .then(data => {
            if (data.length === 0) {
                document.getElementById("slots").innerText = "No slots booked yet.";
            } else {
                document.getElementById("slots").innerText =
                    "Booked slots: " + data.join(", ");
            }
        })
        .catch(err => {
            document.getElementById("slots").innerText = "Error loading slots.";
            console.error(err);
        });
}
