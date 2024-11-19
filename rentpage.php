<?php include 'backend/rent.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Details</title>
    <link rel="stylesheet" href="css/rent.css">
</head>
<body>
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
            <li><a href="#">Sign up/Join</a></li>
        </ul>
    </nav>
    <div class="container">
        <!-- Image Carousel Section -->
        <div class="image-carousel">
            <img id="property-image"  alt="<?= $property['Property_Name']; ?>">
            <div class="carousel-controls">
                <button id="prev-btn">&lt;</button>
                <span id="image-counter">1/<?= htmlspecialchars($count_image);?></span>
                <button id="next-btn">&gt;</button>
            </div>
        </div>
        
        <!-- Property Details Section -->
        <div class="property-details">
            <h2><?= htmlspecialchars($property['Property_Name']); ?></h2>
            <p><strong>Address:</strong> <?= htmlspecialchars($property['Address']); ?></p>
            <p><strong>Unit No:</strong> <?= htmlspecialchars($property['Unit_Number']); ?></p>
            <p><strong>Area:</strong> <?= htmlspecialchars($property['Area']); ?> sq.m.</p>
            <p><strong>Type:</strong><?= htmlspecialchars($property['Property_Type']); ?></p>
            <p><strong>Bedroom:</strong><?= htmlspecialchars($property['Number_of_Bedroom']); ?></p>
            <p><strong>Bathroom:</strong><?= htmlspecialchars($property['Number_of_Bathrooms']); ?></p>
            <p><strong>Price:</strong><?= htmlspecialchars($property['Monthly_Rent']);?> THB/MONTH</p>
            <p><strong>ID:</strong><?= htmlspecialchars($property['Property_ID']);?> </p>
            <button class="rent-btn">Rent</button>
        </div>
    </div>

    <input type="hidden" id="count" value="<?php echo $count_image; ?>">
    
    <script src="css/rent.js"></script>
</body>
</html>