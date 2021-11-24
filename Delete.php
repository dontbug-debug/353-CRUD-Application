<?php
require_once("Include/DB.php");

$SearchQuery = $_GET["id"]; // shows the existing data in the table

if (isset($_POST["Submit"])) {
        $Name = $_POST["name"];
        $Breed = $_POST["breed"];
        $Age = $_POST["age"];
        $Weight = $_POST["weight"];

        global $ConnectingDB;
        $sql = "DELETE FROM animal_record WHERE id='$SearchQuery'";
        $Execute = $ConnectingDB->query($sql);
        if ($Execute) {
            // sends the user back to the table 
            // _self is so it won't open in a new window
            echo '<script>window.open("View_From_Database.php?id=Record Deleted Successfully","_self")</script>';
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Data in Database</title>
    <link rel="stylesheet" href="Include/style.css">
</head>
<body>
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
        <form class="" action="Delete.php?id=<?php echo $SearchQuery; ?>" method="POST">
            <fieldset>
                <span class="FieldInfo">Name:</span>
                <br>
                <input type="text" name="name" value="<?php echo $Name ?>">
                <br>
                <span class="FieldInfo">Breed:</span>
                <br>
                <input type="text" name="breed" value="<?php echo $Breed ?>">
                <br>
                <span class="FieldInfo">Age:</span>
                <br>
                <input type="text" name="age" value="<?php echo $Age ?>">
                <br>
                <span class="FieldInfo">Weight (lbs):</span>
                <br>
                <input type="text" name="weight" value="<?php echo $Weight ?>">
                <br>
                <input type="submit" name="Submit" value="Delete record">
            </fieldset>
        </form>
    </div>
</body>
</html>
