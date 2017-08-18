<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css" />
</head>
<body>
    <div class="adminContainer">
    <?php
        if(isset($_GET["error"])&&$_GET["error"]=="1"){
            echo "<h1>Invalid Login Credentials</h1><br/><br/>";
        }else if(isset($_GET["error"])&&$_GET["error"]=="2"){
            echo "<h1>You are not logged in</h1><br/><br/>";
        }
    ?>
        <div class="loginForm">
        <h2>LOGIN</h2>
            <form class="login" method="POST" action="./php/login.php">
                <input type="text" placeholder="Username" name="username" />
                <input type="password" placeholder="Password" name="password" />
                <input type="submit" value="Login" />
            </form>
        </div>
    </div>
</body>
</html>