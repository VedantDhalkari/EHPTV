<?php
// Test database connection
include "db_connect.php";

echo "<h2>Database Connection Test</h2>";

if ($conn->connect_error) {
    echo "<p style='color: red;'>❌ Connection failed: " . $conn->connect_error . "</p>";
} else {
    echo "<p style='color: green;'>✅ Database connected successfully!</p>";
}

// Test if feedback table exists
$result = $conn->query("DESCRIBE feedback");
if ($result) {
    echo "<p style='color: green;'>✅ Feedback table exists!</p>";
    
    // Show table structure
    echo "<h3>Table Structure:</h3>";
    echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
    echo "<tr style='background: #f2f2f2;'>";
    echo "<th style='padding: 10px;'>Field</th>";
    echo "<th style='padding: 10px;'>Type</th>";
    echo "</tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td style='padding: 10px; border: 1px solid #ddd;'>" . $row['Field'] . "</td>";
        echo "<td style='padding: 10px; border: 1px solid #ddd;'>" . $row['Type'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Test inserting a record
    $test_sql = "INSERT INTO feedback (name, email, message) VALUES ('Test User', 'test@example.com', 'Test message')";
    if ($conn->query($test_sql)) {
        echo "<p style='color: green;'>✅ Test record inserted successfully!</p>";
        
        // Show all records
        $all_records = $conn->query("SELECT * FROM feedback ORDER BY created_at DESC");
        if ($all_records->num_rows > 0) {
            echo "<h3>All Feedback Records:</h3>";
            while ($record = $all_records->fetch_assoc()) {
                echo "<div style='border: 1px solid #ddd; padding: 10px; margin: 10px 0;'>";
                echo "<strong>Name:</strong> " . $record['name'] . "<br>";
                echo "<strong>Email:</strong> " . $record['email'] . "<br>";
                echo "<strong>Message:</strong> " . $record['message'] . "<br>";
                echo "<strong>Date:</strong> " . $record['created_at'] . "<br>";
                echo "</div>";
            }
        }
    } else {
        echo "<p style='color: red;'>❌ Error inserting test record: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Feedback table doesn't exist!</p>";
}

$conn->close();
?>

<p><a href="index.php">🏠 Back to EcoBank</a></p>
