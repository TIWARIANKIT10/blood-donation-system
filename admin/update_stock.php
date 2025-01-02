<?php
 session_start();

 if($_SERVER['REQUEST_METHOD']=='POST'){

    if($_SESSION['role']=='admin'){

        $id= $_POST['id'];
        $quantity = $_POST['quantity'];
        $query = "UPDATE blood_stock SET quanity=? WHERE id=$id";
        $stmt = $con->prepare($query);
        $stmt->blind_param("i",$quantity);
        
        if($stmt->execute()){
            echo"updated sucessfully ";
            header('Location: blood_stock.php');
        }else {
            echo "Error: " . $stmt->error;
        }




    }else{
        echo"access denetied";
        exit();
    }

 }






?>