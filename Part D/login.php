<?php
session_start(); 
require_once("Include/DB.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST["username"];
    $inputPassword = $_POST["password"];

    if (!empty($inputUsername) && !empty($inputPassword)) {

        $accountFound = 0;

        global $ConnectingDB;
        $sql = "SELECT * FROM employee_account WHERE username=:usernamE";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':usernamE', $inputUsername);
        $stmt->execute();
        while ($DataRows = $stmt->fetch()) {
            $DBusername             = $DataRows["username"];
            $DBpassword             = $DataRows["password"];

            if (($inputUsername == $DBusername) && password_verify($inputPassword, $DBpassword)) {
                $_SESSION['username'] = $DBusername;
                echo '<script>window.open("Insert_into_Database.php","_self")</script>';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="navbar">
        <a href="index.php"><i class="fa fa-fw fa-home"></i> Home</a> 
    </div>

    <div class="">
    <fieldset>
        <form class="" action="login.php" method="POST">
            
                <span class="FieldInfo">Username:</span>
                <br>
                <input type="text" name="username" value="">
                <br>
                <span class="FieldInfo">Password:</span>
                <br>
                <input type="password" name="password" value="">
                <br>
                <input type="submit" name="Submit" value="Login">
        </form>
        <a href="signup.php">Signup</a>
    </fieldset>
    </div>
</body>

</html>