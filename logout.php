<?php
// Start the session
session_start();

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Send JSON response
header('Content-Type: application/json');
echo json_encode(['success' => true]);
exit();
?>
