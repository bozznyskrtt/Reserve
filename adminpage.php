<?php include 'backend/admin.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/adminpage.css">
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
        <a href="http://localhost/Reserve/mainpage.php" style="text-decoration: none; color: white;"><div class="logo" href>RESERVED Real Estate ADMIN</div></a>
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

    <!-- Dashboard Layout -->
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Dashboard</h2>
            <button id="users-btn" class="sidebar-btn">Users</button>
            <button id="properties-btn" class="sidebar-btn">Properties</button>
        </aside>

        <!-- Main Content -->
        <main class="content">
            <div id="users-table" class="table-container">
                <h2>Users</h2>
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th> <!-- New column for actions -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($user = $userresult->fetch_assoc()): ?>
                            <tr>
                                <td><?= $user['User_ID'] ?></td>
                                <td><?= $user['First_Name'] ?></td>
                                <td><?= $user['Last_Name'] ?></td>
                                <td><?= $user['Email'] ?></td>
                                <td><?= $user['Phone_Number'] ?></td>
                                <td>
                                    <button class="action-btn edit-btn">Edit</button>
                                    <button class="action-btn delete-btn">Delete</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            
            <div id="properties-table" class="table-container hidden">
                <h2>Properties</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Property ID</th>
                            <th>Owner ID</th>
                            <th>Property Name</th>
                            <th>Address</th>
                            <th>Unit Number</th>
                            <th>Area</th>
                            <th>Property Type</th>
                            <th>Bedroom</th>
                            <th>Bathroom</th>
                            <th>Monthly Rent</th>
                            <th>Staus</th>
                            <th>Actions</th> <!-- New column for actions -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($property = $propertyresult->fetch_assoc()): ?>
                        <tr>
                            <td><?= $property['Property_ID'] ?></td>
                            <td><?= $property['User_ID'] ?></td>
                            <td><?= $property['Property_Name'] ?></td>
                            <td><?= $property['Address'] ?></td>
                            <td><?= $property['Unit_Number'] ?></td>
                            <td><?= $property['Area'] ?></td>
                            <td><?= $property['Property_Type'] ?></td>
                            <td><?= $property['Number_of_Bedroom'] ?></td>
                            <td><?= $property['Number_of_Bathrooms'] ?></td>
                            <td><?= $property['Monthly_Rent'] ?></td>
                            <td><?= $property['Status'] ?></td>
                            <td>
                                <button class="action-btn edit-btn">Edit</button>
                                <button class="action-btn delete-btn">Delete</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="css/admin.js"></script>
</body>
</html>