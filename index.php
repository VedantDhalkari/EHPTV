<?php
// Intentional Vulnerability for Demo: Enable session ID transmission via URL
// Secure Alternative: ini_set('session.use_trans_sid', 0); // Disable URL transmission
ini_set('session.use_trans_sid', 1);

// Intentional Vulnerability for Demo: Disable HttpOnly and Secure flags for session cookie
// Secure Alternative: session_set_cookie_params(0, '/', '', true, true); // Enable HttpOnly and Secure
session_set_cookie_params(0, '/', '', false, false);

// Intentional Vulnerability for Demo: Allow session ID to be set via URL parameter
if (isset($_GET['PHPSESSID'])) {
    session_id($_GET['PHPSESSID']);
}

session_start();

// Intentional Vulnerability for Demo: No session regeneration
// Secure Alternative: After login, call session_regenerate_id(true); to prevent fixation

if(isset($_SESSION['locked']) && $_SESSION['locked'] == true){
    header("Location: ransom_locker.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBank - Sustainable Banking Solutions</title>
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
        
        .search-bar {
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(39, 174, 96, 0.05));
            border: 2px solid rgba(39, 174, 96, 0.2);
            border-radius: 30px;
            padding: 0.7rem 1.2rem;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        .search-bar::before {
            content: "🌿";
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem;
            color: #27ae60;
            z-index: 1;
        }
        
        .search-bar:focus-within {
            background: linear-gradient(135deg, rgba(255, 255, 255, 1), rgba(39, 174, 96, 0.08));
            border-color: #27ae60;
            box-shadow: 0 6px 25px rgba(39, 174, 96, 0.2);
            transform: translateY(-2px);
        }
        
        .search-bar input {
            background: none;
            border: none;
            color: #2c3e50;
            outline: none;
            width: 220px;
            font-size: 0.95rem;
            padding-left: 30px;
            font-weight: 500;
        }
        
        .search-bar input::placeholder {
            color: #7f8c8d;
            font-style: italic;
        }
        
        .search-bar button {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            border: none;
            color: white;
            cursor: pointer;
            font-size: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(39, 174, 96, 0.3);
            margin-left: 0.5rem;
        }
        
        .search-bar button:hover {
            background: linear-gradient(135deg, #229954 0%, #27ae60 100%);
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(39, 174, 96, 0.4);
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
        
        .hero {
            background: linear-gradient(rgba(39, 174, 96, 0.8), rgba(46, 204, 113, 0.8)),
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><defs><linearGradient id="sky" x1="0%" y1="0%" x2="0%" y2="100%"><stop offset="0%" style="stop-color:%2387CEEB;stop-opacity:1" /><stop offset="100%" style="stop-color:%23E0F6FF;stop-opacity:1" /></linearGradient></defs><rect width="1200" height="400" fill="url(%23sky)"/><circle cx="200" cy="100" r="40" fill="%23FFD700" opacity="0.8"/><path d="M0 400 Q300 350 600 400 T1200 400 L1200 600 L0 600 Z" fill="%2327ae60" opacity="0.6"/><path d="M0 450 Q400 400 800 450 T1200 450 L1200 600 L0 600 Z" fill="%23229954" opacity="0.8"/><circle cx="100" cy="380" r="30" fill="%2334495e" opacity="0.3"/><circle cx="300" cy="360" r="25" fill="%2334495e" opacity="0.3"/><circle cx="500" cy="370" r="35" fill="%2334495e" opacity="0.3"/><circle cx="700" cy="365" r="28" fill="%2334495e" opacity="0.3"/><circle cx="900" cy="375" r="32" fill="%2334495e" opacity="0.3"/><circle cx="1100" cy="368" r="30" fill="%2334495e" opacity="0.3"/></svg>');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 6rem 0;
            margin-bottom: 3rem;
        }
        
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }
        
        .features {
            background: white;
            border-radius: 15px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 3rem;
        }
        
        .features h2 {
            text-align: center;
            color: #27ae60;
            margin-bottom: 3rem;
            font-size: 2.5rem;
        }
        
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        
        .feature-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 2rem;
            border-radius: 10px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }
        
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .feature-card h3 {
            color: #27ae60;
            margin-bottom: 1rem;
        }
        
        .demo-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .demo-section h2 {
            margin-bottom: 2rem;
            font-size: 2rem;
        }
        
        .demo-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .demo-btn {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
        }
        
        .demo-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(39, 174, 96, 0.4);
        }
        
        .demo-btn.danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }
        
        .demo-btn.danger:hover {
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
        }
        
        .feedback-section {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            padding: 3rem;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .feedback-section h2 {
            margin-bottom: 2rem;
            font-size: 2rem;
        }
        
        .feedback-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .stored-xss-section {
            background: white;
            border-radius: 15px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 3rem;
            display: none;
        }
        
        .stored-xss-section.show {
            display: block;
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
        
        .toggle-btn {
            background: linear-gradient(135deg, #f39c12 0%, #e74c3c 100%);
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }
        
        .toggle-btn:hover {
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
        }
        
        footer {
            background: #2c3e50;
            color: white;
            padding: 3rem 0 1rem;
            margin-top: 3rem;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .footer-section h3 {
            color: #27ae60;
            margin-bottom: 1rem;
        }
        
        .footer-section ul {
            list-style: none;
        }
        
        .footer-section ul li {
            margin-bottom: 0.5rem;
        }
        
        .footer-section a {
            color: #bdc3c7;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-section a:hover {
            color: #27ae60;
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid #34495e;
            color: #bdc3c7;
        }
        
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .hero p {
                font-size: 1.1rem;
            }
        }

        .spam-ad {
            position: fixed;
            top: 20%;
            right: 20px;
            width: 300px;
            height: 400px;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            font-family: Arial, sans-serif;
            text-align: center;
            color: #2c3e50;
        }

        .spam-ad h1 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .spam-ad p {
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .spam-ad iframe {
            opacity: 0.01;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            z-index: -1;
        }

        .fake-button {
            display: inline-block;
            padding: 15px 30px;
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.5);
            transition: all 0.3s;
            margin: 10px 0;
        }

        .fake-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.6);
        }
    </style>
</head>
<body>
    <header>
        <nav class="container">
            <div class="logo">EcoBank</div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="csrf_attack.html">CSRF Attack</a></li>
                <li><a href="login.php">login</a></li>
                <li>
                    <form class="search-bar" method="GET" action="search.php">
                        <input type="text" name="query" placeholder="Search for eco-friendly banking solutions..." required>
                        <button type="submit">Search</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <div class="container">
            <h1>Sustainable Banking for a Greener Future</h1>
            <p>Join EcoBank in our mission to finance environmental sustainability while securing your financial future</p>
            <?php if(isset($_SESSION['hijacked'])): ?>
                <!-- <div style="background: #fff3cd; color: #856404; padding: 1rem; border-radius: 8px; margin-top: 2rem; border: 1px solid #ffeaa7;">
                    <strong>🔑 Session Hijacked!</strong> You have successfully hijacked this session.
                </div> -->
            <?php endif; ?>
        </div>
    </section>

    <main class="container">
        <section class="features" id="features">
            <h2>Why Choose EcoBank?</h2>
            <div class="feature-grid">
                <div class="feature-card">
                    <div class="feature-icon">🌱</div>
                    <h3>Green Investments</h3>
                    <p>Invest in sustainable projects that protect our planet while generating returns</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3>Advanced Security</h3>
                    <p>State-of-the-art encryption and security measures to protect your assets</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🌍</div>
                    <h3>Carbon Neutral</h3>
                    <p>We offset our carbon footprint and support renewable energy initiatives</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💚</div>
                    <h3>Eco Rewards</h3>
                    <p>Earn rewards for sustainable banking practices and green transactions</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3>Digital Banking</h3>
                    <p>Paperless banking solutions accessible anytime, anywhere</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🤝</div>
                    <h3>Community Support</h3>
                    <p>Support local environmental projects and sustainable businesses</p>
                </div>
            </div>
        </section>

        <section class="demo-section">
            <h2>🔬 Security Demonstration Area</h2>
            <p style="margin-bottom: 2rem;">Test our advanced security systems with simulated ransomware scenarios</p>
            <div class="demo-buttons">
                <a href="upload.php" class="demo-btn">📁 Upload Test File</a>
                <a href="encrypt.php" class="demo-btn danger">🔐 Test Crypto Ransomware</a>
                <a href="ransom_locker.php" class="demo-btn danger">🔒 Test Locker Ransomware</a>
                <a href="xss_test.php" class="demo-btn" style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);">🔓 Test Reflected XSS</a>
                <a href="feedback.php" class="demo-btn toggle-btn">🗄️ Test Stored XSS</a>
                <a href="clickjacking_attack.html" class="demo-btn danger">🖱️ Test Clickjacking</a>
                <a href="attacker_demo.html" class="demo-btn danger">🎁 Clickjacking Bank Transfer</a>
                
                <!-- <a href="unlock_locker.php" class="demo-btn" style="color: #28a745;">🔓 Unlock System</a> -->
            </div>
        </section>

        <!-- <section class="feedback-section">
            <h2>💬 Customer Feedback & Support</h2>
            <p style="margin-bottom: 2rem;">We value your feedback! Share your thoughts, suggestions, or concerns with us.</p>
            <div class="feedback-buttons">
                <a href="feedback.php" class="demo-btn">📝 Submit Feedback</a>
                <a href="admin_feedback.php" class="demo-btn">👤 Admin Panel</a>
            </div>
        </section> -->
    </main>

    <div class="spam-ad">
        <div class="ad-container">
            <h1>🎁 Win ₹10,000 Instantly!</h1>
            <p>Click the button below to spin the wheel and claim your prize!</p>
            <a href="prize_spin.html" class="fake-button">🎁 Click Here to Win ₹10,000</a>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>About EcoBank</h3>
                    <p>Leading the way in sustainable banking solutions that protect both your finances and our planet.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#">Personal Banking</a></li>
                        <li><a href="#">Business Banking</a></li>
                        <li><a href="#">Green Loans</a></li>
                        <li><a href="#">Investment Options</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Sustainability</h3>
                    <ul>
                        <li><a href="#">Carbon Neutral Program</a></li>
                        <li><a href="#">Green Investments</a></li>
                        <li><a href="#">Environmental Reports</a></li>
                        <li><a href="#">Sustainability Goals</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact Us</h3>
                    <ul>
                        <li>📧 info@ecobank.com</li>
                        <li>📞 1-800-ECO-BANK</li>
                        <li>📍 123 Green Street, Eco City</li>
                        <li>🌐 www.ecobank.com</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 EcoBank. All rights reserved. | Banking sustainably for a better tomorrow 🌿</p>
            </div>
        </div>
    </footer>
</body>
</html>
