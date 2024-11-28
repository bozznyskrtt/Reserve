<?php include 'backend/admin.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/adminpage.css">
    <link rel="stylesheet" href="css/navbar.css">
</head>
<body>
    <nav class="navbar">
        <a href="adminpage.php" style="text-decoration: none; color: white;">
            <div class="logo">RESERVED Real Estate ADMIN</div>
        </a>
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
                                <td data-column="User_ID" data-editable="true"><?= $user['User_ID'] ?></td>
                                <td data-column="First_Name" data-editable="true"><?= $user['First_Name'] ?></td>
                                <td data-column="Last_Name" data-editable="true"><?= $user['Last_Name'] ?></td>
                                <td data-column="Email" data-editable="true"><?= $user['Email'] ?></td>
                                <td data-column="Phone_Number" data-editable="true"><?= $user['Phone_Number'] ?></td>
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
                                <td data-column="Property_ID" data-editable="true" ><?= $property['Property_ID'] ?></td>
                                <td data-column="User_ID" data-editable="true"><?= $property['User_ID'] ?></td>
                                <td data-column="Property_Name" data-editable="true"><?= $property['Property_Name'] ?></td>
                                <td data-column="Address" data-editable="true"><?= $property['Address'] ?></td>
                                <td data-column="Unit_Number" data-editable="true"><?= $property['Unit_Number'] ?></td>
                                <td data-column="Area" data-editable="true"><?= $property['Area'] ?></td>
                                <td data-column="Property_Type" data-editable="true"><?= $property['Property_Type'] ?></td>
                                <td data-column="Number_of_Bedroom" data-editable="true"><?= $property['Number_of_Bedroom'] ?></td>
                                <td data-column="Number_of_Bathrooms" data-editable="true"><?= $property['Number_of_Bathrooms'] ?></td>
                                <td data-column="Monthly_Rent" data-editable="true"><?= $property['Monthly_Rent'] ?></td>
                                <td data-column="Status" data-editable="true"><?= $property['Status'] ?></td>
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