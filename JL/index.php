<?php
/**
 * IT Student Portfolio - Main Presentation View
 * 
 * ARCHITECTURAL DESIGN REQUIREMENT:
 * Zero SQL queries are present in this file!
 * All database operations and queries are encapsulated in portfolio_data.php.
 */

require_once __DIR__ . '/portfolio_data.php';

// Retrieve data through the Data Access Layer (NO SQL in index.php)
$profile      = getStudentProfile();
$skills       = getSkillsList();
$projects     = getProjectsList();
$db_connected = isDbConnected();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($profile['headline']) ?> - IT Student Portfolio featuring Tapseafood, Hotel Booking, and Arduino Systems.">
    <title><?= htmlspecialchars($profile['full_name']) ?> | IT Student Portfolio (Neon Blue)</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Orbitron:wght@500;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Neon Blue Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- ========================================================
         TOP NAVIGATION BAR
         ======================================================== -->
    <nav class="navbar" id="navbar">
        <div class="container nav-container">
            <a href="#hero" class="logo" id="brand-logo">
                <span class="logo-badge">&lt;/&gt;</span>
                <span><?= htmlspecialchars(explode(' ', $profile['full_name'])[0] ?? 'IT') ?><span class="neon-text"> Carlos</span></span>
            </a>

            <!-- Mobile Toggle Button -->
            <button class="mobile-toggle" id="mobile-toggle" aria-label="Toggle navigation menu">☰</button>

            <!-- Navigation Links -->
            <ul class="nav-links" id="nav-links">
                <li><a href="#hero" class="nav-link active">Home</a></li>
                <li><a href="#about" class="nav-link">About</a></li>
                <li><a href="#skills" class="nav-link">Skills</a></li>
                <li><a href="#projects" class="nav-link">Projects</a></li>
                <li><a href="#interview" class="nav-link">Interview</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
                <li><a href="login.php" class="nav-link nav-link-login" title="Admin Portal"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="vertical-align:baseline; margin-right:4px;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>Login</a></li>
                <li>
                    <?php if ($db_connected): ?>
                      
                    <?php else: ?>
                        <a href="setup.php" class="db-pill disconnected" title="Click to initialize MySQL database">
                            <span class="pulse-dot"></span> Setup MySQL
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>

    <!-- ========================================================
         HERO SECTION (With Profile Picture)
         ======================================================== -->
    <section class="hero" id="hero">
        <div class="container">
            <div class="hero-grid">
                <div class="hero-content">
                    <div class="status-badge">
                        <span class="pulse-dot"></span>
                        <span><?= htmlspecialchars($profile['status_badge']) ?></span>
                    </div>

                    <h2 class="hero-subtitle"><?= htmlspecialchars($profile['university']) ?></h2>
                    
                    <h1 class="hero-title">
                        Hi, I'm <span class="neon-text"><?= htmlspecialchars($profile['full_name']) ?></span><br>
                        <span class="hero-dynamic-text" id="dynamic-text">IT Student</span>
                    </h1>

                    <p class="hero-desc">
                        <?= htmlspecialchars($profile['sub_headline']) ?>. <?= htmlspecialchars($profile['bio_summary']) ?>
                    </p>

                    <div class="hero-actions">
                        <a href="#projects" class="btn btn-neon" id="hero-projects-btn">View 3 Featured Projects 🚀</a>
                        <a href="#contact" class="btn btn-outline" id="hero-contact-btn">Get In Touch ✉</a>
                        <button type="button" class="btn btn-resume" id="resume-quick-view-btn" onclick="openResumeModal()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                            Quick View Resume
                        </button>
                        <?php if (!$db_connected): ?>
                            <a href="setup.php" class="btn btn-outline" style="border-style: dashed;" id="hero-setup-btn">⚡ 1-Click SQL Setup</a>
                        <?php endif; ?>
                    </div>

                    <div class="student-meta">
                        <div class="meta-item">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                            <span><?= htmlspecialchars($profile['degree_program']) ?></span>
                        </div>
                        <div class="meta-item">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span><?= htmlspecialchars($profile['location']) ?></span>
                        </div>
                    </div>
                </div>

                <!-- Hero Profile Picture with Glowing Cyber Ring -->
                <div class="hero-avatar-wrapper">
                    <div class="avatar-frame">
                        <?php $img_version = file_exists(__DIR__ . '/' . $profile['profile_image']) ? filemtime(__DIR__ . '/' . $profile['profile_image']) : time(); ?>
                        <img src="<?= htmlspecialchars($profile['profile_image']) ?>?v=<?= $img_version ?>" alt="<?= htmlspecialchars($profile['full_name']) ?>" class="avatar-img" id="profile-picture">
                        <div class="avatar-status-pill">
                            <span class="pulse-dot"></span>
                            <span>BSIT • 4th Year</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================
         ABOUT SECTION
         ======================================================== -->
    <section class="section" id="about">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">// 01. Profile Overview</span>
                <h2 class="section-title">About <span class="neon-text">Me</span></h2>
                <p class="section-desc">A deep dive into my IT system building focus, coursework application, and architectural standards.</p>
            </div>

            <div class="about-grid">
                <div class="about-card">
                    <h3 style="font-size: 1.4rem; margin-bottom: 16px; color: var(--text-primary);">
                        Aspiring IT Engineer &amp; Systems Builder
                    </h3>
                    <p class="about-text">
                        <?= nl2br(htmlspecialchars($profile['about_details'])) ?>
                    </p>

                    <!-- Clean Architecture Callout -->
                    <div class="arch-callout">
                        <div class="arch-icon">⚡</div>
                        <div class="arch-text">
                            <h4>Clean Architecture Notice</h4>
                            <p>All database queries and transactions are strictly isolated in <code>portfolio_data.php</code> and <code>database.sql</code>. Zero SQL statements are in <code>index.php</code>.</p>
                        </div>
                    </div>
                </div>

                <div class="stat-grid">
                    <div class="stat-box">
                        <div class="stat-num">3</div>
                        <div class="stat-label">Core IT Systems</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-num">4th</div>
                        <div class="stat-label">Year BSIT Student</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-num">100%</div>
                        <div class="stat-label">Touchless IoT Automation</div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================
         SKILLS SECTION (Crafted Same as Projects with Visual Preview Banners)
         ======================================================== -->
    <section class="section" id="skills">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">// 02. Technical Competencies</span>
                <h2 class="section-title">Core <span class="neon-text">Skills</span></h2>
                <p class="section-desc">Practical systems competencies and full-stack proficiencies backed by real-world implementations, relational database engineering, and certified technical training.</p>
            </div>

            <!-- Skill Filter Controls (Same to Project Filters) -->
            <div class="project-filters skill-filters" id="skill-filters">
                <button class="filter-btn active" data-filter="all">All Skills (<?= count($skills) ?>)</button>
                <button class="filter-btn" data-filter="Web & E-Commerce">Web &amp; E-Commerce</button>
                <button class="filter-btn" data-filter="Database Systems">Database Systems</button>
                <button class="filter-btn" data-filter="IoT & Embedded Systems">IoT &amp; Embedded Systems</button>
                <button class="filter-btn" data-filter="Networking & Hardware">Networking &amp; Hardware</button>
            </div>

            <!-- Skills Grid (Same to Projects Grid) -->
            <div class="projects-grid skills-grid" id="skills-container">
                <?php foreach ($skills as $skill): ?>
                    <div class="project-card skill-card" data-category="<?= htmlspecialchars($skill['category']) ?>">
                        <!-- Visual Header Preview Banner (Same to Project) -->
                        <div class="project-img-wrapper">
                            <img src="<?= htmlspecialchars($skill['image_url']) ?>" alt="<?= htmlspecialchars($skill['title']) ?>" class="project-img" loading="lazy">
                            <div class="project-img-overlay"></div>
                        </div>

                        <div class="project-body">
                            <div class="project-header">
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; gap:8px; flex-wrap:wrap;">
                                    <span class="project-cat-badge"><?= htmlspecialchars($skill['category']) ?></span>
                                    <span class="skill-pct-badge"><?= intval($skill['proficiency']) ?>% • <?= htmlspecialchars($skill['level_label']) ?></span>
                                </div>
                                <h3 class="project-title"><?= htmlspecialchars($skill['title']) ?></h3>
                                <div class="project-tagline"><?= htmlspecialchars($skill['tagline']) ?></div>

                                <!-- Animated Neon Proficiency Meter Track -->
                                <div class="skill-meter-wrap">
                                    <div class="progress-track">
                                        <div class="progress-bar" style="width: <?= intval($skill['proficiency']) ?>%;"></div>
                                    </div>
                                </div>

                                <p class="project-desc"><?= htmlspecialchars($skill['description']) ?></p>
                            </div>

                            <div class="project-footer">
                                <div class="tech-tags">
                                    <?php 
                                    $tags = explode(',', $skill['tech_stack']);
                                    foreach ($tags as $tag): 
                                    ?>
                                        <span class="tech-tag"><?= htmlspecialchars(trim($tag)) ?></span>
                                    <?php endforeach; ?>
                                </div>
                                <div class="project-actions">
                                    <a href="#projects" class="btn-demo" style="flex:1; justify-content:center;">
                                        <span>View System</span>
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                                    </a>
                                    <span class="badge-credential" title="Verified Skill Qualification">
                                        <?= htmlspecialchars($skill['badge'] ?? 'Verified Skill') ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ========================================================
         PROJECTS SECTION (Strictly 3 Projects with Visual Mockup Images)
         ======================================================== -->
    <section class="section" id="projects">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">// 03. Featured Portfolio</span>
                <h2 class="section-title">Key <span class="neon-text">IT Projects</span></h2>
                <p class="section-desc">Showcasing the 3 core systems engineered across web development, relational database systems, and IoT microcontroller automation.</p>
            </div>

            <!-- Project Filter Controls -->
            <div class="project-filters" id="project-filters">
                <button class="filter-btn active" data-filter="all">All Projects (3)</button>
                <button class="filter-btn" data-filter="Web & E-Commerce">Web &amp; E-Commerce</button>
                <button class="filter-btn" data-filter="Database Systems">Database Systems</button>
                <button class="filter-btn" data-filter="IoT & Embedded Systems">IoT &amp; Embedded Systems</button>
            </div>

            <div class="projects-grid" id="projects-container">
                <?php foreach ($projects as $project): ?>
                    <div class="project-card" data-category="<?= htmlspecialchars($project['category']) ?>">
                        <!-- Project Image Visual Preview -->
                        <div class="project-img-wrapper">
                            <img src="<?= htmlspecialchars($project['image_url']) ?>" alt="<?= htmlspecialchars($project['title']) ?>" class="project-img" loading="lazy">
                            <div class="project-img-overlay"></div>
                        </div>

                        <div class="project-body">
                            <div class="project-header">
                                <span class="project-cat-badge"><?= htmlspecialchars($project['category']) ?></span>
                                <h3 class="project-title"><?= htmlspecialchars($project['title']) ?></h3>
                                <div class="project-tagline"><?= htmlspecialchars($project['tagline']) ?></div>
                                <p class="project-desc"><?= htmlspecialchars($project['description']) ?></p>
                            </div>

                            <div class="project-footer">
                                <div class="tech-tags">
                                    <?php 
                                    $tags = explode(',', $project['tech_stack']);
                                    foreach ($tags as $tag): 
                                    ?>
                                        <span class="tech-tag"><?= htmlspecialchars(trim($tag)) ?></span>
                                    <?php endforeach; ?>
                                </div>
                                <div class="project-actions">
                                    <a href="<?= htmlspecialchars($project['demo_url']) ?>" class="btn-demo" target="_blank" rel="noopener">
                                        <span>Live Demo</span>
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                                    </a>
                                    <a href="<?= htmlspecialchars($project['repo_url']) ?>" class="btn-code" target="_blank" rel="noopener" title="Source Code">
                                        <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                                        <span>Code</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ========================================================
         MOCK INTERVIEW SECTION
         ======================================================== -->
    <section class="section" id="interview">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">// 04. Career Readiness</span>
                <h2 class="section-title">Mock <span class="neon-text">Interview</span></h2>
                <p class="section-desc">Watch a live mock interview demonstration — showcasing communication skills, professional composure, and IT competency responses.</p>
            </div>

            <div class="interview-layout">

                <!-- Video Player Column -->
                <div class="interview-player-col">
                    <div class="interview-player-card">

                        <!-- Player Header -->
                        <div class="interview-player-header">
                            <div class="interview-player-header-left">
                                <span class="interview-live-dot"></span>
                                <span class="interview-player-label">MOCK INTERVIEW SESSION</span>
                            </div>
                            <span class="interview-player-meta">IT Student · BSIT 4th Year</span>
                        </div>

                        <!-- Video -->
                        <div class="interview-video-wrapper" id="interviewVideoWrapper">
                            <video
                                id="interviewVideo"
                                class="interview-video"
                                controls
                                preload="metadata"
                                poster="assets/images/profile.jpg">
                                <source src="assets/videos/jl.mp4" type="video/mp4">
                                <source src="jl.mp4" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <!-- Play overlay -->
                            <div class="interview-play-overlay" id="interviewPlayOverlay" onclick="playInterviewVideo()">
                                <div class="interview-play-btn">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                </div>
                                <p class="interview-play-label">Click to Play</p>
                            </div>
                        </div>

                        <!-- Player Footer -->
                        <div class="interview-player-footer">
                            <div class="interview-footer-item">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                Full Session Recording
                            </div>
                            <div class="interview-footer-item">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                Interviewer + Candidate
                            </div>
                            <div class="interview-footer-item">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                                Live Q&amp;A Format
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Sidebar -->
                <div class="interview-sidebar">

                    <!-- Topics Covered -->
                    <div class="interview-sidebar-card">
                        <h4 class="interview-sidebar-title">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                            Topics Covered
                        </h4>
                        <ul class="interview-topics">
                            <li class="interview-topic-item">
                                <span class="interview-topic-num">01</span>
                                <span>Self Introduction &amp; Background</span>
                            </li>
                            <li class="interview-topic-item">
                                <span class="interview-topic-num">02</span>
                                <span>Technical Skills &amp; IT Competencies</span>
                            </li>
                            <li class="interview-topic-item">
                                <span class="interview-topic-num">03</span>
                                <span>Project Experience &amp; Achievements</span>
                            </li>
                            <li class="interview-topic-item">
                                <span class="interview-topic-num">04</span>
                                <span>Strengths, Weaknesses &amp; Goals</span>
                            </li>
                            <li class="interview-topic-item">
                                <span class="interview-topic-num">05</span>
                                <span>Situational &amp; Behavioral Questions</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Key Highlights -->
                    <div class="interview-sidebar-card">
                        <h4 class="interview-sidebar-title">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                            Key Highlights
                        </h4>
                        <div class="interview-highlights">
                            <div class="interview-highlight-item">
                                <div class="interview-highlight-icon">🎯</div>
                                <div>
                                    <div class="interview-highlight-label">Confidence</div>
                                    <div class="interview-highlight-bar"><div class="interview-highlight-fill" style="width:88%"></div></div>
                                </div>
                            </div>
                            <div class="interview-highlight-item">
                                <div class="interview-highlight-icon">💬</div>
                                <div>
                                    <div class="interview-highlight-label">Communication</div>
                                    <div class="interview-highlight-bar"><div class="interview-highlight-fill" style="width:92%"></div></div>
                                </div>
                            </div>
                            <div class="interview-highlight-item">
                                <div class="interview-highlight-icon">🧠</div>
                                <div>
                                    <div class="interview-highlight-label">Technical Knowledge</div>
                                    <div class="interview-highlight-bar"><div class="interview-highlight-fill" style="width:85%"></div></div>
                                </div>
                            </div>
                            <div class="interview-highlight-item">
                                <div class="interview-highlight-icon">⚡</div>
                                <div>
                                    <div class="interview-highlight-label">Problem Solving</div>
                                    <div class="interview-highlight-bar"><div class="interview-highlight-fill" style="width:80%"></div></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- View Resume CTA -->
                    <button type="button" class="btn btn-neon interview-resume-cta" onclick="openResumeModal()" style="width:100%;">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                        Quick View Resume
                    </button>

                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================
         CONTACT SECTION
         ======================================================== -->
    <section class="section" id="contact">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">// 05. Communications</span>
                <h2 class="section-title">Initialize <span class="neon-text">Contact</span></h2>
                <p class="section-desc">Have an internship vacancy, project collaboration, or inquiry? Send a direct message.</p>
            </div>

            <div class="contact-grid">
                <!-- Contact Information Column -->
                <div class="contact-info-card">
                    <h3 style="font-size: 1.3rem; margin-bottom: 24px; color: var(--text-primary);">
                        Direct Channels
                    </h3>

                    <div class="contact-method">
                        <div class="contact-icon">✉</div>
                        <div>
                            <div class="contact-label">Email Address</div>
                            <a href="mailto:<?= htmlspecialchars($profile['email']) ?>" class="contact-value">
                                <?= htmlspecialchars($profile['email']) ?>
                            </a>
                        </div>
                    </div>

                    <div class="contact-method">
                        <div class="contact-icon">📱</div>
                        <div>
                            <div class="contact-label">Phone / Mobile</div>
                            <div class="contact-value"><?= htmlspecialchars($profile['phone']) ?></div>
                        </div>
                    </div>

                    <div class="contact-method">
                        <div class="contact-icon">📍</div>
                        <div>
                            <div class="contact-label">Location</div>
                            <div class="contact-value"><?= htmlspecialchars($profile['location']) ?></div>
                        </div>
                    </div>

                    <div class="contact-method">
                        <div class="contact-icon">🏛</div>
                        <div>
                            <div class="contact-label">Academic Institution</div>
                            <div class="contact-value"><?= htmlspecialchars($profile['university']) ?></div>
                        </div>
                    </div>
                </div>

                <!-- Contact Message Form -->
                <div class="contact-form-card">
                    <!-- Dynamic AJAX Status Notice -->
                    <div class="toast-msg" id="form-feedback"></div>

                    <form id="contact-form" method="POST" action="contact_handler.php">
                        <div class="form-group">
                            <label class="form-label" for="sender-name">Your Full Name</label>
                            <input type="text" class="form-input" id="sender-name" name="name" placeholder="" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="sender-email">Email Address</label>
                            <input type="email" class="form-input" id="sender-email" name="email" placeholder="" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="sender-subject">Subject</label>
                            <input type="text" class="form-input" id="sender-subject" name="subject" placeholder="e.g., Internship Interview / Project Collaboration" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="sender-message">Message Content</label>
                            <textarea class="form-textarea" id="sender-message" name="message" placeholder="Provide details regarding your inquiry or opportunity..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-neon" id="submit-btn" style="width: 100%;">
                            Send Message ⚡
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================
         FOOTER
         ======================================================== -->
    <footer class="footer">
        <div class="container footer-content">
            <div class="footer-text">
                &copy; <?= date('Y') ?> <?= htmlspecialchars($profile['full_name']) ?>. Built with <span>PHP &amp; MySQL</span>.
                Main theme: <span>Neon Blue</span>.
            </div>

            <div class="footer-socials">
                <a href="<?= htmlspecialchars($profile['github_url']) ?>" class="social-link" target="_blank" rel="noopener" title="GitHub Profile">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                </a>
                <a href="<?= htmlspecialchars($profile['linkedin_url']) ?>" class="social-link" target="_blank" rel="noopener" title="LinkedIn Profile">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                </a>
            </div>
        </div>
    </footer>

    <!-- ========================================================
         QUICK VIEW RESUME MODAL
         ======================================================== -->
    <div class="resume-modal-overlay" id="resumeModal" role="dialog" aria-modal="true" aria-labelledby="resumeModalLabel">
        <div class="resume-modal-container">

            <!-- Modal Top Bar -->
            <div class="resume-modal-topbar">
                <div class="resume-modal-topbar-left">
                    <span class="resume-modal-badge">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                        OFFICIAL RESUME
                    </span>
                    <span class="resume-modal-filename" id="resumeModalLabel">Jhon_Luis_Carlos_Resume.jpg</span>
                </div>
                <div class="resume-modal-topbar-actions">
                    <button type="button" class="resume-btn-zoom" id="resumeZoomBtn" onclick="toggleResumeZoom()" title="Zoom In">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                        <span id="resumeZoomLabel">Zoom In</span>
                    </button>
                    <a href="resume_img.php" download="Jhon_Luis_Carlos_Resume.jpg" class="resume-btn-download" title="Download Resume">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                        Download
                    </a>
                    <button type="button" class="resume-btn-close" id="resumeCloseBtn" onclick="closeResumeModal()" aria-label="Close resume">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
            </div>

            <!-- Resume Image Viewer -->
            <div class="resume-modal-body" id="resumeModalBody">
                <div class="resume-img-wrapper" id="resumeImgWrapper">
                    <img src="resume_img.php"
                         alt="Jhon Luis B. Carlos - Resume"
                         class="resume-img"
                         id="resumeImg"
                         draggable="false"
                         onerror="this.style.display='none'; document.getElementById('resumeImgError').style.display='flex';">
                    <div id="resumeImgError" style="display:none; flex-direction:column; align-items:center; justify-content:center; gap:16px; padding:60px 40px; color:var(--text-secondary); text-align:center; font-family:var(--font-code); font-size:0.85rem;">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="rgba(0,243,255,0.4)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                        <span>Resume image could not be loaded.<br>Please place <code style="color:var(--neon-blue)">resume.jpg</code> in <code style="color:var(--neon-blue)">assets/images/</code></span>
                    </div>
                </div>
            </div>

            <!-- Hint bar -->
            <div class="resume-modal-hint">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                Click image to zoom &bull; Press <kbd>Esc</kbd> to close
            </div>
        </div>
    </div>

    <!-- Frontend Interactive Script -->
    <script src="assets/js/main.js"></script>
</body>
</html>
