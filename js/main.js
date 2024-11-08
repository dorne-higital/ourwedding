// Set the countdown date (YYYY-MM-DD HH:MM:SS)
var countdownDate = new Date("2024-12-20T00:00:01").getTime();

// Update the countdown every 1 second
var countdownTimer = setInterval(function () {
    // Get the current date and time
    var now = new Date().getTime();

    // Calculate the time remaining
    var timeRemaining = countdownDate - now;

    // Calculate years, months, days, and hours
    var years = Math.floor(timeRemaining / (1000 * 60 * 60 * 24 * 365));
    var months = Math.floor(
        (timeRemaining % (1000 * 60 * 60 * 24 * 365)) /
            (1000 * 60 * 60 * 24 * 30)
    );
    var days = Math.floor(
        (timeRemaining % (1000 * 60 * 60 * 24 * 30)) / (1000 * 60 * 60 * 24)
    );
    var hours = Math.floor(
        (timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
    );

    // Display the countdown in the #countdown element
    document.getElementById("years").innerHTML = years;
    document.getElementById("months").innerHTML = months;
    document.getElementById("days").innerHTML = days;
    document.getElementById("hours").innerHTML = hours;

    // If the countdown is over, display a message
    if (timeRemaining < 0) {
        clearInterval(countdownTimer);
        document.getElementById("countdown").style.display = "none";
        document.getElementById("end-text").innerHTML = "The Big Day";
    }
}, 1000);

var close = document.getElementsByClassName("closebtn");
var i;

// Loop through all close buttons
for (i = 0; i < close.length; i++) {
    // When someone clicks on a close button
    close[i].onclick = function () {
        // Get the parent of <span class="closebtn"> (<div class="alert">)
        var div = this.parentElement;

        // Set the opacity of div to 0 (transparent)
        div.style.opacity = "0";

        // Hide the div after 600ms (the same amount of milliseconds it takes to fade out)
        setTimeout(function () {
            div.style.display = "none";
        }, 600);
    };
}

const alertClose = setTimeout(closeAlert, 5000);

function closeAlert() {
    document.getElementById("close_alert").style.display = "none";
}

function toggleNavMenu() {
    var x = document.getElementById("nav_menu");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}
