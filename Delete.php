<?php
require_once("Include/DB.php");

$SearchQuery = $_GET["id"]; // shows the existing data in the table

    global $ConnectingDB;
    $sql = "DELETE FROM animal_record WHERE id='$SearchQuery'";
    $Execute = $ConnectingDB->query($sql);
    if ($Execute) {
        // sends the user back to the table 
        // _self is so it won't open in a new window
        echo '<script>window.open("View_From_Database.php?id=Record Deleted Successfully","_self")</script>';
    }
?>