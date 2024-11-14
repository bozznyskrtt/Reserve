<?php
include 'db_connect.php';

$sql = "SELECT Properties.Property_ID, Properties.Property_Name, Properties.Address, 
               Properties.Monthly_Rent, Property_Image.Inamge_data
        FROM Properties
        LEFT JOIN Property_Image ON Properties.Property_ID = Property_Image.Property_ID
        WHERE Property_Image.Image_ID = (
            SELECT MIN(Image_ID) 
            FROM Property_Image 
            WHERE Property_Image.Property_ID = Properties.Property_ID
        )
        ";

if($result = $conn->query($sql)){

} 
else {

}
