<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/roompage.css"> <!-- Link to the CSS file -->
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
    <!-- Navigation Bar -->
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
                    <a href="backend/logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Banner Section with Text Overlay -->
    <div class="banner">
        <div class="banner-text">
            <h1><?php echo "Welcome ".$_SESSION['username'] ?></h1>
            <hr class="separator">
            <p>My home</p>
        </div>
    </div>

<!-- Content Section Split into Left and Right -->
<div class="content">
    <!-- Left Section -->
   
    <div class="left-section">
        <h1>Expenses</h1>
        <hr class="separator">
        <div class="expense-item">
            <p>Water</p>
            <span class="amount">250$</span>
        </div>
        <div class="expense-item">
            <p>Electricity</p>
             <span class="amount">3,000$</span>
        </div>
        <hr class="separator">
        <div class="expense-item">
            <p>Total</p>
            <span class="amount">3,250$</span>
        </div>
        <a href="paymentpage.html">
        <button name="pay" class="btn">Pay now</button>
        </a>
    </div>
    </form>    
    <!-- Right Section with Big Wrapper Enclosing the Two Small Wrappers -->
    <div class="right-section">
        <div class="big-wrapper"> <!-- New big wrapper div -->
                <div class="wrapper-container">
                    <div class="wrapper-item">Heart Break</div>
                    <div class="wrapper-item">Invitation to drink</div>
                </div>
        </div>
    </div>

</div>
</body>
</html>