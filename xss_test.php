<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XSS Test - EcoBank</title>
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
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .test-form {
            margin-bottom: 2rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #2c3e50;
            font-weight: 600;
        }
        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
        }
        .submit-btn {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
        }
        .warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .payload-examples {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1rem;
        }
        .payload-examples h3 {
            color: #e74c3c;
            margin-bottom: 0.5rem;
        }
        .payload-examples code {
            background: #e9ecef;
            padding: 0.2rem 0.4rem;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            display: block;
            margin: 0.5rem 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔒 XSS Vulnerability Test - EcoBank</h1>
        
        <div class="warning">
            <strong>⚠️ Educational Purpose Only!</strong><br>
            This page is designed to demonstrate reflected XSS vulnerabilities for cybersecurity education.
            Only use in controlled environments with proper authorization.
        </div>

        <div class="test-form">
            <h2>Test Reflected XSS</h2>
            <form method="POST" action="search.php">
                <div class="form-group">
                    <label for="search">Enter Malicious Payload:</label>
                    <input type="text" id="search" name="search" placeholder="Enter XSS payload here...">
                </div>
                <button type="submit" class="submit-btn">🚀 Send to Server</button>
            </form>
        </div>

        <div class="payload-examples">
            <h3>Example XSS Payloads for Testing:</h3>
            <code>&lt;script&gt;alert('XSS Attack')&lt;/script&gt;</code>
            <code>&lt;img src=x onerror=alert('XSS')&gt;</code>
            <code>&lt;svg onload=alert('XSS')&gt;</code>
            <code>&lt;iframe src="javascript:alert('XSS')"&gt;&lt;/iframe&gt;</code>
            <code>&lt;body onload=alert('XSS')&gt;</code>
        </div>

        <div style="margin-top: 2rem;">
            <h3>📡 How it works:</h3>
            <ol>
                <li>Enter any XSS payload in the input field</li>
                <li>Click "Send to Server" to POST the data</li>
                <li>The server will echo the input without sanitization</li>
                <li>JavaScript code will execute in the browser</li>
                <li>This demonstrates reflected XSS vulnerability</li>
            </ol>
        </div>

        <div style="margin-top: 2rem;">
            <a href="index.php" style="color: #27ae60; text-decoration: none;">🏠 Back to EcoBank</a>
        </div>
    </div>
</body>
</html>


<?php
$search_query = isset($_GET['query']) ? htmlspecialchars($_GET['query'], ENT_QUOTES, 'UTF-8') : '';

?>

