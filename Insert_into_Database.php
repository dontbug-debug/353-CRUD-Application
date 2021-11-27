<?php
require_once("Include/DB.php");


if (isset($_POST["Submit"])) {
    if (!empty($_POST["name"]) && !empty($_POST["breed"])) {
        $Name = $_POST["name"];
        $Breed = $_POST["breed"];
        $Age = $_POST["age"];
        $Weight = $_POST["weight"];

        $data = "Breed: " .  $Breed . "\n" . "Age: " . $Age . " yr(s)" . "\n" . "Weight: " . $Weight . " lbs.";
        // have to add report!!

        global $ConnectingDB;
        $sql = "INSERT INTO animal_record(name, data, report) VALUES(:namE, :datA, '')";
                $stmt = $ConnectingDB->prepare($sql);
                $stmt->bindValue(':namE', $Name);
                $stmt->bindValue(':datA', $data);

        $Execute = $stmt->execute();
        if ($Execute) {
            echo '<span class="success">Record Has Added Successfully</span>';
        }
    } else {
        echo "<span class='FieldInfoHeading'> Please add Name and And other fields</span>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data into Database</title>
    <link rel="stylesheet" href="Include/style.css">
</head>
<body>
    <!-- center the whole form using CSS -->
    <?php ?>
    <div class="">
        <form class="" action="Insert_into_Database.php" method="POST">
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
                <input type="submit" name="Submit" value="Submit">
            </fieldset>
        </form>
    </div>
</body>
</html>