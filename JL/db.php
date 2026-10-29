<?php
/**
 * Database Connection File (db.php)
 * Configures the PDO connection to MySQL/MariaDB in XAMPP.
 * 
 * NOTE: As required, ALL SQL queries are kept outside of index.php.
 * This file handles only the connection instance.
 */

// XAMPP Default Database Credentials
$db_host = 'localhost';
$db_port = '3306';
$db_name = 'student_portfolio';
$db_user = 'root';
$db_pass = ''; // Default XAMPP password is blank

$pdo = null;
$db_connected = false;
$db_error_message = null;

try {
    $dsn = "mysql:host={$db_host};port={$db_port};dbname={$db_name};charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::ATTR_TIMEOUT            => 3,
    ];

    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
    $db_connected = true;
} catch (PDOException $e) {
    // If the database does not exist yet or MySQL service is starting up,
    // we capture the message gracefully so index.php remains functional
    // and can guide the user to run setup.php or import database.sql.
    $db_connected = false;
    $db_error_message = $e->getMessage();
}

/**
 * Helper to get active PDO instance or null
 * @return PDO|null
 */
function getDbConnection() {
    global $pdo;
    return $pdo;
}

/**
 * Check if the database connection is currently alive
 * @return bool
 */
function isDbConnected() {
    global $db_connected;
    return $db_connected;
}
