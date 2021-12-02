<?php

session_start();

if (isset($_SESSION["username"])) {

require_once("Include/DB.php");

$SearchQuery = $_GET["id"]; // shows the existing data in the table

if (isset($_POST["Submit"])) {
        $Name = $_POST["name"];
        $Breed = $_POST["breed"];
        $Age = $_POST["age"];
        $Weight = $_POST["weight"];

        $data = "Breed: " .  $Breed . "\n" . "Age: " . $Age . " yr(s)" . "\n" . "Weight: " . $Weight . " lbs.";

        global $ConnectingDB;
        $sql = "UPDATE animal_record SET name='$Name', data='$data' WHERE id='$SearchQuery'";
        $Execute = $ConnectingDB->query($sql);
        if ($Execute) {
            // sends the user back to the table 
            // _self is so it won't open in a new window
            echo '<script>window.open("View_From_Database.php?id=Record Updated Successfully","_self")</script>';
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data into Database</title>
    <link rel="stylesheet" href="Include/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <div class="navbar">
        <a href="index.php"><i class="fa fa-fw fa-home"></i> Home</a> 
        <a href="Insert_into_Database.php"><i class="fa fa-fw fa-plus"></i> Insert</a>
        <a href="View_From_Database.php"><i class="fa fa-fw fa-search"></i> View Table</a>
        <!-- <a href="#"><i class="fa fa-fw fa-search"></i> Search</a> -->
        <!-- <a href="#"><i class="fa fa-fw fa-envelope"></i> Contact</a>  -->
        <a href="logout.php"><i class="fa fa-fw fa-user"></i> Logout</a>
    </div>

    <?php
    global $ConnectingDB;
    $sql = "SELECT * FROM animal_record WHERE id='$SearchQuery'";  // gets the info from the table using id so we can edit/update
    $stmt = $ConnectingDB->query($sql);
    while ($DataRows = $stmt->fetch()) {
        $Id             = $DataRows["id"];
        $Name           = $DataRows["name"];
        $Data           = $DataRows["data"];
        $Time           = $DataRows["time"];
    }
    ?>

    <div class="">
        <form class="" action="Update.php?id=<?php echo $SearchQuery; ?>" method="POST">
            <fieldset>
                <span class="FieldInfo">Name:</span>
                <br>
                <input type="text" name="name" value="">
                <br>
                <span class="FieldInfo">Breed:</span>
                <br>
                <input type="text" name="breed" value="">
                <br>
                <span class="FieldInfo">Age:</span>
                <br>
                <input type="text" name="age" value="">
                <br>
                <span class="FieldInfo">Weight (lbs):</span>
                <br>
                <input type="text" name="weight" value="">
                <br>
                <input type="submit" name="Submit" value="Submit your record">
            </fieldset>
        </form>
    </div>
</body>
</html>

<?php } else {
    header("Location: index.php");
} ?>