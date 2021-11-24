<?php
require_once("Include/DB.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View from Database</title>
    <link rel="stylesheet" href="Include/style.css">
</head>

<body>
    <h2 class="success">
        <!-- @ - won't show error when there is no id -->
        <?php echo @$_GET["id"]; ?>
    </h2>

    <div class="">
        <fieldset>
            <form class="" action="View_From_Database.php" method="GET">
                <input type="text" name="search" value="" placeholder="Search by name or breed">
                <input type="submit" name="searchBtn" value="Search record">
            </form>
        </fieldset>
    </div>
    <?php
    if (isset($_GET["searchBtn"])) {
        global $ConnectingDB;
        $Search = $_GET["search"];
        $sql = "SELECT * FROM animal_record WHERE name=:searcH OR breed=:searcH";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':searcH', $Search);
        $stmt->execute();
        while ($DataRows = $stmt->fetch()) {
            $Id             = $DataRows["id"];
            $Name           = $DataRows["name"];
            $Data           = $DataRows["data"];
            $Time           = $DataRows["time"];
    ?>
            <div>
                <table width="1000" border="5" align="center">
                    <caption>Search Result</caption>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Data</th>
                        <th>Report</th>
                        <th>Time</th>
                        <th>Search Again</th>
                    </tr>
                    <tr>
                        <td><?php echo $Id; ?></td>
                        <td><?php echo $Name; ?></td>
                        <td><?php echo $Data; ?></td>
                        <td> </td>
                        <td><?php echo $Time; ?></td>
                        <td> <a href="View_From_Database.php">Search Again</a> </td>
                    </tr>
                </table>
            </div>

    <?php }
    }
    ?>

    <table width="1000" border="5" align="center">
        <caption>View from Database</caption>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Data</th>
            <th>Report</th>
            <th>Time</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>

        <?php
        global $ConnectingDB;
        $sql = "SELECT * From animal_record";
        $stmt = $ConnectingDB->query($sql);
        while ($DataRows = $stmt->fetch()) {
            $Id             = $DataRows["id"];
            $Name           = $DataRows["name"];
            $Data           = $DataRows["data"];
            $Time           = $DataRows["time"];
        ?>
            <tr>
                <td><?php echo $Id; ?></td>
                <td><?php echo $Name; ?></td>
                <td><?php echo $Data; ?></td>
                <td> </td>
                <td><?php echo $Time; ?></td>
                <td> <a href="Update.php?id=<?php echo $Id; ?>">Update</a> </td>
                <td> <a href="Delete.php?id=<?php echo $Id; ?>">Delete</a> </td>
            </tr>
        <?php } ?>
    </table>

</body>
</html>