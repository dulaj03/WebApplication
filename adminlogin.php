<?php
session_start();

// Database connection (adjust as needed)
$host = 'localhost';
$db = 'growsmartdb';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Fetch admin data
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_email'] = $admin['email'];

            // Redirect to admin panel
            header("Location: admin panel/index.php");
            exit();
        } else {
            echo "<script>alert('Invalid password.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Admin not found.'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>
