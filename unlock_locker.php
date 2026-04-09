<?php
session_start();
$_SESSION['locked'] = false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Unlocked - EcoBank</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
            width: 100%;
        }
        
        .success-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .success-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #27ae60, #2ecc71, #27ae60);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }
        
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        
        .success-icon {
            font-size: 5rem;
            margin-bottom: 2rem;
            animation: bounce 1s ease-in-out;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-20px); }
            60% { transform: translateY(-10px); }
        }
        
        .success-title {
            font-size: 2.5rem;
            color: #27ae60;
            margin-bottom: 1rem;
            font-weight: bold;
        }
        
        .success-message {
            font-size: 1.3rem;
            color: #555;
            margin-bottom: 2rem;
            line-height: 1.8;
        }
        
        .payment-details {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            border-left: 5px solid #27ae60;
        }
        
        .payment-details h3 {
            color: #27ae60;
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }
        
        .payment-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            text-align: left;
        }
        
        .payment-item {
            padding: 1rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .payment-item strong {
            color: #27ae60;
            display: block;
            margin-bottom: 0.5rem;
        }
        
        .system-status {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }
        
        .system-status h4 {
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }
        
        .status-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .status-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
        }
        
        .status-item .status-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        
        .home-btn {
            display: inline-block;
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            padding: 1.2rem 3rem;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 8px 25px rgba(39, 174, 96, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .home-btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .home-btn:hover::before {
            left: 100%;
        }
        
        .home-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(39, 174, 96, 0.4);
        }
        
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: #27ae60;
            margin-bottom: 2rem;
        }
        
        .logo::before {
            content: "🌿";
            margin-right: 10px;
            font-size: 2rem;
        }
        
        @media (max-width: 768px) {
            .success-card {
                padding: 2rem;
                margin: 1rem;
            }
            
            .success-title {
                font-size: 2rem;
            }
            
            .success-message {
                font-size: 1.1rem;
            }
            
            .payment-info {
                grid-template-columns: 1fr;
            }
            
            .status-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-card">
            <div class="logo">EcoBank</div>
            
            <div class="success-icon">🔓</div>
            <h1 class="success-title">System Unlocked!</h1>
            <p class="success-message">
                Payment successful! Your system has been unlocked.<br>
                All banking services are now fully accessible.
            </p>
            
            <div class="payment-details">
                <h3>🔐 Transaction Details</h3>
                <div class="payment-info">
                    <div class="payment-item">
                        <strong>Transaction ID</strong>
                        #TX-<?php echo date('Y') . '-' . strtoupper(substr(md5(time()), 0, 8)); ?>
                    </div>
                    <div class="payment-item">
                        <strong>Amount Paid</strong>
                        2.0 BTC
                    </div>
                    <div class="payment-item">
                        <strong>Status</strong>
                        <span style="color: #27ae60;">✅ Completed</span>
                    </div>
                    <div class="payment-item">
                        <strong>Time</strong>
                        <?php echo date('Y-m-d H:i:s'); ?>
                    </div>
                </div>
            </div>
            
            <div class="system-status">
                <h4>🖥️ System Status</h4>
                <p>All systems are now operational and secure</p>
                <div class="status-grid">
                    <div class="status-item">
                        <div class="status-icon">🔒</div>
                        <strong>Security</strong><br>
                        <span style="color: #2ecc71;">Active</span>
                    </div>
                    <div class="status-item">
                        <div class="status-icon">💾</div>
                        <strong>Data</strong><br>
                        <span style="color: #2ecc71;">Protected</span>
                    </div>
                    <div class="status-item">
                        <div class="status-icon">🌐</div>
                        <strong>Network</strong><br>
                        <span style="color: #2ecc71;">Online</span>
                    </div>
                    <div class="status-item">
                        <div class="status-icon">🏦</div>
                        <strong>Banking</strong><br>
                        <span style="color: #2ecc71;">Available</span>
                    </div>
                </div>
            </div>
            
            <a href="index.php" class="home-btn">🏠 Return to Banking Portal</a>
        </div>
    </div>
</body>
</html>
