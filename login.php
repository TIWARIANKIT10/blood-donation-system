<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
</head>
<body>
    <form action="login.php"  method="post">

    <label for="username">email</label> <br>
    <input type="text" name="email" > <br>

    <label for="password" >password</label><br>
    <input type="password" name="password"><br>

    <button type="submit" name="submit" value="ok">login</button>
    </form>
</body>
</html>



<?php
include "config/db.php";
session_start();
if($_SERVER['REQUEST_METHOD']=='POST'){

    $username= $_POST["email"];
   $password = $_POST["password"];

   $query = "SELECT * FROM USERS WHERE email=?";
   $stmt = $con->prepare($query);
   $stmt->bind_params('s',$usename);
   $stmt->execute();
   $result = $

}


?>