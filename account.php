<?php
session_start();
require_once 'database/DBController.php';

use database\DBController;

$db = new DBController();

if (!isset($_SESSION["user_id"])) {
    die("User ID not set in session.");
}

$user_id = $_SESSION["user_id"];
$query = "SELECT first_name, last_name, email FROM user WHERE user_id = ?";
$stmt = $db->con->prepare($query);

if (!$stmt) {
    die("Prepare failed: " . $db->con->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Execute failed: " . $stmt->error);
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Account</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #e0f7fa, #e1f5fe);
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: white;
            max-width: 500px;
            margin: 80px auto;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 123, 255, 0.15);
            text-align: center;
        }

        h2 {
            color: #007bff;
            margin-bottom: 25px;
        }

        p {
            font-size: 18px;
            margin: 15px 0;
            color: #333;
        }

        strong {
            color: #0056b3;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            margin-top: 25px;
            transition: 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($user['first_name']); ?> 👋</h2>
    <p><strong>First Name:</strong> <?php echo htmlspecialchars($user['first_name']); ?></p>
    <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user['last_name']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>

    <a href="index.php" class="btn">Back to Home</a>
</div>

</body>
</html>
