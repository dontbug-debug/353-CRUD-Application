<?php
session_start();

if (isset($_SESSION["username"])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Include/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>K&S Shelter</title>
</head>
<body>
    <div class="navbar">
        <a class="active" href="index.php"><i class="fa fa-fw fa-home"></i> Home</a> 
        <a href="Insert_into_Database.php"><i class="fa fa-fw fa-plus"></i> Insert</a>
        <a href="View_From_Database.php"><i class="fa fa-fw fa-search"></i> View Table</a>
        <!-- <a href="#"><i class="fa fa-fw fa-search"></i> Search</a> -->
        <!-- <a href="#"><i class="fa fa-fw fa-envelope"></i> Contact</a>  -->
        <a href="logout.php"><i class="fa fa-fw fa-user"></i> Logout</a>
    </div>

    <div class="name" align="center">
        <h1>K&S Shelter</h1>
        <tagline>Home of All Breeds</tagline>
    </div>
    <br>

    <div class="pageButtons" align="center">
        <!-- <button><a href="Part_D/login.php"></a>Log-in</button>
        <button><a href="Part_D/signup.php"></a>Sign-up</button> -->
        <!-- <button onclick="window.location.href='signup.php'">Create an Account</button> -->
        <button onclick="window.location.href='logout.php'">Log-out</button>
    </div>
    
</body>
</html>


<?php } else {
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Include/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>K&S Shelter</title>
</head>
<body>
    <div class="navbar">
        <a class="active" href="index.php"><i class="fa fa-fw fa-home"></i> Home</a> 
        <a href="login.php"><i class="fa fa-fw fa-user"></i> Login</a>
    </div>

    <div class="name" align="center">
        <h1>K&S Shelter</h1>
        <tagline>Home of All Breeds</tagline>
    </div>
    <br>

    <div class="pageButtons" align="center">
        <!-- <button><a href="Part_D/login.php"></a>Log-in</button>
        <button><a href="Part_D/signup.php"></a>Sign-up</button> -->
        <!-- <button onclick="window.location.href='signup.php'">Create an Account</button> -->
        <button onclick="window.location.href='login.php'">Log-in</button>
    </div>
    
</body>
</html>


<?php }?>

