<?php include 'backend/profile.php'; ?>
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
                    <a href="backend/logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Profile Page Content -->
    <div class="profile-container">
        <div class="profile-header">
            <img class="profile-picture" src="images/default-profile.png" alt="Profile Picture">
            <h1 class="profile-name"><?= $user['First_Name'] . "&nbsp;&nbsp;" . $user['Last_Name']  ?></h1>
        </div>
        <div class="profile-details">
            <p><strong>Email: </strong><?= $user['Email'] ?></p>
            <p><strong>Phone: </strong><?= $user['Phone_Number'] ?></p>
            <p><strong>Date of Birth: </strong><?= $user['Date_of_Birth'] ?></p>
            <!-- <p><strong>Gender: </strong> Male</p> -->
        </div>
        <form action="profileditpage.php" method="POST"">
            <button class="edit-button">Edit Profile</button>
        </form>
    </div>
</body>
</html>