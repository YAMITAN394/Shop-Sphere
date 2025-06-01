<?php
require_once 'C:/xampp/htdocs/tutorial/MOBILE SHOPEE/database/DBController.php';

use database\DBController;

$db = new DBController();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = isset($_POST["first_name"]) ? $_POST["first_name"] : '';
    $last_name = isset($_POST["last_name"]) ? $_POST["last_name"] : '';
    $email = isset($_POST["email"]) ? $_POST["email"] : '';

    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Insert into  table
    $query = "INSERT INTO user(first_name, last_name, email, password) 
              VALUES ('$first_name', '$last_name', '$email', '$password')";

    if ($db->con->query($query)) {
        $message = "✅ User registered successfully! <a href='login.php'>Login now</a>";
    } else {
        $message = "❌ Error: " . $db->con->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Mobile Shopee</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-container {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.25);
            width: 350px;
        }

        h2 {
            text-align: center;
            color: #00aaff;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: none;
            border-radius: 8px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 16px;
            background-color: #00aaff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #008ecc;
        }

        .message {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
        }

        a {
            color: #00ffff;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="register-container">
    <h2>Create Account</h2>
    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
    <form action="register.php" method="POST">
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
</div>
</body>
</html>
