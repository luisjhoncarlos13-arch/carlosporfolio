<?php
/**
 * 1-Click Database Setup Utility (setup.php)
 * Creates the `student_portfolio` database and tables from database.sql.
 * 
 * Styled in the signature Neon Blue theme.
 */

$db_host = 'localhost';
$db_port = '3306';
$db_user = 'root';
$db_pass = '';
$sql_file = __DIR__ . '/database.sql';

$status_log = [];
$setup_success = false;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_GET['auto'])) {
    try {
        if (!file_exists($sql_file)) {
            throw new Exception("database.sql file not found at " . $sql_file);
        }

        // Connect to MySQL server without choosing database first
        $pdo = new PDO("mysql:host={$db_host};port={$db_port};charset=utf8mb4", $db_user, $db_pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        $status_log[] = "Connected to MySQL server ({$db_host}:{$db_port}) as user '{$db_user}'.";

        // Read SQL script
        $sql_content = file_get_contents($sql_file);
        
        // Split SQL statements by semicolon while ignoring comments
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `student_portfolio` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
        $status_log[] = "Database `student_portfolio` verified/created successfully.";
        
        $pdo->exec("USE `student_portfolio`;");
        $status_log[] = "Active database switched to `student_portfolio`.";

        // Execute bulk queries
        $pdo->exec($sql_content);
        $status_log[] = "Executed all tables, schemas, and sample IT student seed data!";

        // Count items
        $tables = ['profile_info', 'skills', 'projects', 'contact_messages', 'admin_users'];
        foreach ($tables as $table) {
            $count = $pdo->query("SELECT COUNT(*) FROM `{$table}`")->fetchColumn();
            $status_log[] = "Table `{$table}` initialized with {$count} records.";
        }

        $setup_success = true;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup | IT Student Portfolio (Neon Blue)</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Orbitron:wght@500;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --neon-blue: #00f3ff;
            --neon-glow: rgba(0, 243, 255, 0.4);
            --neon-cyan: #00d2ff;
            --dark-bg: #070b14;
            --card-bg: rgba(14, 22, 38, 0.85);
            --border-glow: rgba(0, 243, 255, 0.3);
            --text-main: #f0f6fc;
            --text-muted: #8b9bb4;
            --success: #00ffaa;
            --danger: #ff4d6d;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--dark-bg);
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(0, 243, 255, 0.08) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(0, 112, 243, 0.08) 0%, transparent 40%);
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .setup-card {
            background: var(--card-bg);
            border: 1px solid var(--border-glow);
            border-radius: 16px;
            box-shadow: 0 0 30px rgba(0, 243, 255, 0.15);
            backdrop-filter: blur(16px);
            width: 100%;
            max-width: 640px;
            padding: 36px;
            position: relative;
            overflow: hidden;
        }

        .setup-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #00f3ff, #0070f3, #00f3ff);
            box-shadow: 0 0 12px var(--neon-blue);
        }

        .brand-title {
            font-family: 'Orbitron', monospace;
            font-size: 1.6rem;
            color: var(--neon-blue);
            text-shadow: 0 0 10px var(--neon-glow);
            letter-spacing: 1px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-subtitle {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        .info-box {
            background: rgba(0, 243, 255, 0.05);
            border-left: 3px solid var(--neon-blue);
            padding: 14px 16px;
            border-radius: 6px;
            margin-bottom: 24px;
            font-size: 0.9rem;
        }

        .info-box code {
            color: var(--neon-blue);
            font-family: 'JetBrains Mono', monospace;
            background: rgba(0, 243, 255, 0.1);
            padding: 2px 6px;
            border-radius: 4px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--neon-blue), #0070f3);
            color: #070b14;
            font-weight: 700;
            font-size: 1rem;
            padding: 14px 28px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 0 20px var(--neon-glow);
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba(0, 243, 255, 0.7);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.08);
            color: var(--neon-blue);
            border: 1px solid var(--border-glow);
            box-shadow: none;
            margin-top: 12px;
        }

        .btn-secondary:hover {
            background: rgba(0, 243, 255, 0.15);
            border-color: var(--neon-blue);
            box-shadow: 0 0 15px var(--neon-glow);
        }

        .logs {
            background: #030712;
            border: 1px solid rgba(0, 243, 255, 0.2);
            border-radius: 8px;
            padding: 16px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
            max-height: 220px;
            overflow-y: auto;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .log-item {
            color: var(--success);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .log-item::before {
            content: '✓';
            color: var(--neon-blue);
            font-weight: bold;
        }

        .error-box {
            background: rgba(255, 77, 109, 0.1);
            border: 1px solid var(--danger);
            color: #ff94a5;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="setup-card">
    <div class="brand-title">
        <span>⚡</span> SQL DATABASE SETUP
    </div>
    <p class="brand-subtitle">
        Automated database installer for the IT Student Portfolio. Initializes the <code>student_portfolio</code> database, all tables, and sample data.
    </p>

    <div class="info-box">
        <strong>Database:</strong> <code>student_portfolio</code><br>
        <strong>Host:</strong> <code>localhost:3306</code> (Default XAMPP MySQL)<br>
        <strong>Architecture:</strong> All SQL statements are cleanly isolated in <code>portfolio_data.php</code> and <code>database.sql</code> (Zero SQL in <code>index.php</code>).
    </div>

    <?php if ($error): ?>
        <div class="error-box">
            <strong>Initialization Error:</strong><br>
            <?= htmlspecialchars($error) ?>
            <p style="margin-top: 10px; font-size: 0.85rem; color: #f0f6fc;">
                Please ensure MySQL is running in your <strong>XAMPP Control Panel</strong>.
            </p>
        </div>
    <?php endif; ?>

    <?php if ($setup_success): ?>
        <div class="logs">
            <?php foreach ($status_log as $log): ?>
                <div class="log-item"><?= htmlspecialchars($log) ?></div>
            <?php endforeach; ?>
        </div>

        <a href="index.php" class="btn">🚀 Open Neon Blue Portfolio</a>
    <?php else: ?>
        <form method="POST">
            <button type="submit" class="btn">⚡ Click Here to Initialize Database</button>
        </form>
        <a href="index.php" class="btn btn-secondary">Preview Portfolio (Uses Built-in Data)</a>
    <?php endif; ?>
</div>

</body>
</html>
