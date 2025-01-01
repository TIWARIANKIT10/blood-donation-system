<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user register </title>
</head>
<body>
    <form action="register.php" method="post">

    <label for="name">Name:</label>
    <input type="text" name="name" required> <br>

    <label for="email">Email:</label>
    <input type="email" name="email" required> <br>

    <label for="password">Password:</label>
    <input type="password" name="password" required> <br>

    <label for="blood_group" > Blood_group:</label>
        <select name="blood_group" >
            <option value="a+">a+</option>
            <option value="a-">a-</option>
            <option value="b+">b+</option>
            <option value="b-">b-</option>
            <option value="o+">o+</option>
            <option value="o-">o-</option>
            <option value="ab+">ab+</option>
            <option value="ab-">ab-</option>
        </select><br>
 
        <label for="phone">Phone:</label>
    <input type="text" name="phone" required><br>

    <label for="address">Address:</label>
    <textarea name="address" required></textarea><br>
    

    <button type="submit"  name="submit" value="qqq">submit</button>

    </form>
    
</body>
</html>
<?php
include "config/db.php";

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_hashs = password_hash($password, PASSWORD_BCRYPT);

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email already used to register.";
    } else {
        $name = $_POST["name"];
        $blood_group = $_POST["blood_group"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];

        $query = "INSERT INTO users (id, name, email, password, blood_group, phone, address) VALUES (NULL, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ssssss", $name, $email, $password_hashs, $blood_group, $phone, $address);

        if ($stmt->execute()) {
            echo "Register successfully.";
        } else {
            echo "Failed to register: " . $stmt->error;
        }
    }
} else {
    echo "No form submission detected.";
}
?>
