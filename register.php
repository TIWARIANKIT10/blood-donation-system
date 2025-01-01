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
    

    <button type="submit">submit</button>

    </form>
    
</body>
</html>