<?php
session_start();

// Removed login check for XSS demo purposes
// if (!isset($_SESSION['user_id'])) {
//     header("Location: index.php");
//     exit();
// }

// Include database connection
include "db_connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Feedback - EcoBank</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #2c3e50;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }
        
        .logo {
            display: flex;
            align-items: center;
            font-size: 1.8rem;
            font-weight: bold;
            color: #27ae60;
        }
        
        .logo::before {
            content: "🌿";
            margin-right: 10px;
            font-size: 2rem;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }
        
        .nav-links a {
            text-decoration: none;
            color: #2c3e50;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .nav-links a:hover {
            color: #27ae60;
        }
        
        .main-content {
            background: white;
            border-radius: 15px;
            padding: 3rem;
            margin: 2rem 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .page-title {
            text-align: center;
            color: #27ae60;
            margin-bottom: 2rem;
            font-size: 2.5rem;
        }
        
        .admin-badge {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .feedback-item {
            background: #f8f9fa;
            border-left: 4px solid #27ae60;
            padding: 1.5rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .feedback-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .feedback-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        
        .feedback-name {
            font-weight: 600;
            color: #2c3e50;
        }
        
        .feedback-email {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .feedback-message {
            color: #495057;
            line-height: 1.6;
            margin: 1rem 0;
        }
        
        .feedback-date {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 0.5rem;
        }
        
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
        }
        
        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <header>
        <nav class="container">
            <div class="logo">EcoBank</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="feedback.php">Customer Feedback</a></li>
                <li><a href="admin_feedback.php" style="color: #27ae60;">Admin Feedback <span class="admin-badge">ADMIN</span></a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <div class="main-content">
            <h1 class="page-title">Admin Feedback Panel</h1>
            
            <?php
            // Get statistics
            $total_sql = "SELECT COUNT(*) as total FROM feedback";
            $total_result = $conn->query($total_sql);
            $total_row = $total_result->fetch_assoc();
            $total_feedback = $total_row['total'];
            
            $today_sql = "SELECT COUNT(*) as today FROM feedback WHERE DATE(created_at) = CURDATE()";
            $today_result = $conn->query($today_sql);
            $today_row = $today_result->fetch_assoc();
            $today_feedback = $today_row['today'];
            ?>
            
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-number"><?php echo $total_feedback; ?></div>
                    <div class="stat-label">Total Feedback</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?php echo $today_feedback; ?></div>
                    <div class="stat-label">Today's Feedback</div>
                </div>
            </div>
            
            <h2 style="color: #27ae60; margin-bottom: 1.5rem;">All Customer Feedback</h2>
            
            <?php
            // Display all feedback records
            $sql = "SELECT * FROM feedback ORDER BY created_at DESC";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="feedback-item">';
                    echo '<div class="feedback-header">';
                    echo '<span class="feedback-name">' . $row['name'] . '</span>';
                    echo '<span class="feedback-email">' . $row['email'] . '</span>';
                    echo '</div>';
                    echo '<div class="feedback-message">' . $row['message'] . '</div>';
                    echo '<div class="feedback-date">Submitted on: ' . $row['created_at'] . '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p style="text-align: center; color: #6c757d;">No feedback submitted yet.</p>';
            }
            ?>
            
            <!-- Vulnerable to Stored XSS - Educational Demo Only -->
        </div>
    </main>
</body>
</html>
