<?php
session_start();
if(isset($_SESSION['locked']) && $_SESSION['locked'] == true){
    header("Location: ransom_locker.php");
    exit();
}

if(isset($_FILES['file'])){
    $filename = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];
    
    // Vulnerable: No checks for malicious content or file types
    move_uploaded_file($tmp, "uploads/".$filename);
    $success_message = "File '$filename' uploaded successfully.";
    
    // Vulnerable: Including uploaded content allows malicious scripts to execute
    $content = file_get_contents("uploads/".$filename);
    echo $content;
    
    
    // Prevention Code:
    // To prevent malicious file uploads, implement the following:
    
    // 1. Validate file extensions
    $allowed_extensions = ['txt', 'jpg', 'png', 'pdf', 'doc', 'docx'];
    $file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    if (!in_array($file_extension, $allowed_extensions)) {
        die("Invalid file type. Only allowed: " . implode(', ', $allowed_extensions));
    }
    
    // 1. Validate file extensions
    $allowed_extensions = ['txt', 'jpg', 'png', 'pdf', 'doc', 'docx'];
    $file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    if (!in_array($file_extension, $allowed_extensions)) {
        die("Invalid file type. Only allowed: " . implode(', ', $allowed_extensions));
    }
    
    // 2. Validate MIME types
    $allowed_mime_types = ['text/plain', 'image/jpeg', 'image/png', 'application/pdf'];
    $file_mime = mime_content_type($tmp);
    if (!in_array($file_mime, $allowed_mime_types)) {
        die("Invalid MIME type.");
    }
    
    // 3. Scan for malicious content
    $content = file_get_contents($tmp);
    $malicious_patterns = ['<\?php', '<script', 'javascript:', 'eval\(', 'base64_decode'];
    foreach ($malicious_patterns as $pattern) {
        if (stripos($content, $pattern) !== false) {
            die("Malicious content detected.");
        }
    }
    
    // 4. Use secure file naming
    $safe_filename = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $filename);
    
    // 5. Store outside web root or with restricted permissions
    move_uploaded_file($tmp, "/secure/path/" . $safe_filename);
    
    // Additional: Use antivirus scanning, file size limits, etc.
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload - EcoBank</title>
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
            max-width: 800px;
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
        
        main {
            padding: 3rem 0;
        }
        
        .upload-section {
            background: white;
            border-radius: 15px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        .upload-section h1 {
            color: #27ae60;
            margin-bottom: 2rem;
            font-size: 2.5rem;
        }
        
        .upload-section p {
            margin-bottom: 2rem;
            font-size: 1.1rem;
            color: #555;
        }
        
        .upload-form {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }
        
        .file-input-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 2rem;
        }
        
        .file-input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        
        .file-input-button {
            display: inline-block;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
        }
        
        .file-input-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(39, 174, 96, 0.4);
        }
        
        .submit-btn {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
        }
        
        .success-message {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            font-size: 1.1rem;
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
        }
        
        .back-btn {
            display: inline-block;
            background: linear-gradient(135deg, #95a5a6 0%, #7f8c8d 100%);
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(149, 165, 166, 0.3);
        }
        
        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(149, 165, 166, 0.4);
        }
        
        .file-info {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1rem;
            border-left: 4px solid #27ae60;
        }
    </style>
</head>
<body>
    <header>
        <nav class="container">
            <div class="logo">EcoBank</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <section class="upload-section">
            <h1>📁 Secure File Upload</h1>
            <p>Upload your documents to EcoBank's secure cloud storage system</p>
            
            <?php if(isset($success_message)): ?>
                <div class="success-message">
                    ✅ <?php echo $success_message; ?>
                </div>
            <?php endif; ?>
            
            <?php if(isset($error_message)): ?>
                <div class="error-message" style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); color: white; padding: 1.5rem; border-radius: 10px; margin-bottom: 2rem; font-size: 1.1rem; box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);">
                    ❌ <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            
            <div class="upload-form">
                <form method="POST" enctype="multipart/form-data">
                    <div class="file-input-wrapper">
                        <input type="file" name="file" class="file-input" id="fileInput" required>
                        <label for="fileInput" class="file-input-button">
                            📄 Choose File
                        </label>
                    </div>
                    <div id="fileName" style="margin-bottom: 1rem; color: #555;"></div>
                    <input type="submit" value="🔐 Upload Securely" class="submit-btn">
                </form>
                
                <div class="file-info">
                    <strong>🔒 Security Features:</strong><br>
                    • End-to-end encryption<br>
                    • Virus scanning<br>
                    • Secure cloud storage<br>
                    • Multi-factor authentication
                </div>
            </div>
            
            <a href="index.php" class="back-btn">🏠 Return to Home</a>
        </section>
    </main>

    <script>
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || '';
            document.getElementById('fileName').textContent = fileName ? `Selected: ${fileName}` : '';
        });
    </script>
</body>
</html>
