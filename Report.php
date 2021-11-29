<?php
session_start();

if (isset($_SESSION["username"])) {

require_once("Include/DB.php");

$SearchQuery = $_GET["id"]; // shows the existing data in the table

if (isset($_POST["Submit"])) {
    $reportText = $_POST["textarea"];

    global $ConnectingDB;
    $sql = "UPDATE animal_record SET report='$reportText' WHERE id='$SearchQuery'";
    $Execute = $ConnectingDB->query($sql);
    if ($Execute) {
        // sends the user back to the table 
        // _self is so it won't open in a new window
        echo `<script>window.open("Report.php?id=<?php $SearchQuery ?>","_self")</script>`;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    <h2>Report</h2>
    <?php
    global $ConnectingDB;
    $sql = "SELECT * FROM animal_record WHERE id=:iD";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':iD', $SearchQuery);
    $stmt->execute();
    while ($DataRows = $stmt->fetch()) {
        $Report = $DataRows["report"];
    ?>
        <p><?php echo $Report; ?></p>
    <?php } ?>

    <div class="">
        <form class="" action="Report.php?id=<?php echo $SearchQuery ?>" method="POST">
            <fieldset>
                <span class="FieldInfo">Report:</span>
                <br>
                <textarea name="textarea" cols="30" rows="10"></textarea>
                <br>
                <input type="submit" name="Submit" value="Update record">
            </fieldset>
        </form>
    </div>
</body>

</html>

<?php } else {
    header("Location: index.php");
} ?>