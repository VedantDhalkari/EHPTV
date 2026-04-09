<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Guide - EcoBank XSS Demo</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #2c3e50;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .step {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border-left: 4px solid #27ae60;
        }
        .step h3 {
            color: #27ae60;
            margin-bottom: 0.5rem;
        }
        .step code {
            background: #e9ecef;
            padding: 0.2rem 0.4rem;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
        }
        .test-btn {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
            margin: 0.5rem;
            display: inline-block;
        }
        .test-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(39, 174, 96, 0.4);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🛠️ EcoBank XSS Demo Setup Guide</h1>
        
        <div class="success">
            <strong>✅ Database Status:</strong> bankdemo database detected in MySQL Workbench
        </div>

        <div class="step">
            <h3>📋 Step 1: Verify Database Connection</h3>
            <p>Test the database connection:</p>
            <a href="test_db.php" class="test-btn">🔍 Test Database Connection</a>
        </div>

        <div class="step">
            <h3>🗄️ Step 2: Test Stored XSS</h3>
            <p>Submit malicious payloads that will be stored in the database:</p>
            <a href="stored_xss_test.php" class="test-btn">🚀 Test Stored XSS</a>
        </div>

        <div class="step">
            <h3>🔓 Step 3: Test Reflected XSS</h3>
            <p>Test XSS that reflects immediately back:</p>
            <a href="xss_test.php" class="test-btn">⚡ Test Reflected XSS</a>
        </div>

        <div class="step">
            <h3>📝 Step 4: Submit Real Feedback</h3>
            <p>Use the actual feedback form (vulnerable to XSS):</p>
            <a href="feedback.php" class="test-btn">💬 Open Feedback Form</a>
        </div>

        <div class="step">
            <h3>👤 Step 5: View Admin Panel</h3>
            <p>See all submitted feedback (XSS will execute here):</p>
            <a href="admin_feedback.php" class="test-btn">🔐 Open Admin Panel</a>
        </div>

        <div class="step">
            <h3>🔧 XAMPP Configuration</h3>
            <p><strong>Database:</strong> <code>bankdemo</code></p>
            <p><strong>Host:</strong> <code>localhost</code></p>
            <p><strong>Username:</strong> <code>root</code></p>
            <p><strong>Password:</strong> <code>(empty/default)</code></p>
            <p><strong>Table:</strong> <code>feedback</code></p>
        </div>

        <div class="step">
            <h3>⚠️ XSS Testing Notes</h3>
            <ul>
                <li><strong>Stored XSS:</strong> Payloads saved in database, affect all users</li>
                <li><strong>Reflected XSS:</strong> Payloads execute immediately on response</li>
                <li><strong>Educational Only:</strong> Use in controlled environment</li>
                <li><strong>Browser DevTools:</strong> Monitor console for JavaScript execution</li>
            </ul>
        </div>

        <div style="margin-top: 2rem; text-align: center;">
            <a href="index.php" style="color: #27ae60; text-decoration: none; font-size: 1.2rem;">🏠 Back to EcoBank Main</a>
        </div>
    </div>
</body>
</html>
