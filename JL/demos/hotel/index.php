<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grand Horizon Hotel & Suites | Luxury Online Reservation System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,600&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold-primary: #c5a059;
            --gold-light: #e6ca85;
            --gold-dark: #917232;
            --emerald: #10b981;
            --bg-dark: #070e1b;
            --bg-card: #0d172a;
            --bg-surface: #13223d;
            --border-gold: rgba(197, 160, 89, 0.25);
            --border-subtle: rgba(255, 255, 255, 0.08);
            --text-gold: #e6ca85;
            --text-light: #f8fafc;
            --text-muted: #94a3b8;
            --font-serif: 'Cormorant Garamond', Georgia, serif;
            --font-sans: 'Montserrat', sans-serif;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-light);
            font-family: var(--font-sans);
            line-height: 1.6;
            padding-bottom: 80px;
        }

        /* Demo Header Bar */
        .demo-bar {
            background: #03070f;
            border-bottom: 1px solid var(--border-gold);
            padding: 10px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .demo-back-btn {
            color: var(--gold-light);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            transition: color 0.2s;
        }
        .demo-back-btn:hover { color: #fff; }
        .demo-badge {
            background: rgba(197, 160, 89, 0.15);
            color: var(--gold-light);
            border: 1px solid var(--border-gold);
            padding: 3px 12px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.8px;
        }

        /* Luxury Header */
        .hotel-header {
            background: rgba(7, 14, 27, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-subtle);
            padding: 20px 32px;
        }
        .header-inner {
            max-width: 1240px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }
        .hotel-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: #fff;
        }
        .brand-crest {
            width: 44px;
            height: 44px;
            border: 1px solid var(--gold-primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-serif);
            font-size: 1.5rem;
            color: var(--gold-primary);
            background: rgba(197, 160, 89, 0.08);
        }
        .brand-title {
            font-family: var(--font-serif);
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            color: #fff;
        }
        .brand-title span { color: var(--gold-primary); }
        .brand-sub {
            font-size: 0.7rem;
            letter-spacing: 2px;
            color: var(--text-muted);
            text-transform: uppercase;
        }
        .header-actions {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .admin-toggle-btn {
            background: rgba(16, 185, 129, 0.12);
            border: 1px solid rgba(16, 185, 129, 0.35);
            color: #34d399;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }
        .admin-toggle-btn:hover {
            background: rgba(16, 185, 129, 0.2);
        }

        /* Hero Showcase */
        .hotel-hero {
            position: relative;
            padding: 70px 24px 50px;
            text-align: center;
            background: radial-gradient(circle at 50% 20%, rgba(197, 160, 89, 0.12) 0%, rgba(7, 14, 27, 0) 70%);
        }
        .hero-stars {
            color: var(--gold-primary);
            font-size: 1.1rem;
            letter-spacing: 4px;
            margin-bottom: 12px;
        }
        .hero-headline {
            font-family: var(--font-serif);
            font-size: 3.2rem;
            font-weight: 600;
            line-height: 1.15;
            margin-bottom: 16px;
            color: #fff;
        }
        .hero-headline em {
            font-style: italic;
            color: var(--gold-light);
        }
        .hero-desc {
            max-width: 650px;
            margin: 0 auto;
            color: var(--text-muted);
            font-size: 0.98rem;
        }

        /* Search & Reservation Bar */
        .search-container {
            max-width: 1180px;
            margin: -25px auto 40px;
            padding: 0 24px;
            position: relative;
            z-index: 10;
        }
        .booking-search-card {
            background: var(--bg-card);
            border: 1px solid var(--border-gold);
            border-radius: 16px;
            padding: 24px 30px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.6);
            display: grid;
            grid-template-columns: repeat(4, 1fr) auto;
            gap: 20px;
            align-items: end;
        }
        .field-group label {
            display: block;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--gold-light);
            margin-bottom: 8px;
            font-weight: 600;
        }
        .search-input, .search-select {
            width: 100%;
            background: var(--bg-surface);
            border: 1px solid var(--border-subtle);
            color: #fff;
            padding: 12px 14px;
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.9rem;
            transition: border-color 0.2s;
        }
        .search-input:focus, .search-select:focus {
            outline: none;
            border-color: var(--gold-primary);
        }
        .btn-check-avail {
            background: linear-gradient(135deg, var(--gold-primary), var(--gold-dark));
            border: 1px solid var(--gold-light);
            color: #050a14;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.25s;
            white-space: nowrap;
        }
        .btn-check-avail:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(197, 160, 89, 0.4);
            color: #000;
        }

        /* Room Catalog */
        .catalog-container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 24px;
        }
        .catalog-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 28px;
            border-bottom: 1px solid var(--border-subtle);
            padding-bottom: 16px;
        }
        .catalog-title {
            font-family: var(--font-serif);
            font-size: 2.2rem;
            color: #fff;
        }
        .rooms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 30px;
        }
        .room-card {
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s, border-color 0.3s, box-shadow 0.3s;
        }
        .room-card:hover {
            transform: translateY(-6px);
            border-color: var(--border-gold);
            box-shadow: 0 16px 40px rgba(0,0,0,0.5), 0 0 20px rgba(197, 160, 89, 0.1);
        }
        .room-visual {
            height: 220px;
            background: #111a2e;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .room-badge-status {
            position: absolute;
            top: 14px;
            left: 14px;
            background: rgba(7, 14, 27, 0.85);
            backdrop-filter: blur(4px);
            border: 1px solid var(--border-gold);
            color: var(--gold-light);
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .room-view-btn {
            position: absolute;
            bottom: 14px;
            right: 14px;
            background: rgba(0,0,0,0.6);
            color: #fff;
            border: 1px solid rgba(255,255,255,0.2);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
        }
        .room-body {
            padding: 24px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }
        .room-meta-specs {
            display: flex;
            gap: 16px;
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-bottom: 8px;
        }
        .room-title {
            font-family: var(--font-serif);
            font-size: 1.55rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 10px;
        }
        .room-desc {
            color: var(--text-muted);
            font-size: 0.88rem;
            margin-bottom: 20px;
            flex: 1;
        }
        .amenity-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 20px;
        }
        .amenity-tag {
            background: var(--bg-surface);
            border: 1px solid var(--border-subtle);
            color: #cbd5e1;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
        }
        .room-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 18px;
            border-top: 1px solid var(--border-subtle);
        }
        .price-box {
            display: flex;
            flex-direction: column;
        }
        .price-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            color: var(--text-muted);
        }
        .price-val {
            font-family: var(--font-serif);
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--gold-light);
        }
        .price-val span {
            font-size: 0.85rem;
            font-family: var(--font-sans);
            color: var(--text-muted);
            font-weight: 400;
        }
        .btn-reserve {
            background: transparent;
            border: 1px solid var(--gold-primary);
            color: var(--gold-light);
            padding: 10px 22px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-reserve:hover {
            background: var(--gold-primary);
            color: #070e1b;
            box-shadow: 0 4px 15px rgba(197, 160, 89, 0.3);
        }

        /* Modal Base */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.8);
            backdrop-filter: blur(6px);
            z-index: 200;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .modal-backdrop.open { display: flex; }
        .booking-dialog {
            background: var(--bg-card);
            border: 1px solid var(--border-gold);
            border-radius: 18px;
            max-width: 580px;
            width: 100%;
            padding: 32px;
            position: relative;
            box-shadow: 0 25px 60px rgba(0,0,0,0.7);
            max-height: 90vh;
            overflow-y: auto;
        }
        .dialog-title {
            font-family: var(--font-serif);
            font-size: 1.8rem;
            color: #fff;
            margin-bottom: 6px;
        }
        .dialog-sub {
            color: var(--text-muted);
            font-size: 0.88rem;
            margin-bottom: 24px;
        }
        .cost-breakdown {
            background: var(--bg-surface);
            border: 1px solid var(--border-subtle);
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 24px;
        }
        .cost-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.88rem;
            color: var(--text-muted);
            margin-bottom: 8px;
        }
        .cost-row.grand {
            border-top: 1px solid var(--border-subtle);
            padding-top: 10px;
            margin-top: 10px;
            color: #fff;
            font-size: 1.15rem;
            font-weight: 700;
        }
        .dialog-btns {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        /* Admin Dashboard Drawer / Modal */
        .admin-stat-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }
        .admin-stat-card {
            background: var(--bg-surface);
            border: 1px solid var(--border-subtle);
            padding: 16px;
            border-radius: 10px;
        }
        .admin-stat-card h5 {
            font-size: 0.78rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }
        .admin-stat-num {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--gold-light);
        }

        @media (max-width: 900px) {
            .booking-search-card {
                grid-template-columns: 1fr 1fr;
            }
        }
        @media (max-width: 600px) {
            .booking-search-card {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- Demo Bar Link Back to Portfolio -->
    <div class="demo-bar">
        <a href="../../index.php#projects" class="demo-back-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
            Back to John Luis Carlos Portfolio
        </a>
        <span class="demo-badge">LIVE DEMO • DATABASE SYSTEMS</span>
    </div>

    <!-- Luxury Hotel Header -->
    <header class="hotel-header">
        <div class="header-inner">
            <a href="#" class="hotel-brand">
                <div class="brand-crest">GH</div>
                <div>
                    <div class="brand-title">GRAND <span>HORIZON</span></div>
                    <div class="brand-sub">HOTEL &bull; RESORT &bull; SUITES</div>
                </div>
            </a>

            <div class="header-actions">
                <button class="admin-toggle-btn" onclick="openAdminStats()">
                    <span style="font-size:0.9rem;">📊</span>
                    <span>Admin Occupancy Dashboard</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Showcase -->
    <section class="hotel-hero">
        <div class="hero-stars">★★★★★</div>
        <h1 class="hero-headline">Where Timeless Opulence<br>Meets <em>Oceanfront Serenity</em></h1>
        <p class="hero-desc">Discover our collection of bespoke suites, private villas, and Michelin-inspired dining on the shores of Manila Bay.</p>
    </section>

    <!-- Search / Reservation Engine Bar -->
    <div class="search-container">
        <div class="booking-search-card">
            <div class="field-group">
                <label>Check-In Date</label>
                <input type="date" class="search-input" id="checkInDate" value="2026-11-01" onchange="recalculatePrices()">
            </div>
            <div class="field-group">
                <label>Check-Out Date</label>
                <input type="date" class="search-input" id="checkOutDate" value="2026-11-04" onchange="recalculatePrices()">
            </div>
            <div class="field-group">
                <label>Room Category</label>
                <select class="search-select" id="roomCategorySelect" onchange="filterRooms()">
                    <option value="all">All Available Suites</option>
                    <option value="deluxe">Deluxe Suites</option>
                    <option value="executive">Executive &amp; Penthouses</option>
                    <option value="villa">Private Garden Villas</option>
                </select>
            </div>
            <div class="field-group">
                <label>Guests</label>
                <select class="search-select" id="guestCountSelect">
                    <option value="1">1 Adult (Single)</option>
                    <option value="2" selected>2 Adults (Double)</option>
                    <option value="3">3 Adults (Family)</option>
                    <option value="4">4 Adults (Suite)</option>
                </select>
            </div>
            <button class="btn-check-avail" onclick="filterRooms()">Check Availability ⚡</button>
        </div>
    </div>

    <!-- Room Catalog -->
    <main class="catalog-container">
        <div class="catalog-header">
            <div>
                <h2 class="catalog-title">Curated Suites &amp; Residences</h2>
                <p style="color:var(--text-muted); font-size:0.9rem;">Real-time room rates updated for <span id="stayDurationLabel" style="color:var(--gold-light); font-weight:600;">3 Nights</span>.</p>
            </div>
            <div style="font-size:0.85rem; color:var(--text-muted);">
                Showing <span id="roomCountLabel" style="color:#fff; font-weight:700;">4</span> Suites Available
            </div>
        </div>

        <div class="rooms-grid" id="roomsGrid">
            <!-- Room Cards dynamically generated by JS -->
        </div>
    </main>

    <!-- Booking Modal -->
    <div class="modal-backdrop" id="bookingModal">
        <div class="booking-dialog">
            <div id="bookingFormSection">
                <div style="display:flex; justify-content:space-between; align-items:start;">
                    <div>
                        <h3 class="dialog-title" id="modalRoomTitle">Deluxe Suite</h3>
                        <p class="dialog-sub">Enter guest registration credentials to reserve your stay.</p>
                    </div>
                    <button onclick="closeBookingModal()" style="background:none; border:none; color:var(--text-muted); font-size:1.6rem; cursor:pointer;">&times;</button>
                </div>

                <div class="cost-breakdown">
                    <div class="cost-row">
                        <span>Nightly Base Rate</span>
                        <span id="modalNightlyRate">₱6,800</span>
                    </div>
                    <div class="cost-row">
                        <span>Duration (<span id="modalNightCount">3</span> Nights)</span>
                        <span id="modalBaseSubtotal">₱20,400</span>
                    </div>
                    <div class="cost-row">
                        <span>Government VAT (12%)</span>
                        <span id="modalVat">₱2,448</span>
                    </div>
                    <div class="cost-row">
                        <span>Luxury Service Charge (10%)</span>
                        <span id="modalServiceCharge">₱2,040</span>
                    </div>
                    <div class="cost-row grand">
                        <span>Total Stay Amount</span>
                        <span id="modalGrandTotal" style="color:var(--gold-light);">₱24,888</span>
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <label style="display:block; font-size:0.8rem; color:var(--gold-light); margin-bottom:6px; font-weight:600;">Guest Full Name</label>
                    <input type="text" class="search-input" id="guestFullName" placeholder="e.g. Attorney Roberto Garcia" required>
                </div>
                <div style="margin-bottom:16px;">
                    <label style="display:block; font-size:0.8rem; color:var(--gold-light); margin-bottom:6px; font-weight:600;">Email Address for Confirmation</label>
                    <input type="email" class="search-input" id="guestEmail" placeholder="e.g. r.garcia@enterprise.ph" required>
                </div>
                <div style="margin-bottom:16px;">
                    <label style="display:block; font-size:0.8rem; color:var(--gold-light); margin-bottom:6px; font-weight:600;">Contact Mobile Phone</label>
                    <input type="text" class="search-input" id="guestPhone" placeholder="e.g. +63 917 842 1904" required>
                </div>
                <div style="margin-bottom:20px;">
                    <label style="display:block; font-size:0.8rem; color:var(--gold-light); margin-bottom:6px; font-weight:600;">Special Requests</label>
                    <input type="text" class="search-input" id="guestRequests" placeholder="e.g. Airport limousine transfer, High floor, Feather pillows">
                </div>

                <div class="dialog-btns">
                    <button class="btn-reserve" style="flex:1;" onclick="closeBookingModal()">Cancel</button>
                    <button class="btn-check-avail" style="flex:2;" onclick="confirmBooking()">Confirm Reservation &amp; Issue Voucher ⚡</button>
                </div>
            </div>

            <!-- Confirmed Voucher Screen -->
            <div id="bookingSuccessSection" style="display:none; text-align:center;">
                <div style="font-size:3.5rem; margin-bottom:12px;">👑</div>
                <h3 class="dialog-title" style="color:var(--gold-light);">Reservation Confirmed</h3>
                <p class="dialog-sub">Your booking has been recorded in the central database.</p>

                <div style="background:var(--bg-surface); border:1px dashed var(--border-gold); padding:20px; border-radius:12px; margin:20px 0; text-align:left; font-size:0.88rem;">
                    <div style="display:flex; justify-content:space-between; margin-bottom:8px;">
                        <span style="color:var(--text-muted);">Booking Reference:</span>
                        <strong id="voucherRef" style="color:var(--gold-light); font-size:1.05rem;">#GHR-2026-8941</strong>
                    </div>
                    <div style="display:flex; justify-content:space-between; margin-bottom:8px;">
                        <span style="color:var(--text-muted);">Primary Guest:</span>
                        <strong id="voucherGuestName">Roberto Garcia</strong>
                    </div>
                    <div style="display:flex; justify-content:space-between; margin-bottom:8px;">
                        <span style="color:var(--text-muted);">Suite Booked:</span>
                        <strong id="voucherSuiteName">Deluxe Bayview King Suite</strong>
                    </div>
                    <div style="display:flex; justify-content:space-between; margin-bottom:8px;">
                        <span style="color:var(--text-muted);">Duration:</span>
                        <span id="voucherDuration">3 Nights (Nov 1 - Nov 4)</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; margin-top:12px; padding-top:12px; border-top:1px dashed var(--border-subtle); font-size:1.1rem;">
                        <strong>Total Amount:</strong>
                        <strong id="voucherTotal" style="color:var(--gold-light);">₱24,888</strong>
                    </div>
                </div>

                <button class="btn-check-avail" onclick="closeBookingModal()" style="width:100%;">Done</button>
            </div>
        </div>
    </div>

    <!-- Admin Occupancy Dashboard Modal (Protected by johncarlos / johncarlos123) -->
    <div class="modal-backdrop" id="adminModal">
        <div class="booking-dialog">
            <!-- Login Gate View -->
            <div id="adminLoginSection">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                    <h3 class="dialog-title" style="font-size:1.5rem; margin:0;">Admin Sign In</h3>
                    <button onclick="closeAdminStats()" style="background:none; border:none; color:var(--text-muted); font-size:1.6rem; cursor:pointer;">&times;</button>
                </div>
                <p style="color:var(--text-muted); font-size:0.85rem; margin-bottom:18px;">
                    Enter your administrative credentials to access live room inventory &amp; revenue metrics.
                </p>
                <div style="background:rgba(197,160,89,0.1); border:1px dashed var(--border-gold); padding:10px 14px; border-radius:8px; margin-bottom:18px; font-size:0.8rem;">
                    <div style="color:var(--gold-light); font-weight:700; margin-bottom:4px;">VERIFIED CREDENTIALS:</div>
                    <div style="display:flex; justify-content:space-between; color:var(--text-muted);">
                        <span>Username: <strong style="color:#fff;">johncarlos</strong></span>
                        <span>Password: <strong style="color:#fff;">johncarlos123</strong></span>
                    </div>
                </div>
                <div id="hotelLoginError" style="display:none; color:#fca5a5; font-size:0.82rem; margin-bottom:12px; background:rgba(239,68,68,0.15); padding:8px 12px; border-radius:6px;">
                    Invalid credentials. Please enter johncarlos / johncarlos123.
                </div>
                <div style="margin-bottom:14px;">
                    <label style="display:block; font-size:0.78rem; color:var(--gold-light); margin-bottom:6px; font-weight:600; text-transform:uppercase;">Username</label>
                    <input type="text" class="search-input" id="hotelAdminUser" value="johncarlos">
                </div>
                <div style="margin-bottom:20px;">
                    <label style="display:block; font-size:0.78rem; color:var(--gold-light); margin-bottom:6px; font-weight:600; text-transform:uppercase;">Password</label>
                    <input type="password" class="search-input" id="hotelAdminPass" value="johncarlos123">
                </div>
                <div style="display:flex; gap:10px;">
                    <button class="btn-reserve" style="flex:1;" onclick="closeAdminStats()">Cancel</button>
                    <button class="btn-check-avail" style="flex:2;" onclick="verifyHotelAdminLogin()">Sign In &amp; Unlock ⚡</button>
                </div>
            </div>

            <!-- Unlocked Admin Telemetry View -->
            <div id="adminTelemetrySection" style="display:none;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                    <div>
                        <h3 class="dialog-title" style="font-size:1.5rem; margin:0;">Occupancy Telemetry Dashboard</h3>
                        <div style="font-size:0.75rem; color:#34d399; margin-top:2px;">● Logged in as: johncarlos (Administrator)</div>
                    </div>
                    <button onclick="closeAdminStats()" style="background:none; border:none; color:var(--text-muted); font-size:1.6rem; cursor:pointer;">&times;</button>
                </div>

                <p style="color:var(--text-muted); font-size:0.88rem; margin-bottom:20px;">Live SQL database aggregated statistics for Grand Horizon Resort.</p>

                <div class="admin-stat-grid">
                    <div class="admin-stat-card">
                        <h5>Total Room Inventory</h5>
                        <div class="admin-stat-num">120</div>
                        <div style="font-size:0.75rem; color:var(--text-muted); margin-top:4px;">Across 4 Luxury Tiers</div>
                    </div>
                    <div class="admin-stat-card">
                        <h5>Occupancy Rate</h5>
                        <div class="admin-stat-num" style="color:#34d399;">84.2%</div>
                        <div style="font-size:0.75rem; color:#34d399; margin-top:4px;">101 Rooms Occupied</div>
                    </div>
                    <div class="admin-stat-card">
                        <h5>Available Rooms</h5>
                        <div class="admin-stat-num" style="color:var(--gold-light);">19</div>
                        <div style="font-size:0.75rem; color:var(--text-muted); margin-top:4px;">Open for Instant Check-in</div>
                    </div>
                    <div class="admin-stat-card">
                        <h5>Projected Revenue</h5>
                        <div class="admin-stat-num" style="font-size:1.4rem;">₱892,400</div>
                        <div style="font-size:0.75rem; color:var(--text-muted); margin-top:4px;">Daily ADR (Average Daily Rate)</div>
                    </div>
                </div>

                <button class="btn-reserve" onclick="closeAdminStats()" style="width:100%;">Close Dashboard</button>
            </div>
        </div>
    </div>

    <script>
        const ROOMS = [
            {
                id: 1,
                title: "Deluxe Bayview King Suite",
                category: "deluxe",
                price: 6800,
                sqm: "58 m²",
                bed: "1 California King Bed",
                view: "Manila Bay Sunset",
                amenities: ["Private Balcony", "Marble Bath", "High-Speed WiFi", "Complimentary Breakfast", "Espresso Machine"],
                desc: "Spacious master bedroom overlooking the golden waters of Manila Bay with deep soaking marble bathtub and private sunset veranda.",
                badge: "🟢 Available (3 Left)",
                icon: "🌅"
            },
            {
                id: 2,
                title: "Executive Sky Penthouse",
                category: "executive",
                price: 14500,
                sqm: "115 m²",
                bed: "1 King Bed + Lounge",
                view: "270° Panoramic Skyline",
                amenities: ["Private Jacuzzi", "Dedicated Butler", "Executive Lounge Access", "Cocktail Hour", "Limousine Transfer"],
                desc: "Perched on the 32nd floor with wraparound floor-to-ceiling glass, in-suite dining parlor, heated jacuzzi, and complimentary champagne.",
                badge: "🟡 High Demand",
                icon: "🥂"
            },
            {
                id: 3,
                title: "Grand Family Garden Villa",
                category: "villa",
                price: 9200,
                sqm: "88 m²",
                bed: "2 Queen Luxury Beds",
                view: "Tropical Lagoon View",
                amenities: ["Garden Terrace", "Dual Sinks", "Connecting Rooms", "Kid Concierge", "Pool Access"],
                desc: "Secluded amidst lush exotic greenery with direct walk-out access to the infinity pool and spacious family entertainment parlor.",
                badge: "🟢 Available",
                icon: "🌴"
            },
            {
                id: 4,
                title: "Imperial Presidential Residence",
                category: "executive",
                price: 28000,
                sqm: "210 m²",
                bed: "Master Suite + Guest Suite",
                view: "Unobstructed Oceanfront",
                amenities: ["Private Infinity Plunge Pool", "Personal Chef", "Wine Cellar", "Boardroom", "Helipad Access"],
                desc: "The pinnacle of VIP luxury. Includes private plunge pool, 12-person dining room, bulletproof acoustic isolation, and dedicated 24-hour butler.",
                badge: "💎 Presidential Tier",
                icon: "👑"
            }
        ];

        let selectedRoom = null;

        function getNights() {
            const inDate = new Date(document.getElementById('checkInDate').value);
            const outDate = new Date(document.getElementById('checkOutDate').value);
            const diffTime = outDate - inDate;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            return diffDays > 0 ? diffDays : 1;
        }

        function recalculatePrices() {
            const nights = getNights();
            document.getElementById('stayDurationLabel').textContent = `${nights} Night${nights > 1 ? 's' : ''}`;
            renderRooms();
        }

        function filterRooms() {
            const category = document.getElementById('roomCategorySelect').value;
            renderRooms(category);
        }

        function renderRooms(category = 'all') {
            const grid = document.getElementById('roomsGrid');
            const nights = getNights();
            const filtered = category === 'all' ? ROOMS : ROOMS.filter(r => r.category === category);

            document.getElementById('roomCountLabel').textContent = filtered.length;

            grid.innerHTML = filtered.map(room => {
                const stayCost = room.price * nights;
                return `
                    <div class="room-card">
                        <div class="room-visual">
                            <span class="room-badge-status">${room.badge}</span>
                            <div style="font-size:4.5rem;">${room.icon}</div>
                            <span class="room-view-btn">View Suite Specs</span>
                        </div>
                        <div class="room-body">
                            <div class="room-meta-specs">
                                <span>📐 ${room.sqm}</span>
                                <span>🛏️ ${room.bed}</span>
                                <span>🔭 ${room.view}</span>
                            </div>
                            <h3 class="room-title">${room.title}</h3>
                            <p class="room-desc">${room.desc}</p>
                            <div class="amenity-pills">
                                ${room.amenities.map(a => `<span class="amenity-tag">${a}</span>`).join('')}
                            </div>
                            <div class="room-footer">
                                <div class="price-box">
                                    <span class="price-label">Rate for ${nights} Night${nights>1?'s':''}</span>
                                    <div class="price-val">₱${stayCost.toLocaleString()} <span>/ stay</span></div>
                                </div>
                                <button class="btn-reserve" onclick="openBookingModal(${room.id})">Book Suite ⚡</button>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function openBookingModal(roomId) {
            selectedRoom = ROOMS.find(r => r.id === roomId);
            if (!selectedRoom) return;

            const nights = getNights();
            const baseSubtotal = selectedRoom.price * nights;
            const vat = baseSubtotal * 0.12;
            const serviceCharge = baseSubtotal * 0.10;
            const grandTotal = baseSubtotal + vat + serviceCharge;

            document.getElementById('modalRoomTitle').textContent = selectedRoom.title;
            document.getElementById('modalNightlyRate').textContent = `₱${selectedRoom.price.toLocaleString()} / night`;
            document.getElementById('modalNightCount').textContent = nights;
            document.getElementById('modalBaseSubtotal').textContent = `₱${baseSubtotal.toLocaleString()}`;
            document.getElementById('modalVat').textContent = `₱${vat.toLocaleString()}`;
            document.getElementById('modalServiceCharge').textContent = `₱${serviceCharge.toLocaleString()}`;
            document.getElementById('modalGrandTotal').textContent = `₱${grandTotal.toLocaleString()}`;

            document.getElementById('bookingFormSection').style.display = 'block';
            document.getElementById('bookingSuccessSection').style.display = 'none';
            document.getElementById('bookingModal').classList.add('open');
        }

        function closeBookingModal() {
            document.getElementById('bookingModal').classList.remove('open');
        }

        function confirmBooking() {
            const name = document.getElementById('guestFullName').value.trim();
            const email = document.getElementById('guestEmail').value.trim();
            if (!name || !email) {
                alert('Please enter your full name and confirmation email.');
                return;
            }

            const ref = '#GHR-2026-' + Math.floor(1000 + Math.random() * 9000);
            const nights = getNights();
            const inDate = document.getElementById('checkInDate').value;
            const outDate = document.getElementById('checkOutDate').value;
            const totalText = document.getElementById('modalGrandTotal').textContent;

            document.getElementById('voucherRef').textContent = ref;
            document.getElementById('voucherGuestName').textContent = name;
            document.getElementById('voucherSuiteName').textContent = selectedRoom.title;
            document.getElementById('voucherDuration').textContent = `${nights} Nights (${inDate} to ${outDate})`;
            document.getElementById('voucherTotal').textContent = totalText;

            document.getElementById('bookingFormSection').style.display = 'none';
            document.getElementById('bookingSuccessSection').style.display = 'block';
        }

        let isHotelAdminLoggedIn = false;

        function openAdminStats() {
            if (isHotelAdminLoggedIn) {
                document.getElementById('adminLoginSection').style.display = 'none';
                document.getElementById('adminTelemetrySection').style.display = 'block';
            } else {
                document.getElementById('adminLoginSection').style.display = 'block';
                document.getElementById('adminTelemetrySection').style.display = 'none';
                document.getElementById('hotelLoginError').style.display = 'none';
            }
            document.getElementById('adminModal').classList.add('open');
        }

        function closeAdminStats() {
            document.getElementById('adminModal').classList.remove('open');
        }

        function verifyHotelAdminLogin() {
            const u = document.getElementById('hotelAdminUser').value.trim();
            const p = document.getElementById('hotelAdminPass').value.trim();
            if (u === 'johncarlos' && p === 'johncarlos123') {
                isHotelAdminLoggedIn = true;
                document.getElementById('adminLoginSection').style.display = 'none';
                document.getElementById('adminTelemetrySection').style.display = 'block';
            } else {
                document.getElementById('hotelLoginError').style.display = 'block';
            }
        }

        // Initialize
        recalculatePrices();
    </script>
</body>
</html>
