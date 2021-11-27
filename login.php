<?php
require_once("Include/DB.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $LoginUsername = $_POST["username"];
    $LoginPassword = $_POST["password"];

    if (!empty($LoginUsername) && !empty($LoginPassword)) {

        $accountFound = 0;

        global $ConnectingDB;
        $sql = "SELECT * FROM employee_account WHERE username=:usernamE";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':usernamE', $LoginUsername);
        $stmt->execute();
        while ($DataRows = $stmt->fetch()) {
            $username             = $DataRows["username"];
            $password             = $DataRows["password"];

            if (($LoginUsername == $username) && ($LoginPassword == $password)) {
                echo '<script>window.open("insert_into_Database.php","_self")</script>';
                $accountFound = 1;
            }
        }

        if ($accountFound == 0) {
            echo "<span class='FieldInfoHeading'>Sorry, Please Try Again</span>";
        }
    } else {
        echo "<span class='FieldInfoHeading'>Please add Valid Username or Password</span>";
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
    <div class="">
        <form class="" action="login.php" method="POST">
            <fieldset>
                <span class="FieldInfo">Username:</span>
                <br>
                <input type="text" name="username" value="">
                <br>
                <span class="FieldInfo">Password:</span>
                <br>
                <input type="password" name="password" value="">
                <br>
                <input type="submit" name="Submit" value="Login">
            </fieldset>
        </form>
    </div>
</body>

</html>