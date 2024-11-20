<?php 
session_start();
include 'backend/main.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="css/mainpage.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Add</title>
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
<nav class="navbar">
        <a href="http://localhost/Reserve/mainpage.php" style="text-decoration: none; color: white;"><div class="logo" href>RESERVED Real Estate</div></a>
        <ul class="nav-links">
            <li><a href="#">Rent</a></li>
            <li><a href="#">Buy</a></li>
            <li><a href="#">Sell</a></li>
            <li><a href="#">New Homes</a></li>
            <li><a href="#">News</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Contact us</a></li>
            <!-- <li><a href="#">Sign up/Join</a></li> -->
            <!-- Dropdown Menu in the Navbar -->
            <li class="dropdown">
                <a href="#" class="dropbtn">Profile</a>
                <div class="dropdown-content">
                    <a href="#">My Profile</a>
                    <a href="roompage.php">My Room</a>
                    <a href="addpropertypage.html">Add Property</a>
                    <a href="backend/logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>

    <div class="banner">
        <div class="banner-text">
            <h1><?php echo "Welcome ".$_SESSION['username'] ?></h1>
            <hr class="separator">
            <p>My home</p>
        </div>
    </div>
  
    <div class="container">
      <?php while($row = $result->fetch_assoc()): ?>
        <a href="rentpage.php?property_id=<?= $row['Property_ID']; ?>" class="content-box">
          <div class="box">
            <img src="http://localhost/Reserve/backend/display_image.php?property_id=<?= $row['Property_ID']; ?>" alt="<?= $row['Property_Name']; ?>" class="box-image">
            <h3><?= $row['Property_Name']; ?></h3>
            <p>Address: <?= $row['Address']; ?></p>
            <p>Monthly Rent: $<?= $row['Monthly_Rent']; ?></p>
          </div>
        </a>
      <?php endwhile; ?>
</div>

</body>
</html>