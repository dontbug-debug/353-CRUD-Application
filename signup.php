<?php
require_once("Include/DB.php");


if (isset($_POST["Submit"])) {
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        global $ConnectingDB;
        $sql = "INSERT INTO employee_account(username, password) VALUES(:usernamE, :passworD)";
                $stmt = $ConnectingDB->prepare($sql);
                $stmt->bindValue(':usernamE', $username);
                $stmt->bindValue(':passworD', $password);

        $Execute = $stmt->execute();
        if ($Execute) {
            echo '<span class="success">Account has been Created Successfully</span>';
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
</head>
<body>
    <!-- center the whole form using CSS -->
    <?php ?>
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