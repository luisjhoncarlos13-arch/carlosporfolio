<?php
/**
 * Administrator Login View (login.php)
 * Authenticates user credentials for portfolio administration.
 * 
 * Credentials:
 * Username: johncarlos
 * Password: johncarlos123
 */

session_start();

// If already logged in, redirect to admin dashboard
if (!empty($_SESSION['admin_logged_in'])) {
    header('Location: admin.php');
    exit;
}

require_once __DIR__ . '/db.php';

$error = '';
$username_input = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username_input = trim($_POST['username'] ?? '');
    $password_input = trim($_POST['password'] ?? '');

    // 1. Direct verified credentials check
    if ($username_input === 'johncarlos' && $password_input === 'johncarlos123') {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user']      = 'johncarlos';
        $_SESSION['admin_name']      = 'John Luis Carlos';
        $_SESSION['login_time']      = time();

        header('Location: admin.php');
        exit;
    }

    // 2. MySQL database check if table exists
    $pdo = getDbConnection();
    if ($pdo && isDbConnected()) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM `admin_users` WHERE `username` = :u LIMIT 1");
            $stmt->execute(['u' => $username_input]);
            $user = $stmt->fetch();
            if ($user && (password_verify($password_input, $user['password']) || $password_input === $user['password'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_user']      = $user['username'];
                $_SESSION['admin_name']      = 'John Luis Carlos';
                $_SESSION['login_time']      = time();

                header('Location: admin.php');
                exit;
            }
        } catch (PDOException $e) {
            // fallback handled
        }
    }

    $error = 'Invalid username or password. Please try again.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal Login | John Luis Carlos</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Orbitron:wght@600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Primary CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        .login-page-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 24px;
            background: radial-gradient(circle at 50% 20%, rgba(0, 243, 255, 0.08) 0%, #060913 70%);
            position: relative;
        }

        .login-back-bar {
            position: absolute;
            top: 24px;
            left: 24px;
        }

        .login-card {
            background: rgba(10, 16, 32, 0.85);
            border: 1px solid rgba(0, 243, 255, 0.25);
            border-radius: 20px;
            max-width: 440px;
            width: 100%;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.7), 0 0 30px rgba(0, 243, 255, 0.1);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--neon-blue), transparent);
        }

        .login-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .login-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(0, 243, 255, 0.1);
            border: 1px solid rgba(0, 243, 255, 0.25);
            color: var(--neon-blue);
            font-family: var(--font-code);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            padding: 4px 12px;
            border-radius: 999px;
            margin-bottom: 12px;
            text-transform: uppercase;
        }

        .login-title {
            font-family: var(--font-heading);
            font-size: 1.7rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 6px;
        }

        .login-title span {
            color: var(--neon-blue);
            text-shadow: 0 0 15px rgba(0, 243, 255, 0.6);
        }

        .login-subtitle {
            color: var(--text-secondary);
            font-size: 0.88rem;
        }

        .login-credentials-pill {
            background: rgba(0, 243, 255, 0.04);
            border: 1px dashed rgba(0, 243, 255, 0.25);
            border-radius: 10px;
            padding: 12px 14px;
            margin-bottom: 24px;
            font-family: var(--font-code);
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .cred-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .cred-item:last-child {
            margin-bottom: 0;
        }

        .cred-val {
            color: var(--neon-blue);
            font-weight: 600;
        }

        .login-error-alert {
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.35);
            color: #fca5a5;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group label {
            display: block;
            font-family: var(--font-code);
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--neon-cyan);
            letter-spacing: 1px;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .input-field-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            color: var(--text-muted);
            pointer-events: none;
        }

        .login-input {
            width: 100%;
            background: rgba(6, 10, 24, 0.8);
            border: 1px solid rgba(0, 243, 255, 0.18);
            border-radius: 10px;
            padding: 12px 14px 12px 42px;
            color: #fff;
            font-family: inherit;
            font-size: 0.95rem;
            transition: all 0.25s ease;
        }

        .login-input:focus {
            outline: none;
            border-color: var(--neon-blue);
            box-shadow: 0 0 15px rgba(0, 243, 255, 0.25);
            background: rgba(6, 10, 24, 0.95);
        }

        .btn-toggle-pw {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-toggle-pw:hover {
            color: var(--neon-blue);
        }

        .btn-login-submit {
            width: 100%;
            margin-top: 8px;
            padding: 14px;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>

    <div class="login-page-wrapper">
        <div class="login-back-bar">
            <a href="index.php" class="btn btn-outline" style="padding:8px 16px; font-size:0.85rem;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
                Back to Portfolio
            </a>
        </div>

        <div class="login-card">
            <div class="login-header">
                <div class="login-badge">
                    <span class="pulse-dot"></span>
                    <span>RESTRICTED ACCESS</span>
                </div>
                <h1 class="login-title">Admin <span>Portal</span></h1>
                <p class="login-subtitle">Sign in to manage portfolio messages and database records.</p>
            </div>

            <!-- Credentials Hint Pill -->

            <?php if (!empty($error)): ?>
                <div class="login-error-alert">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['logged_out'])): ?>
                <div class="login-error-alert" style="background:rgba(0,243,255,0.08); border-color:rgba(0,243,255,0.25); color:var(--neon-blue);">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    <span>You have been logged out securely.</span>
                </div>
            <?php endif; ?>

            <form method="POST" action="login.php">
                <div class="input-group">
                    <label for="username">Username</label>
                    <div class="input-field-wrapper">
                        <svg class="input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <input type="text" id="username" name="username" class="login-input" value="<?= htmlspecialchars($username_input ?: 'johncarlos') ?>" placeholder="Enter username" required autofocus>
                    </div>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="input-field-wrapper">
                        <svg class="input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <input type="password" id="password" name="password" class="login-input" value="johncarlos123" placeholder="Enter password" required>
                        <button type="button" class="btn-toggle-pw" onclick="togglePasswordVisibility()" aria-label="Toggle password visibility">
                            <svg id="eyeIcon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-neon btn-login-submit" id="loginSubmitBtn">
                    Authenticate &amp; Enter ⚡
                </button>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            var pwInput = document.getElementById('password');
            if (pwInput.type === 'password') {
                pwInput.type = 'text';
            } else {
                pwInput.type = 'password';
            }
        }
    </script>
</body>
</html>
