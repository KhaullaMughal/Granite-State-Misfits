document.addEventListener("DOMContentLoaded", function () {

   

    const sidebar = document.getElementById("sidebar");
    const menuLinks = document.querySelectorAll(".menu a");

    /*
        Get current page name.

        Example:
        dashboard.html
        rides.html
        raffle.html
    */

    let currentPage = window.location.pathname
        .split("/")
        .pop()
        .toLowerCase();


    /*
        If page name is empty,
        consider it dashboard.
    */

    if (currentPage === "") {
        currentPage = "dashboard.html";
    }


    /*
        Automatically highlight
        current sidebar page.
    */

    menuLinks.forEach(function (link) {

        const linkPage = link
            .getAttribute("href")
            .split("/")
            .pop()
            .toLowerCase();

        if (linkPage === currentPage) {
            link.classList.add("active");
        }

    });


    /*
        Close mobile sidebar
        after navigation.
    */

    menuLinks.forEach(function (link) {

        link.addEventListener("click", function () {

            if (window.innerWidth <= 750) {
                sidebar.classList.remove("show");
            }

        });

    });

});


/* =========================
   MOBILE SIDEBAR
========================= */

function toggleSidebar() {

    const sidebar = document.getElementById("sidebar");

    sidebar.classList.toggle("show");

}


/* =========================
   CLOSE SIDEBAR OUTSIDE
========================= */

document.addEventListener("click", function (event) {

    const sidebar = document.getElementById("sidebar");
    const menuButton = document.querySelector(".menu-toggle");

    if (!sidebar || !menuButton) {
        return;
    }

    if (
        window.innerWidth <= 750 &&
        sidebar.classList.contains("show") &&
        !sidebar.contains(event.target) &&
        !menuButton.contains(event.target)
    ) {

        sidebar.classList.remove("show");

    }

});


/* =========================
   RIDE FUNCTIONS
========================= */

function addRide() {

    window.location.href = "add-ride.html";

}


function editRide(id) {

    window.location.href = "edit-ride.html?id=" + id;

}


function deleteRide(button) {

    const confirmation = confirm(
        "Are you sure you want to delete this ride?"
    );

    if (confirmation) {

        const row = button.closest("tr");

        if (row) {
            row.remove();
        }

        alert("Ride deleted successfully.");

    }

}


/* =========================
   RAFFLE
========================= */

function manageRaffle() {

    window.location.href = "raffle.html";

}


/* =========================
   LOGOUT
========================= */

function confirmLogout() {

    return confirm(
        "Are you sure you want to logout?"
    );

}
```
