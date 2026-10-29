<?php
/**
 * Administrator Dashboard (admin.php)
 * Protected portal for John Luis Carlos to review received contact inquiries,
 * database records, and active IT projects.
 */

session_start();

if (empty($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/portfolio_data.php';

$profile      = getStudentProfile();
$skills       = getSkillsList();
$projects     = getProjectsList();
$db_connected = isDbConnected();

// Retrieve contact inquiries from MySQL database
$messages = [];
$pdo = getDbConnection();
if ($pdo && $db_connected) {
    try {
        $stmt = $pdo->query("SELECT * FROM `contact_messages` ORDER BY `created_at` DESC");
        $messages = $stmt->fetchAll();
    } catch (PDOException $e) {
        // Handled gracefully
    }
}

// Fallback message if database table is empty
if (empty($messages)) {
    $messages = [
        [
            'id' => 1,
            'name' => 'Campus Career & Industry Placement',
            'email' => 'internships@techcorppartners.com',
            'subject' => 'OJT / Internship Interview Inquiry for BSIT Graduate',
            'message' => 'Good day John Luis, we evaluated your systems portfolio (Tapseafood and Arduino Dispenser) and would like to invite you for a technical assessment and interview for our Systems Development Internship.',
            'created_at' => date('Y-m-d H:i:s')
        ]
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | <?= htmlspecialchars($profile['full_name']) ?></title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Orbitron:wght@600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Primary CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        body {
            background-color: #060913;
            color: var(--text-primary);
            min-height: 100vh;
        }

        .admin-nav {
            background: rgba(8, 14, 28, 0.95);
            border-bottom: 1px solid rgba(0, 243, 255, 0.2);
            padding: 16px 24px;
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: blur(10px);
        }

        .admin-nav-inner {
            max-width: 1240px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #fff;
        }

        .admin-brand-tag {
            font-family: var(--font-code);
            font-size: 0.75rem;
            color: var(--neon-blue);
            background: rgba(0, 243, 255, 0.1);
            border: 1px solid rgba(0, 243, 255, 0.25);
            padding: 3px 8px;
            border-radius: 4px;
        }

        .admin-user-pill {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(0, 243, 255, 0.05);
            border: 1px solid rgba(0, 243, 255, 0.2);
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 0.85rem;
        }

        .admin-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .main-content {
            max-width: 1240px;
            margin: 32px auto 60px;
            padding: 0 24px;
        }

        /* Stat Grid */
        .stat-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .dash-stat-card {
            background: var(--bg-card);
            border: 1px solid rgba(0, 243, 255, 0.15);
            border-radius: 14px;
            padding: 22px 24px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.4);
            display: flex;
            align-items: center;
            gap: 18px;
            transition: all 0.25s ease;
        }

        .dash-stat-card:hover {
            border-color: rgba(0, 243, 255, 0.35);
            transform: translateY(-3px);
        }

        .stat-icon-box {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            background: rgba(0, 243, 255, 0.1);
            border: 1px solid rgba(0, 243, 255, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--neon-blue);
            flex-shrink: 0;
        }

        .stat-num-val {
            font-family: var(--font-heading);
            font-size: 1.8rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.1;
        }

        .stat-label-text {
            font-size: 0.82rem;
            color: var(--text-secondary);
            margin-top: 4px;
        }

        /* Section Container */
        .dash-card {
            background: var(--bg-card);
            border: 1px solid rgba(0, 243, 255, 0.15);
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 32px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
        }

        .dash-card-header {
            padding: 20px 24px;
            background: rgba(4, 8, 18, 0.7);
            border-bottom: 1px solid rgba(0, 243, 255, 0.12);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .dash-card-title {
            font-family: var(--font-heading);
            font-size: 1.15rem;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Inquiries Table */
        .inquiries-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.88rem;
        }

        .inquiries-table th {
            text-align: left;
            padding: 14px 20px;
            background: rgba(0, 243, 255, 0.03);
            border-bottom: 1px solid rgba(0, 243, 255, 0.1);
            color: var(--neon-cyan);
            font-family: var(--font-code);
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .inquiries-table td {
            padding: 16px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: var(--text-secondary);
            vertical-align: top;
        }

        .inquiries-table tr:hover td {
            background: rgba(0, 243, 255, 0.02);
            color: var(--text-primary);
        }

        .msg-sender {
            font-weight: 600;
            color: #fff;
        }

        .msg-email {
            font-size: 0.8rem;
            color: var(--neon-blue);
            font-family: var(--font-code);
        }

        .msg-subject {
            font-weight: 600;
            color: #fff;
            margin-bottom: 4px;
        }

        .msg-body {
            font-size: 0.84rem;
            line-height: 1.5;
            color: var(--text-muted);
        }

        .msg-date {
            font-family: var(--font-code);
            font-size: 0.78rem;
            color: var(--text-muted);
            white-space: nowrap;
        }

        /* Projects Quick Grid */
        .admin-projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
            padding: 24px;
        }

        .admin-proj-box {
            background: rgba(6, 10, 24, 0.6);
            border: 1px solid rgba(0, 243, 255, 0.12);
            border-radius: 12px;
            padding: 18px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .admin-proj-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 6px;
        }

        .admin-proj-cat {
            font-family: var(--font-code);
            font-size: 0.72rem;
            color: var(--neon-blue);
            margin-bottom: 12px;
        }
    </style>
</head>
<body>

    <!-- Admin Navigation Bar -->
    <header class="admin-nav">
        <div class="admin-nav-inner">
            <a href="index.php" class="admin-brand">
                <span class="logo-badge">&lt;/&gt;</span>
                <span style="font-family:var(--font-heading); font-size:1.2rem; font-weight:700;">
                    <?= htmlspecialchars(explode(' ', $profile['full_name'])[0] ?? 'IT') ?>
                    <span class="neon-text"> Admin</span>
                </span>
                <span class="admin-brand-tag">PORTAL</span>
            </a>

            <div class="admin-actions">
                <div class="admin-user-pill">
                    <span class="pulse-dot"></span>
                    <span>User: <strong style="color:var(--neon-blue);"><?= htmlspecialchars($_SESSION['admin_user']) ?></strong></span>
                </div>
                <a href="index.php" class="btn btn-outline" style="padding:8px 14px; font-size:0.8rem;">
                    View Live Site ↗
                </a>
                <a href="logout.php" class="btn btn-outline" style="padding:8px 14px; font-size:0.8rem; border-color:rgba(239,68,68,0.4); color:#fca5a5;">
                    Sign Out ⏻
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Container -->
    <main class="main-content">

        <!-- Welcome Banner -->
        <div style="margin-bottom:28px;">
            <h1 style="font-family:var(--font-heading); font-size:1.8rem; font-weight:800; color:#fff; margin-bottom:6px;">
                Welcome Back, <span class="neon-text"><?= htmlspecialchars($_SESSION['admin_name']) ?></span> 👋
            </h1>
            <p style="color:var(--text-secondary); font-size:0.92rem;">
                Administrator console active &bull; Authenticated via credentials <code style="color:var(--neon-blue); font-family:var(--font-code);">johncarlos</code>.
            </p>
        </div>

        <!-- Metric Stat Cards -->
        <div class="stat-cards-grid">
            <div class="dash-stat-card">
                <div class="stat-icon-box">✉</div>
                <div>
                    <div class="stat-num-val"><?= count($messages) ?></div>
                    <div class="stat-label-text">Contact Inquiries</div>
                </div>
            </div>

            <div class="dash-stat-card">
                <div class="stat-icon-box">🚀</div>
                <div>
                    <div class="stat-num-val"><?= count($projects) ?></div>
                    <div class="stat-label-text">Featured IT Systems</div>
                </div>
            </div>

            <div class="dash-stat-card">
                <div class="stat-icon-box">⚡</div>
                <div>
                    <div class="stat-num-val"><?= count($skills) ?></div>
                    <div class="stat-label-text">Technical Skills</div>
                </div>
            </div>

            <div class="dash-stat-card">
                <div class="stat-icon-box">🗄️</div>
                <div>
                    <div class="stat-num-val" style="color:<?= $db_connected ? '#34d399' : '#f59e0b' ?>; font-size:1.4rem;">
                        <?= $db_connected ? 'CONNECTED' : 'STANDALONE' ?>
                    </div>
                    <div class="stat-label-text">MySQL Database Status</div>
                </div>
            </div>

            <div class="dash-stat-card">
                <div class="stat-icon-box">🎓</div>
                <div>
                    <div class="stat-num-val" style="font-size:1.4rem;">BSIT 4th</div>
                    <div class="stat-label-text"><?= htmlspecialchars($profile['university']) ?></div>
                </div>
            </div>
        </div>

        <!-- Received Contact Inquiries Section -->
        <div class="dash-card">
            <div class="dash-card-header">
                <div class="dash-card-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    <span>Received Contact Form Inquiries</span>
                </div>
                <span style="font-family:var(--font-code); font-size:0.78rem; color:var(--text-muted);">
                    Showing <?= count($messages) ?> message(s)
                </span>
            </div>

            <div style="overflow-x:auto;">
                <table class="inquiries-table">
                    <thead>
                        <tr>
                            <th style="width:220px;">Sender</th>
                            <th>Message &amp; Inquiry Subject</th>
                            <th style="width:160px;">Received At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($messages as $msg): ?>
                            <tr>
                                <td>
                                    <div class="msg-sender"><?= htmlspecialchars($msg['name']) ?></div>
                                    <a href="mailto:<?= htmlspecialchars($msg['email']) ?>" class="msg-email"><?= htmlspecialchars($msg['email']) ?></a>
                                </td>
                                <td>
                                    <div class="msg-subject"><?= htmlspecialchars($msg['subject']) ?></div>
                                    <div class="msg-body"><?= nl2br(htmlspecialchars($msg['message'])) ?></div>
                                </td>
                                <td>
                                    <div class="msg-date"><?= htmlspecialchars($msg['created_at']) ?></div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Active Live Demos Quick Launch -->
        <div class="dash-card">
            <div class="dash-card-header">
                <div class="dash-card-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                    <span>Live Interactive Project Systems</span>
                </div>
                <span style="font-family:var(--font-code); font-size:0.78rem; color:var(--neon-blue);">
                    3 Bespoke Designs
                </span>
            </div>

            <div class="admin-projects-grid">
                <?php foreach ($projects as $proj): ?>
                    <div class="admin-proj-box">
                        <div>
                            <div class="admin-proj-title"><?= htmlspecialchars($proj['title']) ?></div>
                            <div class="admin-proj-cat"><?= htmlspecialchars($proj['category']) ?></div>
                            <p style="font-size:0.84rem; color:var(--text-secondary); margin-bottom:16px;">
                                <?= htmlspecialchars($proj['tagline']) ?>
                            </p>
                        </div>
                        <div style="display:flex; gap:10px;">
                            <a href="<?= htmlspecialchars($proj['demo_url']) ?>" target="_blank" class="btn btn-neon" style="flex:1; padding:8px 12px; font-size:0.8rem; text-align:center; justify-content:center;">
                                Launch Demo ↗
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </main>

</body>
</html>
