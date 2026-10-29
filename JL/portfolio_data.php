<?php
/**
 * Portfolio Data Access Layer (portfolio_data.php)
 * 
 * ALL SQL queries and database operations are encapsulated in this file.
 * index.php only calls these functions and NEVER contains raw SQL statements.
 */

require_once __DIR__ . '/db.php';

// Auto-sync project images and profile picture from generator and user upload cache
(function() {
    $img_dir = __DIR__ . '/assets/images';
    $proj_dir = $img_dir . '/projects';

    if (!is_dir($proj_dir)) {
        @mkdir($proj_dir, 0777, true);
    }

    // User's provided profile portrait
    $user_uploaded = 'C:/Users/Administrator/.gemini/antigravity-ide/brain/33cd8bf0-fc6e-4ed0-b413-c5ad9c48b7fc/.user_uploaded/media_1792767192047.png';
    if (file_exists($user_uploaded)) {
        @copy($user_uploaded, $img_dir . '/profile.png');
        @copy($user_uploaded, $img_dir . '/profile.jpg');
    }

    $copy_map = [
        'C:/Users/Administrator/.gemini/antigravity-ide/brain/33cd8bf0-fc6e-4ed0-b413-c5ad9c48b7fc/project_tapseafood_1792766309783.jpg'    => $proj_dir . '/tapseafood.jpg',
        'C:/Users/Administrator/.gemini/antigravity-ide/brain/33cd8bf0-fc6e-4ed0-b413-c5ad9c48b7fc/project_hotel_booking_1792766328915.jpg' => $proj_dir . '/hotel_booking.jpg'
    ];

    foreach ($copy_map as $source => $dest) {
        if (!file_exists($dest) && file_exists($source)) {
            @copy($source, $dest);
        }
    }

    // Auto-sync interview video to assets/videos/
    $video_dir = __DIR__ . '/assets/videos';
    if (!is_dir($video_dir)) {
        @mkdir($video_dir, 0777, true);
    }
    if (!file_exists($video_dir . '/jl.mp4') && file_exists(__DIR__ . '/jl.mp4')) {
        @copy(__DIR__ . '/jl.mp4', $video_dir . '/jl.mp4');
    }
})();

/**
 * Helper to get verified project image (falls back to SVG if JPG is missing)
 * 
 * @param string $path
 * @param string $fallback_svg
 * @return string
 */
function resolveProjectImage($path, $fallback_svg) {
    if (!empty($path) && file_exists(__DIR__ . '/' . $path)) {
        return $path;
    }
    return $fallback_svg;
}

/**
 * Retrieve the student's profile information
 * Executes SQL: SELECT * FROM profile_info LIMIT 1
 * 
 * @return array
 */
function getStudentProfile() {
    $pdo = getDbConnection();

    if ($pdo && isDbConnected()) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM `profile_info` ORDER BY `id` ASC LIMIT 1");
            $stmt->execute();
            $profile = $stmt->fetch();
            if ($profile) {
                // Ensure profile image path is valid
                if (empty($profile['profile_image']) || (!file_exists(__DIR__ . '/' . $profile['profile_image']) && !file_exists(__DIR__ . '/assets/images/profile.jpg'))) {
                    $profile['profile_image'] = 'assets/images/profile.svg';
                }
                $profile['source'] = 'mysql';
                return $profile;
            }
        } catch (PDOException $e) {
            // Fallback handled below
        }
    }

    $image_path = file_exists(__DIR__ . '/assets/images/profile.jpg') ? 'assets/images/profile.jpg' : 'assets/images/profile.svg';

    // Default Fallback Data (Synced with John Luis Carlos details)
    return [
        'full_name'      => 'John Luis Carlos',
        'headline'       => 'IT Student & Aspiring Full-Stack Developer',
        'sub_headline'   => 'Specializing in Web Development, Database Management & IoT Systems',
        'bio_summary'    => 'Motivated 4th Year Information Technology student passionate about building real-world software, relational database architectures, and smart embedded hardware.',
        'about_details'  => "I am currently pursuing a Bachelor of Science in Information Technology (BSIT) at Datamex College of Saint Adeline. My primary technical focus includes database design, full-stack web applications, and microcontroller-based automation.\n\nI actively apply my software engineering coursework into functional projects that solve everyday campus and industry challenges, such as restaurant food ordering platforms, centralized hotel booking systems, and sensor-driven touchless dispensers.",
        'profile_image'  => $image_path,
        'email'          => 'johnluis1@gmail.com',
        'phone'          => '+639105428974',
        'location'       => 'Paranaque / Metro Manila',
        'university'     => 'Datamex College of Saint Adeline',
        'degree_program' => 'Bachelor of Science in Information Technology (BSIT)',
        'year_level'     => '4th Year Undergraduate',
        'status_badge'   => 'Open for OJT / Internship',
        'github_url'     => 'https://github.com',
        'linkedin_url'   => 'https://linkedin.com',
        'source'         => 'fallback'
    ];
}

/**
 * Retrieve Technical Skills (Structured same as Projects with visual banners & metadata)
 * Executes SQL: SELECT * FROM skills ORDER BY sort_order ASC, id ASC
 * 
 * @return array
 */
