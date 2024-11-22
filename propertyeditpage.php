<?php include 'backend/property_edit.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Property</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/propertyeditpage.css"> <!-- Link to your CSS -->
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">RESERVED Real Estate</div>
        <ul class="nav-links">
            <li><a href="#">Rent</a></li>
            <li><a href="#">Buy</a></li>
            <li><a href="#">Sell</a></li>
            <li><a href="#">New Homes</a></li>
            <li><a href="#">News</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Contact us</a></li>
            <li class="dropdown">
                <a href="#" class="dropbtn">Profile</a>
                <div class="dropdown-content">
                    <a href="profilepage.php">My Profile</a>
                    <a href="roompage.php">My Room</a>
                    <a href="addpropertypage.html">Add Property</a>
                    <a href="backend/logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Property Edit Section -->
    <div class="property-edit-container">
        <!-- Left Side: Images -->
        <div class="property-images">
            <h2>Property Pictures</h2>
            <div class="image-preview">
                <img id="property-img" src="http://localhost/Reserve/backend/display_property_image.php?property_id=<?= $property['Property_ID']; ?>" alt="Property Image">
            </div>
            <label for="property-image-upload" class="upload-button">Upload New Image</label>
            <input type="file" id="property-image-upload" name="image" accept="image/*">
        </div>

        <!-- Right Side: Details -->
        <div class="property-details">
            <h2>Edit Property Details</h2>
            <form action="backend/save_property_edit.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="property_id" value="<?= $property['Property_ID']; ?>">

                <label for="property-title">Title:</label>
                <input type="text" id="property-title" name="property_title" value="<?= $property['Property_Name']; ?>" required>s

                <label for="property-price">Price (USD):</label>
                <input type="number" id="property-price" name="property_price" value="<?= $property['Monthly_Rent']; ?>" required>

                <label for="property-location">Location:</label>
                <input type="text" id="property-location" name="property_location" value="<?= $property['Address']; ?>" required>

                <div class="form-actions">
                    <button type="submit" class="save-button">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

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
</html>
