-- ========================================================
-- Database Schema for IT Student Portfolio Website
-- Database Name: student_portfolio
-- Primary Color Theme: Neon Blue (#00f3ff)
-- ========================================================

CREATE DATABASE IF NOT EXISTS `student_portfolio` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `student_portfolio`;

-- 1. Profile Information Table
DROP TABLE IF EXISTS `profile_info`;
CREATE TABLE `profile_info` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `full_name` VARCHAR(100) NOT NULL,
  `headline` VARCHAR(150) NOT NULL,
  `sub_headline` VARCHAR(255) NOT NULL,
  `bio_summary` TEXT NOT NULL,
  `about_details` TEXT NOT NULL,
  `profile_image` VARCHAR(255) DEFAULT 'assets/images/profile.jpg',
  `email` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(30) NOT NULL,
  `location` VARCHAR(100) NOT NULL,
  `university` VARCHAR(150) NOT NULL,
  `degree_program` VARCHAR(150) NOT NULL,
  `year_level` VARCHAR(50) NOT NULL,
  `status_badge` VARCHAR(50) DEFAULT 'Available for Internship',
  `github_url` VARCHAR(255) DEFAULT 'https://github.com',
  `linkedin_url` VARCHAR(255) DEFAULT 'https://linkedin.com',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed Profile Data
INSERT INTO `profile_info` (
  `full_name`, `headline`, `sub_headline`, `bio_summary`, `about_details`,
  `profile_image`, `email`, `phone`, `location`, `university`, `degree_program`, `year_level`,
  `status_badge`, `github_url`, `linkedin_url`
) VALUES (
  'John Luis Carlos',
  'IT Student & Aspiring Full-Stack Developer',
  'Specializing in Web Development, Database Management & IoT Systems',
  'Motivated 4th Year Information Technology student passionate about building real-world software, relational database architectures, and smart embedded hardware.',
  'I am currently pursuing a Bachelor of Science in Information Technology (BSIT). My primary technical focus includes database design, full-stack web applications, and microcontroller-based automation. I actively apply my software engineering coursework into functional projects that solve everyday campus and industry challenges.',
  'assets/images/profile.jpg',
  'johnluis1@gmail.com',
  '+639105428974',
  'Paranaque / Metro Manila',
  'Datamex College of Saint Adeline',
  'Bachelor of Science in Information Technology (BSIT)',
  '4th Year Undergraduate',
  'Open for OJT / Internship',
  'https://github.com',
  'https://linkedin.com'
);

-- 2. Skills Table (Mirrors Projects structure with visual cards & categories)
DROP TABLE IF EXISTS `skills`;
CREATE TABLE `skills` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(120) NOT NULL,
  `category` VARCHAR(60) NOT NULL,
  `tagline` VARCHAR(150) NOT NULL,
  `proficiency` INT NOT NULL DEFAULT 90,
  `level_label` VARCHAR(50) NOT NULL DEFAULT 'Advanced',
  `description` TEXT NOT NULL,
  `tech_stack` VARCHAR(255) NOT NULL,
  `image_url` VARCHAR(255) DEFAULT 'assets/images/skills/web_development.svg',
  `badge` VARCHAR(50) DEFAULT 'Core IT Competency',
  `sort_order` INT DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed The 4 Core IT Skills (Structured Same as Projects)
INSERT INTO `skills` (`title`, `category`, `tagline`, `proficiency`, `level_label`, `description`, `tech_stack`, `image_url`, `badge`, `sort_order`) VALUES
(
  'Full-Stack Web Development',
  'Web & E-Commerce',
  'Modern client-server web apps, responsive UI & secure backend systems',
  92,
  'Advanced',
  'Architecting high-performance dynamic web applications using PHP, JavaScript, and modular CSS. Experienced with RESTful principles, session handling, asynchronous UI updates, and production deployment on Apache/XAMPP.',
  'PHP 8, JavaScript (ES6+), HTML5, CSS3, AJAX, REST APIs',
  'assets/images/skills/web_development.svg',
  'Primary Stack',
  1
),
(
  'Relational Database Architecture',
  'Database Systems',
  'Normalized SQL schemas, PDO prepared statements & data integrity',
  90,
  'Advanced',
  'Designing relational databases with optimal indexing, referential integrity, and 3NF normalization. Proficient in crafting robust PDO prepared statements that eliminate SQL injection and streamline reporting queries.',
  'MySQL, MariaDB, PDO Prepared Statements, SQL, Database Normalization',
  'assets/images/skills/database_systems.svg',
  'Core Specialty',
  2
),
(
  'IoT & Microcontroller Systems',
  'IoT & Embedded Systems',
  'Sensors, relays, embedded C++ & hardware automation integration',
  86,
  'Proficient',
  'Prototyping physical computing solutions connecting microcontrollers (Arduino) with ultrasonic sensors, solenoid valves, and relays to automate real-time physical mechanisms and hygiene safety systems.',
  'Arduino C++, Ultrasonic Sensors, 5V Relays, DC Solenoids, Circuit Prototyping',
  'assets/images/skills/iot_microcontrollers.svg',
  'Hardware & Automation',
  3
),
(
  'Systems Servicing & Networking',
  'Networking & Hardware',
  'LAN configurations, OS deployment & hardware diagnostics (NC II Certified)',
  88,
  'NC II Certified',
  'Configuring local area networks, router configurations, structured cabling, client workstation deployment, and preventive hardware maintenance certified under TESDA National Certificate II (NC II).',
  'Computer Systems Servicing, TESDA NC II, LAN Setup, Router Config, Hardware Diagnostics',
  'assets/images/skills/networking_systems.svg',
  'Certified NC II',
  4
);

-- 3. Projects Table (Strictly Contains The Specified IT Projects)
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(120) NOT NULL,
  `category` VARCHAR(60) NOT NULL,
  `tagline` VARCHAR(150) NOT NULL,
  `description` TEXT NOT NULL,
  `tech_stack` VARCHAR(255) NOT NULL,
  `demo_url` VARCHAR(255) DEFAULT '#',
  `repo_url` VARCHAR(255) DEFAULT 'https://github.com',
  `featured` TINYINT(1) DEFAULT 1,
  `created_date` VARCHAR(50) DEFAULT '2026'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed The 3 Required Projects
INSERT INTO `projects` (`title`, `category`, `tagline`, `description`, `tech_stack`, `demo_url`, `repo_url`, `featured`, `created_date`) VALUES
(
  'Tapseafood: Online Food Ordering',
  'Web & E-Commerce',
  'Specialized seafood takeout, table pre-ordering & delivery web application',
  'A full-featured online food ordering platform tailored for seafood dining. Includes interactive menu categorization, real-time cart computation, customized cooking requests (e.g., garlic butter, cajun spice), checkout invoice generation, and customer order tracking.',
  'PHP, MySQL, JavaScript, CSS3, HTML5',
  'demos/tapseafood/',
  'https://github.com',
  1,
  '2026'
),
(
  'Hotel Online Booking Management',
  'Database Systems',
  'Enterprise room reservation, guest check-in & occupancy management portal',
  'A robust database-driven hotel management system designed to streamline room reservations. Features live room availability calendars, tiered room pricing, guest registration with booking history, invoice generation, and an administrative occupancy analytics dashboard.',
  'PHP, MySQL, PDO Prepared Statements, AJAX, CSS3',
  'demos/hotel/',
  'https://github.com',
  1,
  '2025'
),
(
  'Arduino Water Dispenser',
  'IoT & Embedded Systems',
  'Automated contactless liquid dispensing mechanism powered by microcontroller sensors',
  'A hands-free automated water dispenser prototype built to promote hygiene in campus facilities. Utilizes an Arduino microcontroller paired with ultrasonic distance detection, a 5V relay module, and a 12V DC solenoid valve to pour precise volumes while preventing container overflow.',
  'Arduino C++, Ultrasonic Sensor, 5V Relay, DC Solenoid, Microcontroller',
  'demos/arduino/',
  'https://github.com',
  1,
  '2025'
);

-- 3. Education & Academic Milestones Table
DROP TABLE IF EXISTS `education`;
CREATE TABLE `education` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `institution` VARCHAR(150) NOT NULL,
  `degree_title` VARCHAR(150) NOT NULL,
  `period` VARCHAR(60) NOT NULL,
  `gpa` VARCHAR(30) NOT NULL,
  `highlights` TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed Education
INSERT INTO `education` (`institution`, `degree_title`, `period`, `gpa`, `highlights`) VALUES
('Datamex College of Saint Adeline', 'Bachelor of Science in Information Technology (BSIT)', '2023 - Present (Expected 2027)', 'Dean\'s Lister (3.85 / 4.0 GPA)', 'Focusing on Database Management Systems, Web Applications, and Microcontroller Systems. Active contributor to student software development exhibits.'),
('Tech Valley Senior High School', 'TVL Track - Information and Communications Technology', '2021 - 2023', 'With High Honors', 'Graduated Top 5% with National Certificate II (NC II) in Computer Systems Servicing.');

-- 4. Certifications Table
DROP TABLE IF EXISTS `certifications`;
CREATE TABLE `certifications` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `cert_name` VARCHAR(150) NOT NULL,
  `issuing_org` VARCHAR(120) NOT NULL,
  `issue_date` VARCHAR(50) NOT NULL,
  `credential_id` VARCHAR(100) DEFAULT 'VERIFIED-IT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed Certifications
INSERT INTO `certifications` (`cert_name`, `issuing_org`, `issue_date`, `credential_id`) VALUES
('Database Design & SQL Foundations', 'Oracle Academy / Certiport', '2025', 'ORA-SQL-98214'),
('Web Development & Responsive UI Certification', 'freeCodeCamp', '2025', 'FCC-WD-78103'),
('Introduction to IoT & Cisco Microcontrollers', 'Cisco Networking Academy', '2024', 'CSCO-IOT-45210');

-- 5. Contact Inquiries Table
DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE `contact_messages` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `subject` VARCHAR(150) NOT NULL,
  `message` TEXT NOT NULL,
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample Received Message
INSERT INTO `contact_messages` (`name`, `email`, `subject`, `message`, `ip_address`) VALUES
('Campus Career Center', 'recruiter@techcorppartners.com', 'Internship Opportunity: Junior Web & Systems Developer', 'Hi Alex, we reviewed your projects including Tapseafood and the Arduino Water Dispenser, and would love to discuss an internship interview.', '127.0.0.1');

-- 6. Administrator Users Table
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `full_name` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed Admin User: johncarlos / johncarlos123
INSERT INTO `admin_users` (`username`, `password`, `full_name`) VALUES
('johncarlos', 'johncarlos123', 'John Luis Carlos');

