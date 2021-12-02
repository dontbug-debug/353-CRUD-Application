<?php
session_start();
if (isset($_SESSION["username"])) {

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <div class="navbar">
        <a href="index.php"><i class="fa fa-fw fa-home"></i> Home</a> 
        <a href="Insert_into_Database.php"><i class="fa fa-fw fa-plus"></i> Insert</a>
        <a class="active" href="View_From_Database.php"><i class="fa fa-fw fa-search"></i> View Table</a>
        <!-- <a href="#"><i class="fa fa-fw fa-search"></i> Search</a> -->
        <!-- <a href="#"><i class="fa fa-fw fa-envelope"></i> Contact</a>  -->
        <a href="logout.php"><i class="fa fa-fw fa-user"></i> Logout</a>
    </div>

    <h2 class="success">
        <!-- @ - won't show error when there is no id -->
        <?php echo @$_GET["id"]; ?>
    </h2>

    <div class="">
        <fieldset>
            <form class="" action="View_From_Database.php" method="GET">
                <input type="text" name="search" value="" placeholder="Search by name">
                <br>
                <input type="submit" name="searchBtn" value="Search record">
            </form>
        </fieldset>
    </div>
    <?php
    if (isset($_GET["searchBtn"])) {
        global $ConnectingDB;
        $Search = $_GET["search"];
        $sql = "SELECT * FROM animal_record WHERE name=:searcH";
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
                    <h3 align="center">Search Result</h3>
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
                        <td><a href = "Report.php?id=<?php echo $Id?>">Report</a></td>
                        <td><?php echo $Time; ?></td>
                        <td> <a href="View_From_Database.php">Search Again</a> </td>
                    </tr>
                </table>
            </div>

    <?php }
    }
    ?>

    <table width="1000" border="5" align="center">
        <h3 align="center">View from Database</h3>
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
                <td> <a href="Report.php?id=<?php echo $Id?>">Report</a> </td>
                <td><?php echo $Time; ?></td>
                <td> <a href="Update.php?id=<?php echo $Id; ?>">Update</a> </td>
                <td> <a href="Delete.php?id=<?php echo $Id; ?>">Delete</a> </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php } else {
    header("Location: index.php");
} ?>