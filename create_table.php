<?php
// Create feedback table in bankdemo database
$servername = "localhost";
$username = "root";
$password = ""; // Update with your MySQL root password if set

// Create connection without database first
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<h2>Database Setup for EcoBank</h2>";

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS bankdemo";
if ($conn->query($sql) === TRUE) {
    echo "<p style='color: green;'>✅ Database 'bankdemo' created or already exists!</p>";
} else {
    echo "<p style='color: red;'>❌ Error creating database: " . $conn->error . "</p>";
}

// Select the database
$conn->select_db("bankdemo");

// Drop existing table if needed (for fresh start)
$drop_sql = "DROP TABLE IF EXISTS feedback";
if ($conn->query($drop_sql)) {
    echo "<p style='color: orange;'>⚠️ Old feedback table dropped</p>";
}

// Create feedback table
$sql = "CREATE TABLE feedback (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "<p style='color: green;'>✅ Feedback table created successfully!</p>";
    
    // Test insertion
    $test_sql = "INSERT INTO feedback (name, email, message) VALUES ('Test User', 'test@example.com', 'This is a test message')";
    if ($conn->query($test_sql)) {
        echo "<p style='color: green;'>✅ Test record inserted!</p>";
        
        // Show table structure
        echo "<h3>Table Structure:</h3>";
        $result = $conn->query("DESCRIBE feedback");
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr style='background: #f2f2f2;'><th>Field</th><th>Type</th><th>Null</th><th>Key</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td style='padding: 8px; border: 1px solid #ddd;'>" . $row['Field'] . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #ddd;'>" . $row['Type'] . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #ddd;'>" . $row['Null'] . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #ddd;'>" . $row['Key'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        // Show all records
        echo "<h3>All Records:</h3>";
        $all_records = $conn->query("SELECT * FROM feedback ORDER BY created_at DESC");
        while ($record = $all_records->fetch_assoc()) {
            echo "<div style='border: 1px solid #ddd; padding: 10px; margin: 10px 0; border-radius: 5px;'>";
            echo "<strong>ID:</strong> " . $record['id'] . "<br>";
            echo "<strong>Name:</strong> " . $record['name'] . "<br>";
            echo "<strong>Email:</strong> " . $record['email'] . "<br>";
            echo "<strong>Message:</strong> " . $record['message'] . "<br>";
            echo "<strong>Created:</strong> " . $record['created_at'] . "<br>";
            echo "</div>";
        }
    } else {
        echo "<p style='color: red;'>❌ Error inserting test record: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Error creating table: " . $conn->error . "</p>";
}

$conn->close();
?>

<p><a href="feedback.php">📝 Test Feedback Form</a> | <a href="stored_xss_test.php">🚀 Test Stored XSS</a> | <a href="index.php">🏠 Home</a></p>
