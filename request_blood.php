<?php
include "config/db.php";
session_start();

if(isset($_SESSION['role'])){
    echo"first login to request blood";
    exit();
}

?>

<h1>blood request</h1>
<form action="db.php" method="post">
<label for="blood_group"> Blood group </label>
<select name="blood_group"  required>
    <option value="a+">a+</option>
    <option value="a-">a-</option>
    <option value="b+">b+</option>
    <option value="b-">b-</option>
    <option value="ab+">ab+</option>
    <option value="ab-">ab-</option>
</select>

<br>

<label for="units">units</label>
<input type="number" name="number_units" require><br>

<label for="reason" > reason </label>
<textarea name="reason"  required></textarea>

<button type="submit">submit request </button>

</form>

<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $userid = $_SESSION['userid'];
    $blood_group = $_POST['blood_group'];
    $units = $_POST['number_units'];
    $reason = $_POST['reason'];

    $query= "INSERT INTO blood_request(user_id,blood_group,units,reason) VALUES(?,?,?,?)";
    $stmt =  $con->prepare($query);
    $stmt->bind_param("isis",$userid,$blood_group,$units,$reason);

    if ($stmt->execute()) {
        echo "Blood request submitted successfully!";
        header('Location: donor_dashboard.php'); 
    } else {
        echo "Error: " . $stmt->error;
    }
    

}


?>