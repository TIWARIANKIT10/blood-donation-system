<?php
include '../config/db.php';
 session_start();


 if($_SESSION['role']!='admin'){
    echo"normal user are not allowed ";
    exit();
 }
 $query = ""



?>