<?php
/**
 * Resume Image Proxy — serves Jhon Luis B. Carlos resume image
 * Self-copies to local assets on first run for reliability.
 */

$localPath = __DIR__ . '/assets/images/resume.jpg';
$sourcePath = 'C:/Users/Administrator/.gemini/antigravity-ide/brain/b96770e7-ec58-45f0-b88b-9940c81b1dfd/.user_uploaded/media_1793261741913.jpg';

// Auto-copy to local assets on first run
if (!file_exists($localPath) && file_exists($sourcePath)) {
    @copy($sourcePath, $localPath);
}

// Choose best available path
if (file_exists($localPath)) {
    $imagePath = $localPath;
} elseif (file_exists($sourcePath)) {
    $imagePath = $sourcePath;
} else {
    http_response_code(404);
    header('Content-Type: text/plain');
    exit('Resume image not found. Please place resume.jpg in assets/images/');
}

header('Content-Type: image/jpeg');
header('Content-Length: ' . filesize($imagePath));
header('Cache-Control: public, max-age=86400');
header('X-Content-Type-Options: nosniff');
readfile($imagePath);
