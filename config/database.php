<?php

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Database configuration
return [
    'driver' => 'mysql',
    'host' => getenv('DB_HOST'),
    'database' => getenv('DB_DATABASE'),
    'username' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'strict' => true,
    'engine' => null,
];

// Error Handling
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    // Log error details
    error_log("[Error {$errno}] {$errstr} in {$errfile} on line {$errline}");
    // Display a user-friendly message
    echo 'Something went wrong. Please try again later.';
    exit;
});