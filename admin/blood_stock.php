<?php
include '../config/db.php';
session_start();

if($_SESSION['role']=!'admin'){
    echo "Acess denied";
     exit;
}

$query = "SELECT  * FROM  blood_stock";
$result= $con->query($query);

?>

<h1> Blood Stock Management</h1>
<table border="1">
<tr>
    <th>id</th>
    <th>blood_group</th>
    <th>quantity</th>
    <th>updated_at</th>
</tr>

<?php
while($row = $result->fetch_assoc()){
    echo"<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['blood_group']."</td>";
    echo "<td>".$row['quantity']."</td>";
    echo "<td>".$row['updated_at']."</td>";

?>
<td>
<form action="update_stock.php" method="post" style="display:inline;">

<input type="hidden" name="id" value="<?php $row['id']?>">
<input type="number" name="quantity" placeholder="updatequantity">
<button type="submit" >Update</button>

</form>
</td>
</tr>
<?php } ?>
</table>