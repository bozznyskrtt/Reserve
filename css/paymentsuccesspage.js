document.addEventListener("DOMContentLoaded", () => {
    const checkmark = document.querySelector(".checkmark");
    // Adding slight delay for better animation appearance
    setTimeout(() => {
        checkmark.style.opacity = "1";
    }, 500);
});

// Function to redirect after 10 seconds
function redirectToPage() {
    setTimeout(function() {
        window.location.href = "http://localhost/Reserve/roompage.php"; // Change this to your desired URL
    }, 10000); // 10,000 milliseconds = 10 seconds
}