function getSkillsList() {
    $pdo = getDbConnection();

    if ($pdo && isDbConnected()) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM `skills` ORDER BY `sort_order` ASC, `id` ASC");
            $stmt->execute();
            $skills = $stmt->fetchAll();
            if (!empty($skills)) {
                foreach ($skills as &$skill) {
                    if (strpos($skill['title'], 'Web') !== false) {
                        $skill['image_url'] = resolveProjectImage($skill['image_url'] ?? '', 'assets/images/skills/web_development.svg');
                    } elseif (strpos($skill['title'], 'Database') !== false) {
                        $skill['image_url'] = resolveProjectImage($skill['image_url'] ?? '', 'assets/images/skills/database_systems.svg');
                    } elseif (strpos($skill['title'], 'IoT') !== false || strpos($skill['title'], 'Arduino') !== false) {
                        $skill['image_url'] = resolveProjectImage($skill['image_url'] ?? '', 'assets/images/skills/iot_microcontrollers.svg');
                    } else {
                        $skill['image_url'] = resolveProjectImage($skill['image_url'] ?? '', 'assets/images/skills/networking_systems.svg');
                    }
                }
                return $skills;
            }
        } catch (PDOException $e) {
            // Fallback handled below
        }
    }

    // Default Fallback Skills (Structured identically to projects)
    return [
        [
            'id' => 1,
            'title' => 'Full-Stack Web Development',
            'category' => 'Web & E-Commerce',
            'tagline' => 'Modern client-server web apps, responsive UI & secure backend systems',
            'proficiency' => 92,
            'level_label' => 'Advanced',
            'description' => 'Architecting high-performance dynamic web applications using PHP, JavaScript, and modular CSS. Experienced with RESTful principles, session handling, asynchronous UI updates, and production deployment on Apache/XAMPP.',
            'tech_stack' => 'PHP 8, JavaScript (ES6+), HTML5, CSS3, AJAX, REST APIs',
            'image_url' => 'assets/images/skills/web_development.svg',
            'badge' => 'Primary Stack',
            'sort_order' => 1
        ],
        [
            'id' => 2,
            'title' => 'Relational Database Architecture',
            'category' => 'Database Systems',
            'tagline' => 'Normalized SQL schemas, PDO prepared statements & data integrity',
            'proficiency' => 90,
            'level_label' => 'Advanced',
            'description' => 'Designing relational databases with optimal indexing, referential integrity, and 3NF normalization. Proficient in crafting robust PDO prepared statements that eliminate SQL injection and streamline reporting queries.',
            'tech_stack' => 'MySQL, MariaDB, PDO Prepared Statements, SQL, Database Normalization',
            'image_url' => 'assets/images/skills/database_systems.svg',
            'badge' => 'Core Specialty',
            'sort_order' => 2
        ],
        [
            'id' => 3,
            'title' => 'IoT & Microcontroller Systems',
            'category' => 'IoT & Embedded Systems',
            'tagline' => 'Sensors, relays, embedded C++ & hardware automation integration',
            'proficiency' => 86,
            'level_label' => 'Proficient',
            'description' => 'Prototyping physical computing solutions connecting microcontrollers (Arduino) with ultrasonic sensors, solenoid valves, and relays to automate real-time physical mechanisms and hygiene safety systems.',
            'tech_stack' => 'Arduino C++, Ultrasonic Sensors, 5V Relays, DC Solenoids, Circuit Prototyping',
            'image_url' => 'assets/images/skills/iot_microcontrollers.svg',
            'badge' => 'Hardware & Automation',
            'sort_order' => 3
        ],
        [
            'id' => 4,
            'title' => 'Systems Servicing & Networking',
            'category' => 'Networking & Hardware',
            'tagline' => 'LAN configurations, OS deployment & hardware diagnostics (NC II Certified)',
            'proficiency' => 88,
            'level_label' => 'NC II Certified',
            'description' => 'Configuring local area networks, router configurations, structured cabling, client workstation deployment, and preventive hardware maintenance certified under TESDA National Certificate II (NC II).',
            'tech_stack' => 'Computer Systems Servicing, TESDA NC II, LAN Setup, Router Config, Hardware Diagnostics',
            'image_url' => 'assets/images/skills/networking_systems.svg',
            'badge' => 'Certified NC II',
            'sort_order' => 4
        ]
    ];
}

/**
 * Retrieve Projects (Strictly limited to the 3 required projects with images)
 * Executes SQL: SELECT * FROM projects ORDER BY id ASC
 * 
 * @return array
 */
