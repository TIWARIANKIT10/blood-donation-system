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
if(isset($_POST["submit"])){

    $username= $_POST["email"];
   $password = $_POST["password"];

   $query = "SELECT * FROM USERS WHERE email=?";
   $stmt = $con->prepare($query);
   $stmt->bind_param("s",$username);
   $stmt->execute();
   $result = $stmt->get_result(); 
  
   
   if($result->num_rows  > 0){
    $user = $result->fetch_assoc();
   
    if(password_verify($password, $user["password"])){
       $_SESSION["user_id"]= $user["id"];
       $_SESSION["name"] = $user["name"];
       $_SESSION["user_role"] =$user["role"];
       echo "login completed";


    }else{
        echo"incorrect password";
    } 

    }else{
        echo"user not found";
   }

}


?>