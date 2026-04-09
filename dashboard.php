<?php
session_start();
// Removed session check for clickjacking demo purposes
// if (!isset($_SESSION['username'])) {
//     header("Location: login.php");
//     exit();
// }

include "db_connect.php";

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'demo';

$message = "";
if (isset($_POST['transfer'])) {
    $amount = 1000;
    $status = 'completed';

    $sql = "INSERT INTO transactions (username, amount, status) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sis", $username, $amount, $status);
    if ($stmt->execute()) {
        $message = "Transfer of ₹1000 completed successfully!";
    } else {
        $message = "Error in transfer.";
    }
}

if (isset($_POST['delete'])) {
    if (isset($_SESSION['username'])) {
        $sql = "DELETE FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_SESSION['username']);
        $stmt->execute();
        session_destroy();
        header("Location: login.php");
        exit();
    } else {
        $message = "Cannot delete demo account.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; }
        header { background: #007bff; color: white; padding: 10px; text-align: center; }
        nav { background: #333; color: white; padding: 10px; }
        nav a { color: white; margin: 0 10px; text-decoration: none; }
        .dashboard { max-width: 600px; margin: 20px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); text-align: center; }
        button { background: #28a745; color: white; padding: 10px 20px; border: none; margin: 10px; cursor: pointer; }
        .delete-btn { background: #dc3545; }
        footer { background: #333; color: white; text-align: center; padding: 10px; position: fixed; bottom: 0; width: 100%; }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Bank, <?php echo $_SESSION['username']; ?>!</h1>
    </header>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="login.php">Logout</a>
    </nav>
    <div class="dashboard">
        <h2>Dashboard</h2>
        <?php if ($message) echo "<p>$message</p>"; ?>
        <form method="POST">
            <button type="submit" name="transfer">Transfer ₹1000</button>
            <button type="submit" name="delete" class="delete-btn">Delete Account</button>
        </form>
    </div>
    <footer>
        <p>&copy; 2024 Bank. All rights reserved.</p>
    </footer>
</body>
</html>
