<?php

$server_name ="localhost";
$user_name= "root";
$password = "";
$database_name= "blood_donation_system";

$con = new mysqli($server_name, $user_name, $password,$database_name);

if($con){
    echo"connected ";
}
else{
    echo"failed";
}
?>