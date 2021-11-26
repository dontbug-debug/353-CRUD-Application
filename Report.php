<?php
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
    <title>Document</title>
    <link rel="stylesheet" href="Include/style.css">
</head>

<body>
    <h1>Report</h1>
    <?php
    global $ConnectingDB;
    $sql = "SELECT * FROM animal_record WHERE id=:iD";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':iD', $SearchQuery);
    $stmt->execute();
    while ($DataRows = $stmt->fetch()) {
        $Report             = $DataRows["report"];
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