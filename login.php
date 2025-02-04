<?php
 // At the VERY TOP
 session_start();
include "config/db.php";

// Process login FIRST before any HTML
if (isset($_POST["submit"])) {
    $username = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE email=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["name"] = $user["name"];
            $_SESSION["user_role"] = $user["role"];
            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Incorrect password.";
        }
    } else {
        $_SESSION['error'] = "User not found.";
    }
    header("Location: login.php"); 
    exit();
}

// AFTER processing PHP, output HTML
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Login Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7af);
            background-size: 400% 400%;
            animation: gradientShift 12s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        form {
            background: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            width: 90%;
            max-width: 400px;
            transform: scale(0.95);
            transition: all 0.3s ease;
        }

        form:hover {
            transform: scale(1);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }

        h2 {
            text-align: center;
            color: #ff4444;
            margin-bottom: 2rem;
            font-size: 2em;
            position: relative;
        }

        h2::after {
            content: "❤️";
            position: absolute;
            right: -30px;
            animation: heartbeat 1.2s infinite;
        }

        @keyframes heartbeat {
            0% { transform: scale(1); }
            15% { transform: scale(1.3); }
            30% { transform: scale(1); }
            45% { transform: scale(1.15); }
            60% { transform: scale(1); }
        }

        label {
            display: block;
            margin-bottom: 0.8rem;
            color: #444;
            font-weight: 600;
            transform: translateX(-10px);
            opacity: 0;
            animation: slideIn 0.6s forwards;
        }

        @keyframes slideIn {
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        input {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 1.5rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        input:focus {
            outline: none;
            border-color: #ff6b6b;
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.2);
            transform: translateY(-2px);
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(45deg, #ff6b6b, #ff4444);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
        }

        button::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.4),
                transparent
            );
            transition: 0.5s;
        }

        button:hover::before {
            left: 100%;
        }

        @media (max-width: 480px) {
            form {
                padding: 1.5rem;
            }
            
            h2 {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body>
    <form action="login.php" method="post">
        <h2>Login</h2>
        
        <label for="email">Email</label>
        <input type="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="submit">Login</button>
    </form>
</body>
</html>