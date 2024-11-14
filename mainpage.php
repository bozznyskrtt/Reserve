<?php 
session_start();

// Connect to the database
include 'backend/db_connect.php';

// Fetch up to 8 properties, each with only one associated image
$sql = "SELECT Properties.Property_ID, Properties.Property_Name, Properties.Address, 
               Properties.Monthly_Rent, Property_Image.Image_data
        FROM Properties
        LEFT JOIN Property_Image ON Properties.Property_ID = Property_Image.Property_ID
        WHERE Property_Image.Image_ID = (
            SELECT MIN(Image_ID) 
            FROM Property_Image 
            WHERE Property_Image.Property_ID = Properties.Property_ID
        )
        ";
  
$result = $conn->query($sql);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="css/mainpage.css">
</head>
<body>
    <h1><?php echo $_SESSION['userid'] ?></h1>
    <h1><?php echo $_SESSION['username'] ?></h1>
    <form action="addpropertypage.html" method="POST">
        <h2>ADD PROPERTY</h2>
        <button type="submit" name="addproperty">ADD PROPERTY</button>
    </form>
    <form action="roompage.php" method="POST">
        <h2>Sign Up</h2>
        <button type="submit" name="roompage">ROOM PAGE</button>
    </form>
    <div class="container">
  <?php while($row = $result->fetch_assoc()): ?>
    <a href="property_details.php?id=<?= $row['Property_ID']; ?>" class="content-box">
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