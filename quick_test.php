<?php
// Quick database connection test
echo "<h2>🔍 Quick Database Connection Test</h2>";

// Test connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bankdemo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "<p style='color: red; font-size: 18px;'>❌ CONNECTION FAILED</p>";
    echo "<p><strong>Error:</strong> " . $conn->connect_error . "</p>";
    echo "<h3>🔧 Troubleshooting:</h3>";
    echo "<ul>";
    echo "<li>Check if XAMPP MySQL is running</li>";
    echo "<li>Verify MySQL Workbench is accessible</li>";
    echo "<li>Confirm database 'bankdemo' exists</li>";
    echo "<li>Check MySQL username/password</li>";
    echo "</ul>";
} else {
    echo "<p style='color: green; font-size: 18px;'>✅ CONNECTION SUCCESSFUL!</p>";
    echo "<p><strong>Host:</strong> $servername</p>";
    echo "<p><strong>Database:</strong> $dbname</p>";
    echo "<p><strong>User:</strong> $username</p>";
    
    // Test if feedback table exists
    $result = $conn->query("SHOW TABLES LIKE 'feedback'");
    if ($result->num_rows > 0) {
        echo "<p style='color: green;'>✅ Feedback table exists!</p>";
        
        // Count records
        $count = $conn->query("SELECT COUNT(*) as total FROM feedback")->fetch_assoc()['total'];
        echo "<p><strong>Total feedback records:</strong> $count</p>";
        
        // Show recent records
        $recent = $conn->query("SELECT name, email, message, created_at FROM feedback ORDER BY created_at DESC LIMIT 3");
        if ($recent->num_rows > 0) {
            echo "<h3>📋 Recent Feedback:</h3>";
            while ($row = $recent->fetch_assoc()) {
                echo "<div style='border: 1px solid #ddd; padding: 10px; margin: 10px 0; border-radius: 5px;'>";
                echo "<strong>Name:</strong> " . htmlspecialchars($row['name']) . "<br>";
                echo "<strong>Email:</strong> " . htmlspecialchars($row['email']) . "<br>";
                echo "<strong>Message:</strong> " . htmlspecialchars($row['message']) . "<br>";
                echo "<strong>Date:</strong> " . $row['created_at'];
                echo "</div>";
            }
        }
    } else {
        echo "<p style='color: orange;'>⚠️ Feedback table doesn't exist yet</p>";
        echo "<p><a href='create_table.php'>🔨 Create Feedback Table</a></p>";
    }
}

$conn->close();
?>

<p style="margin-top: 20px;">
    <a href="feedback.php">📝 Test Feedback Form</a> | 
    <a href="stored_xss_test.php">🚀 Test Stored XSS</a> | 
    <a href="index.php">🏠 Home</a>
</p>
