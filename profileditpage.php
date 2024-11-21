<?php include 'backend/profile.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/profileditpage.css"> <!-- New profile page styles -->
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
                    <a href="profilepage.php">My Profile</a>
                    <a href="roompage.php">My Room</a>
                    <a href="addpropertypage.html">Add Property</a>
                    <a href="backend/logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Profile Page Content -->
    <div class="profile-container">
        <h1>My Profile</h1>
        <form id="profile-form" action="backend/profile_edit.php" method="POST" enctype="multipart/form-data">
            <!-- Profile Picture -->
            <div class="profile-picture">
                <img id="profile-img" src="http://localhost/Reserve/backend/display_userimage.php" alt="Profile Picture">
                <input type="file" id="profile-pic-upload" name="image" accept="image/*">
                <label for="profile-pic-upload" class="upload-button">Change Picture</label>
            </div>
            <!-- Basic Information -->
            <div class="form-section">
                <label for="f_name">First Name:</label>
                <input type="text" id="first-name" name="f_name" value="<?= $user['First_Name'] ?>" required>
                
                <label for="l_name">Last Name:</label>
                <input type="text" id="last-name" name="l_name" value="<?= $user['Last_Name'] ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= $user['Email'] ?>" required>

                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" value="<?= $user['Phone_Number'] ?>" required>

                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" value="<?= $user['Date_of_Birth'] ?>" required>

                <!-- <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="male" selected>Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select> -->
            </div>

            <!-- Save Button -->
            <div class="form-actions">
                <button type="submit" class="save-button" name="submit" >Save Changes</button>
            </div>
        </form>
    </div>
</body>
</html>