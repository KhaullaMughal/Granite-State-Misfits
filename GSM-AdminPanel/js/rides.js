

function openAddRideModal() {
    const modal = document.getElementById("rideModal");
    modal.classList.add("show");
}

function closeRideModal() {

    const modal = document.getElementById("rideModal");

    modal.classList.remove("show");

}


/* =========================
   SAVE RIDE
========================= */

function saveRide(event) {

    event.preventDefault();

    const rideName =
        document.getElementById("rideName").value;

    const rideDate =
        document.getElementById("rideDate").value;

    const startPoint =
        document.getElementById("startPoint").value;

    const destination =
        document.getElementById("destination").value;


    if (!rideName || !rideDate || !startPoint || !destination) {

        alert("Please fill in all required fields.");

        return;

    }


    /*
        Temporary frontend functionality.

        Later this will send the data
        to PHP/MySQL using fetch().
    */

    alert(
        "Ride created successfully!\n\n" +
        "Ride: " + rideName
    );


    document.getElementById("rideForm").reset();

    closeRideModal();

}


/* =========================
   SEARCH RIDES
========================= */

function searchRides() {

    const input =
        document.getElementById("rideSearch");

    const search =
        input.value.toLowerCase();

    const rows =
        document.querySelectorAll("#ridesTable tbody tr");


    rows.forEach(function (row) {

        const text =
            row.innerText.toLowerCase();

        if (text.includes(search)) {

            row.style.display = "";

        } else {

            row.style.display = "none";

        }

    });

}


/* =========================
   FILTER RIDES
========================= */

function filterRides() {

    const filter =
        document.getElementById("statusFilter").value;

    const rows =
        document.querySelectorAll("#ridesTable tbody tr");


    rows.forEach(function (row) {

        const status =
            row.querySelector(".ride-status");


        if (!status) {
            return;
        }


        const currentStatus =
            status.innerText
                .trim()
                .toLowerCase();


        if (
            filter === "all" ||
            currentStatus === filter
        ) {

            row.style.display = "";

        } else {

            row.style.display = "none";

        }

    });

}


/* =========================
   DELETE RIDE
========================= */

function deleteRide(button) {

    const confirmation = confirm(
        "Are you sure you want to delete this ride?\n\n" +
        "This action cannot be undone."
    );


    if (!confirmation) {
        return;
    }


    const row =
        button.closest("tr");


    if (row) {

        row.style.opacity = "0";

        setTimeout(function () {

            row.remove();

        }, 250);

    }


    alert("Ride deleted successfully.");

}


/* =========================
   VIEW RIDE
========================= */

function viewRide(rideId) {

    window.location.href =
        "ride-details.html?id=" + rideId;

}


/* =========================
   EDIT RIDE
========================= */

function editRide(rideId) {

    window.location.href =
        "edit-ride.html?id=" + rideId;

}


/* =========================
   CLOSE MODAL ON OUTSIDE CLICK
========================= */

document.addEventListener("click", function (event) {

    const modal =
        document.getElementById("rideModal");

    if (
        event.target === modal
    ) {

        closeRideModal();

    }

});