function getProjectsList() {
    $pdo = getDbConnection();

    if ($pdo && isDbConnected()) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM `projects` ORDER BY `id` ASC");
            $stmt->execute();
            $projects = $stmt->fetchAll();
            if (!empty($projects)) {
                // Verify image paths and wire demo URLs
                foreach ($projects as &$proj) {
                    if (strpos($proj['title'], 'Tapseafood') !== false) {
                        $proj['image_url'] = resolveProjectImage($proj['image_url'] ?? '', 'assets/images/projects/tapseafood.svg');
                        $proj['demo_url']  = 'demos/tapseafood/';
                    } elseif (strpos($proj['title'], 'Hotel') !== false) {
                        $proj['image_url'] = resolveProjectImage($proj['image_url'] ?? '', 'assets/images/projects/hotel_booking.svg');
                        $proj['demo_url']  = 'demos/hotel/';
                    } else {
                        $proj['image_url'] = resolveProjectImage($proj['image_url'] ?? '', 'assets/images/projects/arduino_dispenser.svg');
                        $proj['demo_url']  = 'demos/arduino/';
                    }
                }
                return $projects;
            }
        } catch (PDOException $e) {
            // Fallback handled below
        }
    }

    $tapseafood_img = resolveProjectImage('assets/images/projects/tapseafood.jpg', 'assets/images/projects/tapseafood.svg');
    $hotel_img      = resolveProjectImage('assets/images/projects/hotel_booking.jpg', 'assets/images/projects/hotel_booking.svg');
    $arduino_img    = 'assets/images/projects/arduino_dispenser.svg';

    // Default Fallback Projects (Only the 3 requested projects with images)
    return [
        [
            'id' => 1,
            'title' => 'Tapseafood: Online Food Ordering',
            'category' => 'Web & E-Commerce',
            'tagline' => 'Specialized seafood takeout, table pre-ordering & delivery web application',
            'description' => 'A full-featured online food ordering platform tailored for seafood dining. Includes interactive menu categorization, real-time cart computation, customized cooking requests (e.g., garlic butter, cajun spice), checkout invoice generation, and customer order tracking.',
            'tech_stack' => 'PHP, MySQL, JavaScript, CSS3, HTML5',
            'image_url' => $tapseafood_img,
            'demo_url' => 'demos/tapseafood/',
            'repo_url' => 'https://github.com',
            'featured' => 1,
            'created_date' => '2026'
        ],
        [
            'id' => 2,
            'title' => 'Hotel Online Booking Management',
            'category' => 'Database Systems',
            'tagline' => 'Enterprise room reservation, guest check-in & occupancy management portal',
            'description' => 'A robust database-driven hotel management system designed to streamline room reservations. Features live room availability calendars, tiered room pricing, guest registration with booking history, invoice generation, and an administrative occupancy analytics dashboard.',
            'tech_stack' => 'PHP, MySQL, PDO Prepared Statements, AJAX, CSS3',
            'image_url' => $hotel_img,
            'demo_url' => 'demos/hotel/',
            'repo_url' => 'https://github.com',
            'featured' => 1,
            'created_date' => '2025'
        ],
        [
            'id' => 3,
            'title' => 'Arduino Water Dispenser',
            'category' => 'IoT & Embedded Systems',
            'tagline' => 'Automated contactless liquid dispensing mechanism powered by microcontroller sensors',
            'description' => 'A hands-free automated water dispenser prototype built to promote hygiene in campus facilities. Utilizes an Arduino microcontroller paired with ultrasonic distance detection, a 5V relay module, and a 12V DC solenoid valve to pour precise volumes while preventing container overflow.',
            'tech_stack' => 'Arduino C++, Ultrasonic Sensor, 5V Relay, DC Solenoid, Microcontroller',
            'image_url' => $arduino_img,
            'demo_url' => 'demos/arduino/',
            'repo_url' => 'https://github.com',
            'featured' => 1,
            'created_date' => '2025'
        ]
    ];
}

/**
 * Save incoming contact message from the portfolio visitor
 * Executes SQL: INSERT INTO contact_messages (name, email, subject, message, ip_address) VALUES (...)
 * 
 * @param string $name
 * @param string $email
 * @param string $subject
 * @param string $message
 * @return array ['success' => bool, 'message' => string]
 */
function saveContactMessage($name, $email, $subject, $message) {
    $name = trim($name);
    $email = trim($email);
    $subject = trim($subject);
    $message = trim($message);

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        return ['success' => false, 'message' => 'All fields are required. Please complete the form.'];
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['success' => false, 'message' => 'Please provide a valid email address.'];
    }

    $pdo = getDbConnection();

    if (!$pdo || !isDbConnected()) {
        return [
            'success' => true,
            'message' => 'Thank you for your message, ' . htmlspecialchars($name) . '! (Message received in demonstration mode).'
        ];
    }

    try {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        $sql = "INSERT INTO `contact_messages` (`name`, `email`, `subject`, `message`, `ip_address`) 
                VALUES (:name, :email, :subject, :message, :ip)";
        
        $stmt = $pdo->prepare($sql);
        $executed = $stmt->execute([
            ':name'    => $name,
            ':email'   => $email,
            ':subject' => $subject,
            ':message' => $message,
            ':ip'      => $ip
        ]);

        if ($executed) {
            return ['success' => true, 'message' => 'Transmission successful! Your message has been saved to the database.'];
        } else {
            return ['success' => false, 'message' => 'Unable to record message due to a database error. Please try again.'];
        }
    } catch (PDOException $e) {
        return ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
    }
}
