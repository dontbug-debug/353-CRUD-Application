<?php

session_start();

if (isset($_SESSION["username"])) {

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- center the whole form using CSS -->
    <?php ?>
    
    <div class="navbar">
        <a href="index.php"><i class="fa fa-fw fa-home"></i> Home</a> 
        <a class="active" href="Insert_into_Database.php"><i class="fa fa-fw fa-plus"></i> Insert</a>
        <a href="View_From_Database.php"><i class="fa fa-fw fa-search"></i> View Table</a>
        <a href="logout.php"><i class="fa fa-fw fa-user"></i> Logout</a>
    </div>

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

<?php } else {
    header("Location: index.php");
} ?>