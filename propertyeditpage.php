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

            <!-- Current Images -->
            <div class="current-images">
                <h3>Current Images</h3>
                <div class="image-gallery">
                    <!-- Dynamically added images will appear here -->
                </div>
            </div>

            <!-- Add New Image -->
            <div class="new-image-upload">
                <h3>Upload New Images</h3>
                <div class="upload-container">
                    <label for="property-image-upload" class="upload-button">Select New Image</label>
                    <input type="file" id="property-image-upload" name="property_images[]" accept="image/*" multiple>
                </div>
            </div>
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
                <label for="property-unitnumber">Unit_Number:</label>
                <input type="text" id="property-unitnumber" name="property_unitnumber" value="<?= $property['Unit_Number']; ?>" required>

                <label for="property-area">Area:</label>
                <input type="text" id="property-area" name="property_area" value="<?= $property['Area']; ?>" required>

                <label for="property-type">Type:</label>
                <input type="text" id="property-type" name="property_type" value="<?= $property['Property_Type']; ?>" required>

                <div class="form-actions">
                    <button type="submit" class="save-button">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Simulating dynamic data for current images
        const currentImages = [
            'https://via.placeholder.com/100?text=Image1',
            'https://via.placeholder.com/100?text=Image2',
            'https://via.placeholder.com/100?text=Image3'
        ];

        // Select the gallery container
        const imageGallery = document.querySelector('.image-gallery');

        // Function to display current images
        function displayCurrentImages(images) {
            imageGallery.innerHTML = ''; // Clear existing content
            images.forEach(src => {
                const img = document.createElement('img');
                img.src = src;
                img.alt = 'Property Image';
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.margin = '5px';
                img.style.objectFit = 'cover';
                imageGallery.appendChild(img);
            });
        }

        // Initialize with current images
        displayCurrentImages(currentImages);
    </script>
</body>
</html>
