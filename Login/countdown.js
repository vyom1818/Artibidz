// Function to update the countdown timer
function updateCountdown() {
    var currentTime = Math.floor(Date.now() / 1000); // Current time in seconds
    var otpStartTime = parseInt($("#otp_start_time").val()); // OTP start time
    var otpExpiration = otpStartTime + 180; // OTP expiration time

    // Calculate remaining time in seconds
    var remainingTime = otpExpiration - currentTime;

    if (remainingTime > 0) {
        // Convert remaining time to minutes and seconds
        var minutes = Math.floor(remainingTime / 60);
        var seconds = remainingTime % 60;

        // Display the countdown
        $("#countdown").text("Time remaining: " + minutes + " minutes " + seconds + " seconds");
    } else {
        // Display a message when the countdown reaches zero
        $("#countdown").text("Time expired.");
    }
}

// Update countdown every second
setInterval(updateCountdown, 1000);

// Initial update on page load
$(document).ready(function () {
    updateCountdown();
});
