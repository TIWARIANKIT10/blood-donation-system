<?php 

include "config/db.php";
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blood bank management system </title>
    <link rel="stylesheet" href="style.css">
    <style>
       /* Position the button in the top-right corner */
#button_register {
    position: absolute;
    top: 20px;
    right: 20px;
    background: linear-gradient(45deg, #ff416c, #ff4b2b); /* Dynamic gradient */
    padding: 10px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease-in-out;
}

/* Style the link */
#button_register a {
    text-decoration: none;
    color: white;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
}

/* Hover effect */
#button_register:hover {
    background: linear-gradient(45deg, #36d1dc, #5b86e5); /* Changes color on hover */
    transform: scale(1.1); /* Slight zoom effect */
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
}


        
    </style>
</head>
<body>
    <div>
<div>
    <div id="button_register">
        <a href="register.php">register</a>
    </div>
    </div>
        
    <div>
        <?php
   
        
     require('login.php');
     exit();
        ?>
    </div>
    </div>
</body>
</html>