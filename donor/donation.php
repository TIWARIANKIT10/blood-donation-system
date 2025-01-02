<?php
include('../config/db.php');
session_start();
if($_SESSION['role']=='donor'){
    $donor_id = $_SESSION['id'];
    $query = "SELECT FROM donations where id=$donor_id";
    $run = $con->query($query);
    $result = $run->get_result();





?>
<h2> your donation history</h2>
<table border=1 >
    <tr>
        <th>id</th>
        <th>donor_id</th>
        <th>blood_group</th>
        <th>quantity</th>
        <th>donation_date</th>
    </tr>
    <?php
    while($row =$result->fetch_assoc()){
        echo"<tr>";
        echo"<td>".$row['id']."</td>";
        echo"<td>".$row['donor']."</td>";
        echo"<td>".$row['blood_group']."</td>";
        echo"<td>".$row['quantity']."</td>";
        echo"<td>".$row['donation_date']."</td>";

        
    }}
    else{
        echo"role not match";
    }
    ?>

</table>