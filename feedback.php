<?php
session_start();

// Removed login check for XSS demo purposes
// if (!isset($_SESSION['user_id'])) {
//     header("Location: index.php");
//     exit();
// }

// Include database connection
include "db_connect.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    // Insert into database without sanitization (intentionally vulnerable)
    $sql = "INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);
    
    if ($stmt->execute()) {
        // $success_msg = "Feedback submitted successfully!";
    } else {
        $error_msg = "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Feedback - EcoBank</title>
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
        
        .feedback-form {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 3rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #2c3e50;
            font-weight: 600;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #27ae60;
        }
        
        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .submit-btn {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(39, 174, 96, 0.4);
        }
        
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border: 1px solid #c3e6cb;
        }
        
        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border: 1px solid #f5c6cb;
        }
        
        .feedback-display {
            margin-top: 3rem;
        }
        
        .feedback-item {
            background: #f8f9fa;
            border-left: 4px solid #27ae60;
            padding: 1.5rem;
            margin-bottom: 1rem;
            border-radius: 8px;
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
        }
        
        .feedback-date {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 0.5rem;
        }
        
        .section-title {
            color: #27ae60;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }
    </style>
</head>
<body>
    <header>
        <nav class="container">
            <div class="logo">EcoBank</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="feedback.php" style="color: #27ae60;">Customer Feedback</a></li>
                <li><a href="admin_feedback.php">Admin Panel</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <div class="main-content">
            <h1 class="page-title">Customer Feedback & Complaints</h1>
            
            <div class="feedback-form">
                <h2 class="section-title">Share Your Feedback</h2>
                
                <?php if (isset($success_msg)): ?>
                    <div class="success-message"><?php echo $success_msg; ?></div>
                    <script>alert('Feedback submitted successfully!');</script>
                <?php endif; ?>
                
                <?php if (isset($error_msg)): ?>
                    <div class="error-message"><?php echo $error_msg; ?></div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="name">Your Name *</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Your Feedback/Complaint *</label>
                        <textarea id="message" name="message" required placeholder="Please share your feedback, suggestions, or complaints..."></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Submit Feedback</button>
                </form>
            </div>
            
            <div class="feedback-display">
                <h2 class="section-title">Recent Feedback</h2>
                
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
                    echo '<p style="text-align: center; color: #6c757d;">No feedback submitted yet. Be the first to share your thoughts!</p>';
                }
                ?>
                
                <!-- Vulnerable to Stored XSS - Educational Demo Only -->
            </div>
        </div>
    </main>
</body>
</html>
