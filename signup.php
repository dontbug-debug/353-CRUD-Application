<?php
require_once("Include/DB.php");


if (isset($_POST["Submit"])) {
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        global $ConnectingDB;

        // checks if the username exists in the database if it exists then <span> add unique username</span>
        $mySql = "SELECT * FROM employee_account WHERE username=:user";
        $search = $ConnectingDB->prepare($mySql);
        $search->bindValue(':user', $username);
        $search->execute();
        $user = "";
        while ($DataRows = $search->fetch()) {
           $user             = $DataRows["username"];
        }
        // ------------------------------------------------------------------------------------------

        if (strtolower($user) != strtolower($username)) {
            $sql = "INSERT INTO employee_account(username, password) VALUES(:usernamE, :passworD)";
                    $stmt = $ConnectingDB->prepare($sql);
                    $stmt->bindValue(':usernamE', $username);
                    $stmt->bindValue(':passworD', $password);
            
            $Execute = $stmt->execute();
            if ($Execute) {
                echo '<span class="success">Account has been Created Successfully</span>';
            }
        }
        else {
            echo "<span class='FieldInfoHeading'>Username Already Exists</span>";
        }
    } else {
        echo "<span class='FieldInfoHeading'>Please add Username and Password. OR have a Unique Username</span>";
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
        <a href="login.php"><i class="fa fa-fw fa-user"></i> Login</a>
    </div>

    <div class="">
        <form class="" action="signup.php" method="POST">
            <fieldset>
                <span class="FieldInfo">Username:</span>
                <br>
                <input type="text" name="username" value="">
                <br>
                <span class="FieldInfo">Password:</span>
                <br>
                <input type="password" name="password" value="">
                <br>
                <input type="submit" name="Submit" value="Sign Up">
            </fieldset>
        </form>
    </div>
</body>
</html>