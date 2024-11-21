<?php 
include 
'backend/profile.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <link rel="stylesheet" href="css/profilepage.css"> <!-- View profile page styles -->
    <style>
        /* Dropdown styling */
        .dropdown {
            position: relative;
            display: inline-block;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%; /* Position below the menu */
            right: 0; /* Align to the right */
            background-color: black;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
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
                    <a href="profileview.html">My Profile</a>
                    <a href="roompage.php">My Room</a>
                    <a href="addpropertypage.html">Add Property</a>
                    <a href="backend/logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Profile Container -->
    <div class="profile-container">
    <div class="profile-header">
        <img class="profile-picture" src="http://localhost/Reserve/backend/display_userimage.php" alt="Profile Picture">
        <h2 class="profile-name"><?= $user['First_Name'] . " " . $user['Last_Name'] ?></h2>
    </div>
    <div class="profile-details">
        <p><strong>Email: </strong><?= $user['Email'] ?></p>
        <p><strong>Phone: </strong><?= $user['Phone_Number'] ?></p>
        <p><strong>Date of Birth: </strong><?= $user['Date_of_Birth'] ?></p>
    </div>
    <a href="profileditpage.php" class="edit-button">Edit Profile</a>
    </div>

    <!-- Content Container -->
    <div class="container">
        <?php while ($property = $propresult->fetch_assoc()): ?>
            <a href="rentpage.php?property_id=<?= $property['Property_ID']; ?>" class="content-box">
                <div class="box">
                    <img src="http://localhost/Reserve/backend/display_image.php?property_id=<?= $property['Property_ID']; ?>" alt="<?= $property['Property_Name']; ?>" class="box-image">
                    <h3><?= $property['Property_Name']; ?></h3>
                    <p>Address: <?= $property['Address']; ?></p>
                    <p>Monthly Rent: $<?= $property['Monthly_Rent']; ?></p>
                </div>
            </a>
        <?php endwhile; ?>
    </div>
</body>

    
</body>
</html>