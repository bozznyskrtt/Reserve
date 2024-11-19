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