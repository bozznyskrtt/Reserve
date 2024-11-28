<?php
// Include your database connection and start the session
session_start();
include 'backend/db_connect.php';

// Get the property ID from the URL (or session) to retrieve specific property data
$property_id = $_GET['property_id']; // Assuming you are passing property ID in the URL

// Query to fetch the existing property data from the database
$sql = "SELECT * FROM Properties WHERE Property_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $property_id);
$stmt->execute();
$result = $stmt->get_result();
$property = $result->fetch_assoc();

// Close the database connection
$stmt->close();
?>
<!-- 


    <script>
        // Optional JavaScript for live preview of uploaded image
        const propertyImageUpload = document.getElementById('property-image-upload');
        const propertyImg = document.getElementById('property-img');

        propertyImageUpload.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    propertyImg.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html> -->
