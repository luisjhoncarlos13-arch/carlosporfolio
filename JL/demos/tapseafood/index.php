<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tapseafood | Online Food Ordering & Table Reservation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,800;1,600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #ff5722;
            --primary-hover: #f44336;
            --accent: #ffb300;
            --dark-bg: #0c121e;
            --dark-surface: #141d2e;
            --dark-card: #1a253a;
            --border: rgba(255, 255, 255, 0.08);
            --text-main: #f1f5f9;
            --text-muted: #94a3b8;
            --font-heading: 'Playfair Display', serif;
            --font-body: 'Plus Jakarta Sans', sans-serif;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--dark-bg);
            color: var(--text-main);
            font-family: var(--font-body);
            line-height: 1.5;
            padding-bottom: 80px;
        }

        /* Demo Header Bar */
        .demo-bar {
            background: #060a12;
            border-bottom: 1px solid rgba(255, 87, 34, 0.3);
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
            color: #ff8a65;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            transition: color 0.2s;
        }
        .demo-back-btn:hover { color: #fff; }
        .demo-badge {
            background: rgba(255, 87, 34, 0.15);
            color: #ff7043;
            border: 1px solid rgba(255, 87, 34, 0.3);
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* App Navigation */
        .app-header {
            background: var(--dark-surface);
            border-bottom: 1px solid var(--border);
            padding: 18px 24px;
        }
        .nav-inner {
            max-width: 1240px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #fff;
        }
        .brand-icon {
            font-size: 2rem;
            background: rgba(255, 87, 34, 0.15);
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            border: 1px solid rgba(255, 87, 34, 0.3);
        }
        .brand-name {
            font-family: var(--font-heading);
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: 0.5px;
        }
        .brand-name span { color: var(--primary); }
        .order-mode {
            display: flex;
            background: var(--dark-card);
            border-radius: 999px;
            padding: 4px;
            border: 1px solid var(--border);
        }
        .mode-btn {
            background: none;
            border: none;
            color: var(--text-muted);
            padding: 8px 18px;
            border-radius: 999px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.2s;
        }
        .mode-btn.active {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 2px 10px rgba(255, 87, 34, 0.4);
        }
        .cart-trigger-btn {
            background: var(--dark-card);
            border: 1px solid rgba(255, 87, 34, 0.4);
            color: #fff;
            padding: 10px 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            font-weight: 600;
            position: relative;
            transition: all 0.2s;
        }
        .cart-trigger-btn:hover {
            background: rgba(255, 87, 34, 0.15);
            border-color: var(--primary);
        }
        .cart-badge {
            background: var(--primary);
            color: #fff;
            font-size: 0.75rem;
            padding: 2px 8px;
            border-radius: 999px;
            font-weight: 700;
        }

        /* Hero Banner */
        .hero-banner {
            max-width: 1240px;
            margin: 24px auto 0;
            padding: 0 24px;
        }
        .banner-card {
            background: linear-gradient(135deg, #24141e 0%, #171b30 50%, #122830 100%);
            border: 1px solid rgba(255, 87, 34, 0.25);
            border-radius: 20px;
            padding: 40px;
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .banner-card::before {
            content: '🦞';
            position: absolute;
            right: 40px;
            font-size: 14rem;
            opacity: 0.08;
            pointer-events: none;
            transform: rotate(-15deg);
        }
        .banner-text h1 {
            font-family: var(--font-heading);
            font-size: 2.4rem;
            margin-bottom: 10px;
            line-height: 1.2;
        }
        .banner-text p {
            color: var(--text-muted);
            max-width: 520px;
            margin-bottom: 20px;
            font-size: 1rem;
        }
        .coupon-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 179, 0, 0.15);
            border: 1px dashed var(--accent);
            color: var(--accent);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 700;
        }

        /* Category Filter */
        .category-nav {
            max-width: 1240px;
            margin: 32px auto 0;
            padding: 0 24px;
            display: flex;
            gap: 12px;
            overflow-x: auto;
            scrollbar-width: none;
        }
        .category-nav::-webkit-scrollbar { display: none; }
        .cat-chip {
            background: var(--dark-surface);
            border: 1px solid var(--border);
            color: var(--text-muted);
            padding: 10px 20px;
            border-radius: 999px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.88rem;
            white-space: nowrap;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .cat-chip:hover {
            color: #fff;
            border-color: rgba(255, 255, 255, 0.2);
        }
        .cat-chip.active {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
            box-shadow: 0 4px 15px rgba(255, 87, 34, 0.35);
        }

        /* Food Grid */
        .menu-section {
            max-width: 1240px;
            margin: 32px auto 0;
            padding: 0 24px;
        }
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
        }
        .dish-card {
            background: var(--dark-surface);
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.25s, border-color 0.25s, box-shadow 0.25s;
        }
        .dish-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 87, 34, 0.35);
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        .dish-img-box {
            height: 180px;
            position: relative;
            background: #1e293b;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .dish-emoji {
            font-size: 5rem;
            transition: transform 0.3s;
        }
        .dish-card:hover .dish-emoji {
            transform: scale(1.1);
        }
        .dish-spice {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(12, 18, 30, 0.85);
            border: 1px solid rgba(255,255,255,0.1);
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .dish-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }
        .dish-title {
            font-family: var(--font-heading);
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 6px;
            color: #fff;
        }
        .dish-desc {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-bottom: 16px;
            flex: 1;
        }
        .dish-sauce {
            font-size: 0.75rem;
            color: var(--accent);
            background: rgba(255, 179, 0, 0.08);
            padding: 4px 8px;
            border-radius: 6px;
            align-self: flex-start;
            margin-bottom: 16px;
        }
        .dish-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 14px;
            border-top: 1px solid var(--border);
        }
        .dish-price {
            font-size: 1.3rem;
            font-weight: 800;
            color: #fff;
        }
        .add-cart-btn {
            background: var(--primary);
            border: none;
            color: #fff;
            padding: 10px 18px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 700;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }
        .add-cart-btn:hover {
            background: var(--primary-hover);
            transform: scale(1.05);
        }

        /* Cart Drawer */
        .cart-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(4px);
            z-index: 200;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
        }
        .cart-overlay.open {
            opacity: 1;
            pointer-events: auto;
        }
        .cart-drawer {
            position: fixed;
            top: 0;
            right: -420px;
            width: 100%;
            max-width: 420px;
            height: 100%;
            background: var(--dark-surface);
            border-left: 1px solid var(--border);
            z-index: 201;
            transition: right 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
        }
        .cart-overlay.open .cart-drawer {
            right: 0;
        }
        .cart-header {
            padding: 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .cart-header h3 {
            font-family: var(--font-heading);
            font-size: 1.3rem;
        }
        .close-cart-btn {
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 1.5rem;
            cursor: pointer;
        }
        .cart-items {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .cart-item {
            background: var(--dark-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 12px;
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .cart-item-emoji {
            font-size: 2.2rem;
            background: var(--dark-surface);
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .cart-item-info { flex: 1; }
        .cart-item-name { font-weight: 700; font-size: 0.95rem; }
        .cart-item-price { color: var(--primary); font-size: 0.85rem; font-weight: 600; }
        .cart-qty-ctrl {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--dark-surface);
            border-radius: 8px;
            padding: 4px;
        }
        .qty-btn {
            background: none;
            border: none;
            color: #fff;
            width: 24px;
            height: 24px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 700;
        }
        .qty-btn:hover { background: rgba(255,255,255,0.1); }
        .cart-footer {
            padding: 20px;
            border-top: 1px solid var(--border);
            background: var(--dark-card);
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 8px;
        }
        .summary-row.total {
            color: #fff;
            font-size: 1.2rem;
            font-weight: 800;
            padding-top: 10px;
            border-top: 1px solid var(--border);
            margin-top: 10px;
            margin-bottom: 16px;
        }
        .checkout-btn {
            width: 100%;
            background: var(--primary);
            border: none;
            color: #fff;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .checkout-btn:hover {
            background: var(--primary-hover);
        }

        /* Modal Checkout Dialog */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.8);
            backdrop-filter: blur(5px);
            z-index: 300;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .modal-overlay.open { display: flex; }
        .modal-box {
            background: var(--dark-surface);
            border: 1px solid rgba(255, 87, 34, 0.4);
            border-radius: 20px;
            max-width: 500px;
            width: 100%;
            padding: 30px;
            position: relative;
            box-shadow: 0 20px 50px rgba(0,0,0,0.6);
        }
        .modal-title {
            font-family: var(--font-heading);
            font-size: 1.6rem;
            margin-bottom: 8px;
        }
        .form-group {
            margin-bottom: 16px;
        }
        .form-label {
            display: block;
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 6px;
            font-weight: 600;
        }
        .form-input, .form-select {
            width: 100%;
            background: var(--dark-card);
            border: 1px solid var(--border);
            color: #fff;
            padding: 12px 14px;
            border-radius: 10px;
            font-family: inherit;
            font-size: 0.95rem;
        }
        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: var(--primary);
        }

        /* Success Card */
        .success-box {
            text-align: center;
            padding: 20px 10px;
        }
        .success-icon {
            font-size: 4rem;
            margin-bottom: 16px;
        }
        .receipt-pill {
            background: var(--dark-card);
            border: 1px dashed var(--border);
            padding: 16px;
            border-radius: 12px;
            margin: 20px 0;
            text-align: left;
            font-size: 0.88rem;
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
        <span class="demo-badge">LIVE DEMO • WEB &amp; E-COMMERCE</span>
    </div>

    <!-- App Header -->
    <header class="app-header">
        <div class="nav-inner">
            <a href="#" class="brand">
                <div class="brand-icon">🦀</div>
                <div>
                    <div class="brand-name">TAP<span>SEAFOOD</span></div>
                    <div style="font-size: 0.72rem; color: var(--text-muted); letter-spacing: 1px;">BOIL &bull; GRILL &bull; TAKEOUT</div>
                </div>
            </a>

            <div class="order-mode">
                <button class="mode-btn active" onclick="setMode(this, 'Delivery')">🛵 Delivery (30-40m)</button>
                <button class="mode-btn" onclick="setMode(this, 'Dine-In')">🍽️ Dine-In Table Order</button>
            </div>

            <button class="cart-trigger-btn" onclick="toggleCart(true)">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                <span>Cart</span>
                <span class="cart-badge" id="cartCountBadge">0</span>
            </button>
        </div>
    </header>

    <!-- Hero Banner -->
    <div class="hero-banner">
        <div class="banner-card">
            <div class="banner-text">
                <div class="coupon-pill">🔥 Promo Code: SEAFOOD20 (20% OFF)</div>
                <h1 style="margin-top:14px;">The Freshest Catch,<br>Delivered Hot &amp; Sauced.</h1>
                <p>Authentic Cajun seafood boils, butter-drenched mud crabs, tiger prawns, and charcoal grilled oceanic feasts prepared to your exact spice preference.</p>
            </div>
        </div>
    </div>

    <!-- Category Filter -->
    <div class="category-nav" id="categoryNav">
        <button class="cat-chip active" onclick="filterMenu('all', this)">⭐ All Specialties</button>
        <button class="cat-chip" onclick="filterMenu('buckets', this)">🦞 Cajun Boils</button>
        <button class="cat-chip" onclick="filterMenu('crabs', this)">🦀 Crabs &amp; Lobsters</button>
        <button class="cat-chip" onclick="filterMenu('prawns', this)">🦐 Prawns &amp; Squid</button>
        <button class="cat-chip" onclick="filterMenu('grilled', this)">🐟 Grilled &amp; Sides</button>
    </div>

    <!-- Menu Grid -->
    <div class="menu-section">
        <div class="menu-grid" id="menuGrid">
            <!-- Dishes injected dynamically by JS -->
        </div>
    </div>

    <!-- Sliding Cart Drawer -->
    <div class="cart-overlay" id="cartOverlay" onclick="if(event.target===this) toggleCart(false)">
        <div class="cart-drawer">
            <div class="cart-header">
                <h3>Your Seafood Order 🦐</h3>
                <button class="close-cart-btn" onclick="toggleCart(false)">&times;</button>
            </div>

            <div class="cart-items" id="cartItemsContainer">
                <div style="text-align:center; padding: 60px 20px; color: var(--text-muted);">
                    <div style="font-size:3rem; margin-bottom:12px;">🧺</div>
                    <p>Your basket is currently empty.</p>
                    <p style="font-size:0.8rem; margin-top:4px;">Add your favorite seafood dishes!</p>
                </div>
            </div>

            <div class="cart-footer">
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span id="subtotalVal">₱0.00</span>
                </div>
                <div class="summary-row">
                    <span>Order Fee (<span id="modeLabel">Delivery</span>)</span>
                    <span id="feeVal">₱49.00</span>
                </div>
                <div class="summary-row" id="discountRow" style="display:none; color: #4ade80;">
                    <span>Discount (20% OFF)</span>
                    <span id="discountVal">-₱0.00</span>
                </div>
                <div class="summary-row total">
                    <span>Grand Total</span>
                    <span id="grandTotalVal" style="color:var(--primary)">₱0.00</span>
                </div>
                <button class="checkout-btn" id="checkoutBtn" onclick="openCheckoutModal()" disabled>
                    Proceed to Checkout ⚡
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Checkout -->
    <div class="modal-overlay" id="checkoutModal">
        <div class="modal-box">
            <div id="checkoutFormStep">
                <h3 class="modal-title">Complete Your Order</h3>
                <p style="color:var(--text-muted); font-size:0.88rem; margin-bottom:20px;">Provide delivery or table details for instant preparation.</p>

                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-input" id="custName" placeholder="e.g. Maria Santos" required>
                </div>
                <div class="form-group">
                    <label class="form-label" id="custAddressLabel">Delivery Address</label>
                    <input type="text" class="form-input" id="custAddress" placeholder="e.g. Unit 402, Sunset Towers, Paranaque City" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Payment Method</label>
                    <select class="form-select" id="payMethod">
                        <option>GCash (Instant QR)</option>
                        <option>Maya Wallet</option>
                        <option>Cash on Delivery / Counter</option>
                        <option>Debit / Credit Card</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Discount Code</label>
                    <div style="display:flex; gap:8px;">
                        <input type="text" class="form-input" id="couponInput" placeholder="Try: SEAFOOD20" style="text-transform:uppercase;">
                        <button type="button" class="mode-btn" onclick="applyCoupon()" style="background:var(--dark-card); border:1px solid var(--border);">Apply</button>
                    </div>
                </div>

                <div style="display:flex; gap:12px; margin-top:24px;">
                    <button type="button" class="mode-btn" onclick="closeCheckoutModal()" style="flex:1;">Cancel</button>
                    <button type="button" class="checkout-btn" onclick="submitOrder()" style="flex:2;">Confirm &amp; Place Order 🚀</button>
                </div>
            </div>

            <!-- Success State -->
            <div id="checkoutSuccessStep" style="display:none;" class="success-box">
                <div class="success-icon">🎉</div>
                <h3 class="modal-title" style="color:#4ade80">Order Placed Successfully!</h3>
                <p style="color:var(--text-muted); font-size:0.9rem;">The kitchen has received your order and is preparing your seafood feast.</p>

                <div class="receipt-pill">
                    <div style="display:flex; justify-content:space-between; margin-bottom:6px;">
                        <strong>Order Reference:</strong>
                        <span id="orderRefNum" style="color:var(--primary); font-weight:700;">#TSF-9281</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; margin-bottom:6px;">
                        <strong>Customer:</strong>
                        <span id="receiptCustName">Maria Santos</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; margin-bottom:6px;">
                        <strong>Estimated Time:</strong>
                        <span>30 - 40 Minutes</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; font-size:1.05rem; margin-top:10px; padding-top:10px; border-top:1px dashed var(--border);">
                        <strong>Amount Paid:</strong>
                        <span id="receiptTotal" style="color:var(--primary); font-weight:800;">₱0.00</span>
                    </div>
                </div>

                <button class="checkout-btn" onclick="resetOrderAfterSuccess()">Order More Food</button>
            </div>
        </div>
    </div>

    <!-- Interactive Script -->
    <script>
        const DISHES = [
            {
                id: 1,
                name: "Ultimate Cajun Seafood Boil",
                cat: "buckets",
                price: 1350,
                spice: "🔥 Medium Spice",
                sauce: "Signature Cajun Butter",
                desc: "Plump mud crabs, jumbo prawns, sweet corn on the cob, clams, and smoked andouille sausage tossed in spicy garlic butter.",
                emoji: "🦞"
            },
            {
                id: 2,
                name: "Alaskan King Crab Cluster",
                cat: "crabs",
                price: 2190,
                spice: "🧄 Mild Herb",
                sauce: "Clarified Lemon Butter",
                desc: "Steamed massive sweet Alaskan king crab legs served cracked with rich herb melted butter and grilled lemons.",
                emoji: "🦀"
            },
            {
                id: 3,
                name: "Garlic Butter Tiger Prawns",
                cat: "prawns",
                price: 680,
                spice: "🧄 Roasted Garlic",
                sauce: "Golden Butter Glaze",
                desc: "500g of fresh succulent tiger prawns pan-sautéed in toasted native garlic chips, spring onions, and butter sauce.",
                emoji: "🦐"
            },
            {
                id: 4,
                name: "Crispy Calamari Rings Basket",
                cat: "prawns",
                price: 360,
                spice: "🍋 Lemon Pepper",
                sauce: "Tarragon Aioli Dip",
                desc: "Deep-fried golden squid rings dusted with crushed sea salt, accompanied by house-made spiced garlic tartar sauce.",
                emoji: "🦑"
            },
            {
                id: 5,
                name: "Char-Grilled Yellowfin Tuna Jaw",
                cat: "grilled",
                price: 540,
                spice: "🌶️ Chili Calamansi",
                sauce: "Basting Glaze",
                desc: "Meaty tuna panga marinated in sweet soy calamansi, grilled over coconut charcoal to smoky perfection.",
                emoji: "🐟"
            },
            {
                id: 6,
                name: "Whole Rock Lobster Thermidor",
                cat: "crabs",
                price: 2450,
                spice: "🧀 Creamy & Rich",
                sauce: "Gruyere & Dijon Glaze",
                desc: "Whole baked lobster tail stuffed with tender lobster meat, button mushrooms, white wine reduction, and broiled cheese.",
                emoji: "🦞"
            },
            {
                id: 7,
                name: "Fragrant Garlic Jasmine Rice",
                cat: "grilled",
                price: 95,
                spice: "🧄 Mild Toasted",
                sauce: "Crab Fat Topping",
                desc: "Heaping bowl of steaming aromatic jasmine rice wok-tossed with crispy golden garlic chips and seafood oil.",
                emoji: "🍚"
            },
            {
                id: 8,
                name: "Fresh Mango Shake / Lemonade",
                cat: "grilled",
                price: 120,
                spice: "❄️ Ice Chilled",
                sauce: "100% Real Fruit",
                desc: "Freshly blended ripe Philippine Carabao mango with crushed ice, or freshly squeezed mint kalamansi cooler.",
                emoji: "🍹"
            }
        ];

        let cart = [];
        let currentMode = 'Delivery';
        let discountApplied = 0;

        function renderMenu(category = 'all') {
            const grid = document.getElementById('menuGrid');
            const filtered = category === 'all' ? DISHES : DISHES.filter(d => d.cat === category);

            grid.innerHTML = filtered.map(dish => `
                <div class="dish-card">
                    <div class="dish-img-box">
                        <span class="dish-spice">${dish.spice}</span>
                        <div class="dish-emoji">${dish.emoji}</div>
                    </div>
                    <div class="dish-body">
                        <h4 class="dish-title">${dish.name}</h4>
                        <div class="dish-sauce">${dish.sauce}</div>
                        <p class="dish-desc">${dish.desc}</p>
                        <div class="dish-footer">
                            <div class="dish-price">₱${dish.price.toLocaleString()}</div>
                            <button class="add-cart-btn" onclick="addToCart(${dish.id})">
                                + Add to Order
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function filterMenu(cat, btn) {
            document.querySelectorAll('.cat-chip').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            renderMenu(cat);
        }

        function setMode(btn, mode) {
            document.querySelectorAll('.mode-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentMode = mode;
            document.getElementById('modeLabel').textContent = mode;
            document.getElementById('custAddressLabel').textContent = mode === 'Delivery' ? 'Delivery Address' : 'Dine-In Table Number';
            document.getElementById('custAddress').placeholder = mode === 'Delivery' ? 'e.g. Unit 402, Sunset Towers' : 'e.g. Table #8 (Ground Floor)';
            updateCartUI();
        }

        function addToCart(dishId) {
            const dish = DISHES.find(d => d.id === dishId);
            const existing = cart.find(item => item.id === dishId);
            if (existing) {
                existing.qty++;
            } else {
                cart.push({ ...dish, qty: 1 });
            }
            updateCartUI();
            toggleCart(true);
        }

        function changeQty(dishId, delta) {
            const item = cart.find(i => i.id === dishId);
            if (!item) return;
            item.qty += delta;
            if (item.qty <= 0) {
                cart = cart.filter(i => i.id !== dishId);
            }
            updateCartUI();
        }

        function updateCartUI() {
            const totalCount = cart.reduce((sum, item) => sum + item.qty, 0);
            document.getElementById('cartCountBadge').textContent = totalCount;

            const container = document.getElementById('cartItemsContainer');
            const checkoutBtn = document.getElementById('checkoutBtn');

            if (cart.length === 0) {
                container.innerHTML = `
                    <div style="text-align:center; padding: 60px 20px; color: var(--text-muted);">
                        <div style="font-size:3rem; margin-bottom:12px;">🧺</div>
                        <p>Your basket is currently empty.</p>
                        <p style="font-size:0.8rem; margin-top:4px;">Add your favorite seafood dishes!</p>
                    </div>
                `;
                checkoutBtn.disabled = true;
                document.getElementById('subtotalVal').textContent = '₱0.00';
                document.getElementById('feeVal').textContent = '₱0.00';
                document.getElementById('grandTotalVal').textContent = '₱0.00';
                return;
            }

            checkoutBtn.disabled = false;
            container.innerHTML = cart.map(item => `
                <div class="cart-item">
                    <div class="cart-item-emoji">${item.emoji}</div>
                    <div class="cart-item-info">
                        <div class="cart-item-name">${item.name}</div>
                        <div class="cart-item-price">₱${(item.price * item.qty).toLocaleString()}</div>
                    </div>
                    <div class="cart-qty-ctrl">
                        <button class="qty-btn" onclick="changeQty(${item.id}, -1)">-</button>
                        <span style="font-size:0.85rem; font-weight:700; min-width:18px; text-align:center;">${item.qty}</span>
                        <button class="qty-btn" onclick="changeQty(${item.id}, 1)">+</button>
                    </div>
                </div>
            `).join('');

            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
            const fee = currentMode === 'Delivery' ? 49 : 0;
            const discount = subtotal * discountApplied;
            const grandTotal = Math.max(0, subtotal + fee - discount);

            document.getElementById('subtotalVal').textContent = `₱${subtotal.toLocaleString()}`;
            document.getElementById('feeVal').textContent = `₱${fee.toLocaleString()}`;

            const discountRow = document.getElementById('discountRow');
            if (discountApplied > 0) {
                discountRow.style.display = 'flex';
                document.getElementById('discountVal').textContent = `-₱${discount.toLocaleString()}`;
            } else {
                discountRow.style.display = 'none';
            }

            document.getElementById('grandTotalVal').textContent = `₱${grandTotal.toLocaleString()}`;
        }

        function toggleCart(open) {
            document.getElementById('cartOverlay').classList.toggle('open', open);
        }

        function openCheckoutModal() {
            toggleCart(false);
            document.getElementById('checkoutFormStep').style.display = 'block';
            document.getElementById('checkoutSuccessStep').style.display = 'none';
            document.getElementById('checkoutModal').classList.add('open');
        }

        function closeCheckoutModal() {
            document.getElementById('checkoutModal').classList.remove('open');
        }

        function applyCoupon() {
            const code = document.getElementById('couponInput').value.trim().toUpperCase();
            if (code === 'SEAFOOD20') {
                discountApplied = 0.20;
                alert('Success! 20% discount coupon applied to your order.');
                updateCartUI();
            } else {
                alert('Invalid code. Please try SEAFOOD20');
            }
        }

        function submitOrder() {
            const name = document.getElementById('custName').value.trim();
            const addr = document.getElementById('custAddress').value.trim();
            if (!name || !addr) {
                alert('Please provide your name and delivery/table location.');
                return;
            }

            const ref = '#TSF-' + Math.floor(1000 + Math.random() * 9000);
            const totalText = document.getElementById('grandTotalVal').textContent;

            document.getElementById('orderRefNum').textContent = ref;
            document.getElementById('receiptCustName').textContent = name;
            document.getElementById('receiptTotal').textContent = totalText;

            document.getElementById('checkoutFormStep').style.display = 'none';
            document.getElementById('checkoutSuccessStep').style.display = 'block';
        }

        function resetOrderAfterSuccess() {
            cart = [];
            discountApplied = 0;
            updateCartUI();
            closeCheckoutModal();
        }

        // Initialize
        renderMenu();
    </script>
</body>
</html>
