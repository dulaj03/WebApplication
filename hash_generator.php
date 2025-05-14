<?php
$password = "visal1234"; // Replace with your desired password
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "Use this hash in your database: <br><code>$hash</code>";
?>