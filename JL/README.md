# ⚡ IT Student Portfolio Project (Neon Blue Theme)

A modern, high-aesthetic portfolio website designed for **Information Technology (IT) students**. Built with **PHP** and **MySQL/MariaDB**, styled with a custom **Neon Blue (`#00f3ff`) cyber aesthetic**, and architected with a strict separation of concerns (**Zero SQL in `index.php`**).

---

## 🎨 Latest Architecture & Design Highlights

1. **Profile Picture Frame:**
   - Features a glowing Neon Blue avatar with an ambient rotating cyber ring effect in the Hero section.
2. **Technical Skills Section (Structured Same as Projects):**
   - Features category filter buttons, cyber illustration preview banners, tech tags, proficiency progress bars, and credential badges.
3. **Dedicated Visual Image Preview for Each Project:**
   - **Tapseafood: Online Food Ordering** &mdash; Seafood menu items, live ordering UI, and shopping cart.
   - **Hotel Online Booking Management** &mdash; Room suite booking calendar, availability grid, and pricing cards.
   - **Arduino Water Dispenser** &mdash; Microcontroller circuit layout, ultrasonic distance sensor, and contactless liquid dispensing.
4. **Maintained Clean Code Standard (Strict Zero SQL in `index.php`):**
   - [`index.php`](file:///c:/xampp/htdocs/JL/index.php) handles presentation only.
   - All PDO queries and prepared statements reside in [`portfolio_data.php`](file:///c:/xampp/htdocs/JL/portfolio_data.php) and [`database.sql`](file:///c:/xampp/htdocs/JL/database.sql).

---

## 📁 File Structure

```
c:\xampp\htdocs\JL\
│
├── index.php             # Presentation layer ONLY (zero SQL queries, renders data loops)
├── db.php                # PDO MySQL connection setup & health-check
├── portfolio_data.php    # ALL SQL queries (SELECT profile, projects, INSERT messages)
├── contact_handler.php   # Processes AJAX contact form via portfolio_data.php
├── database.sql          # Complete MySQL schema (tables & sample IT student seed data)
├── setup.php             # 1-Click web installer to create DB and tables automatically
│
└── assets/
    ├── css/
    │   └── style.css     # Neon Blue styling, glowing avatar frame, responsive project cards
    ├── js/
    │   └── main.js       # Dynamic typing, filter tabs, AJAX contact form
    └── images/
        ├── profile.svg   # Vector avatar asset
        ├── profile.jpg   # High-resolution IT student portrait
        └── projects/
            ├── tapseafood.jpg / tapseafood.svg
            ├── hotel_booking.jpg / hotel_booking.svg
            └── arduino_dispenser.svg
```

---

## 🚀 How to Run in XAMPP

### Step 1: Start XAMPP
1. Open the **XAMPP Control Panel**.
2. Click **Start** for both **Apache** and **MySQL**.

### Step 2: Initialize Database (Choose either Method A or B)

#### Method A: 1-Click Web Setup (Easiest)
1. Open your web browser.
2. Visit: `http://localhost/JL/setup.php`
3. Click **"⚡ Click Here to Initialize Database"**.
4. The script will automatically connect to MySQL, create the `student_portfolio` database, initialize all tables, and insert the projects and profile data.
5. Click **"🚀 Open Neon Blue Portfolio"**.

#### Method B: phpMyAdmin Manual Import
1. Go to `http://localhost/phpmyadmin/`.
2. Click on the **Import** tab.
3. Choose the file `database.sql` located inside `C:\xampp\htdocs\JL\database.sql`.
4. Click **Go** / **Import**.

### Step 3: View the Portfolio
Visit:
```
http://localhost/JL/
```
