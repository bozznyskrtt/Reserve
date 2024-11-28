<?php include 'backend/property_edit.php'; include 'backend/image_count.php'; ?>
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
        <a href="mainpage.php" style="text-decoration: none; color: white;">
            <div class="logo">RESERVED Real Estate</div>
        </a>
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

    <div class="property-edit-container">
    <!-- Left Side: Images -->
    <div class="property-images">
        <h2>Property Pictures</h2>
        <div class="current-images">
            <h3>Current Images</h3>
            <div class="image-gallery"></div>
        </div>
        <div class="new-image-upload">
            <h3>Upload New Images</h3>
            <div class="upload-container">
            <form id="uploadForm" action="backend/upload_image.php?property_id=<?= $property['Property_ID']; ?>" method="POST" enctype="multipart/form-data">
                <input type="file" id="property-image-upload" name="property_images[]" accept="image/*" multiple>
                <label for="property-image-upload" class="upload-button">Select New Image</label>

                <button type="submit">Upload Images</button>
            </form>
            </div>
        </div>
    </div>

    <!-- Right Side: Details -->
    <div class="property-details">
        <h2>Edit Property Details</h2>
        <form action="backend/save_property_edit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="property_id" value="<?= $property['Property_ID']; ?>">

            <label for="property-title">Title:</label>
            <input type="text" id="property-title" name="property_title" value="<?= $property['Property_Name']; ?>" required>

            <label for="property-price">Price (USD):</label>
            <input type="number" id="property-price" name="property_price" value="<?= $property['Monthly_Rent']; ?>" required>

            <label for="property-location">Location:</label>
            <input type="text" id="property-location" name="property_location" value="<?= $property['Address']; ?>" required>

            <label for="property-unitnumber">Unit Number:</label>
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
    <input type="hidden" id="count" name="count" value="<?= $image_count ?>">

    <script>
        let Count = parseInt(document.getElementById('count').value, 10);
        const imageGallery = document.querySelector('.image-gallery');
        const params = new URLSearchParams(window.location.search);
        const propertyId = params.get('property_id');

        function getImageUrl(index) {
            return `http://localhost/Reserve/backend/get_image.php?property_id=${propertyId}&index=${index}`;
        }

        function deleteImage(index) {
            if (confirm('Are you sure you want to delete this image?')) {
                fetch(`http://localhost/Reserve/backend/delete_image.php?property_id=${propertyId}&index=${index}`, {
                    method: 'DELETE'
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Count -= 1;
                            displayCurrentImages(Count);
                        } else {
                            alert('Failed to delete the image.');
                        }
                    })
                    .catch(err => console.error(err));
            }
        }

        function displayCurrentImages(count) {
            imageGallery.innerHTML = '';
            for (let i = 0; i < Math.min(count, 9); i++) {
                const imageWrapper = document.createElement('div');
                imageWrapper.className = 'image-gallery-item';

                const img = document.createElement('img');
                img.src = getImageUrl(i);
                img.alt = `Property Image ${i + 1}`;

                const deleteBtn = document.createElement('button');
                deleteBtn.className = 'delete-button';
                deleteBtn.innerText = '×';
                deleteBtn.addEventListener('click', () => deleteImage(i));

                imageWrapper.appendChild(img);
                imageWrapper.appendChild(deleteBtn);
                imageGallery.appendChild(imageWrapper);
            }
        }

        if (Count > 0) {
            displayCurrentImages(Count);
        } else {
            console.error('No images to display.');
        }
    </script>
</body>
</html>
