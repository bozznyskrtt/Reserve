<?php include 'backend/room.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments</title>
    <link rel="stylesheet" href="css/payment.css"> <!-- Link to the CSS file -->
    <script src="css/payment.js"></script> <!-- Link to the JavaScript file -->
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
                    <a href="#">My Profile</a>
                    <a href="roompage.php">My Room</a>
                    <a href="addpropertypage.html">Add Property</a>
                    <a href="backend/logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div class="container">
        <!-- Payments Section -->
        <div class="payment-summary">
            <h2>Payments</h2>
            <hr class="separator">
            <div class="expense-item">
                <p>Rental</p>
                <span class="amount"><?= $payment ?></span>
                <div class="total-amount">
                    <p>Total Amount</p>
                    <span><?= $payment ?> THB</span>
                </div>
            </div>
        </div>

        <!-- Payment Form Section -->
        <div class="payment-form">
            <h3>Payment Type</h3>
            <div class="tab-container">
                <button class="tab active" value="credit" onclick="showCredit()" name="credit">Credit</button>
                <button class="tab"  value="qr" onclick="showQR()" name="qr">QR Payment</button>
            </div>
            <div id="credit-fields" class="form-fields">
                <input type="text" placeholder="Card no.">
                <input type="text" placeholder="Name">
                <div class="expiry-cvc">
                    <input type="text" placeholder="Expire">
                    <input type="text" placeholder="CVC">
                </div>
                <form action="backend/payment.php" method="POST">
                    <!-- Hidden field to store the selected type -->
                    <input type="hidden" name="selectedType" id="selectedType">
                    <button class="continue-btn" name="continue">Continue</button>
                </form>
               
            </div>
            <div id="qr-image" class="form-fields" style="display: none;">
                <img src="QR.JPG" alt="QR Code" style="width: 60%; height: auto; border-radius: 5px; display: block; margin: 0 auto;">
            </div>
        </div>
    </div> 
    
 </body>
</html>