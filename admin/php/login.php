<?php
session_start();
 $_SESSION["loggedIn"]=false;
if($_POST["username"]=="sneakerup"&&$_POST["password"]=="montreal"){
//echo "asdasd";
 //echo true;
 $_SESSION["loggedIn"]=true;
 header("location:../home.php");
}
else{
//echo false;
 $_SESSION["loggedIn"]=true;
 header("location:../login.php?error=1");
}
?>