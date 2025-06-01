<?php
session_start();
require_once 'C:/xampp/htdocs/tutorial/MOBILE SHOPEE/database/DBController.php';

use database\DBController;

$db = new DBController();
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';


    // Query to find user by email
    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = $db->con->query($query);

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Check the password
        if (password_verify($password, $user['password'])) {
            // ✅ Set session variables here
            $_SESSION["user_id"] = $user["user_id"];
            $_SESSION["first_name"] = $user["first_name"];

            // 🔁 Redirect to homepage
            header("Location: index.php");
            exit();
        } else {
            echo "❌ Invalid password.";
        }
    } else {
        echo "❌ User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login | Mobile Shopee</title>
    <style>
        body {
            background: linear-gradient(120deg, #2980b9, #6dd5fa);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 40px 50px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 350px;
        }

        h2 {
            margin-bottom: 20px;
            color: #2980b9;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            background-color: #2980b9;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 15px;
        }

        button:hover {
            background-color: #216a94;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .link {
            margin-top: 15px;
            font-size: 14px;
        }

        .link a {
            color: #2980b9;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>

    <div class="link">
        Don't have an account? <a href="register.php">Register</a>
    </div>
</div>
</body>
</html>
