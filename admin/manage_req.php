<?php
include '../config/db.php';
 session_start();


//  if($_SESSION['role']!='admin'){
//     echo"normal user are not allowed ";
//     exit();
//  }


 $query = " SELECT r.id, u.name, r.blood_group, r.units, r.reason, r.request_date 
          FROM blood_requests r 
          JOIN users u ON r.user_id = u.id 
          WHERE r.status = 'Pending'";
          
          $result =$con->query($query);

?>
<h1>manage blood request</h1>
<table border=1>
   <tr>
      <th>request id </th>
      <th>donar name</th>
      <th>blood group </th>
      <th>units</th>
      <th>reason</th>
      <th>date</th>
      <th>action</th>
   </tr>
   <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['blood_group']; ?></td>
            <td><?php echo $row['units']; ?></td>
            <td><?php echo $row['reason']; ?></td>
            <td><?php echo $row['request_date']; ?></td>
            <td>
                <a href="update_request.php?id=<?php echo $row['id']; ?>&status=Approved">Approve</a>
                <a href="update_request.php?id=<?php echo $row['id']; ?>&status=Rejected">Reject</a>
            </td>
        </tr>
    <?php } ?>
     
   

</table>