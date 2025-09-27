<?php
$servername = "sqlXXX.infinityfree.com"; // apna host yaha dalna hoga
$username   = "if0_40022389";            // apna MySQL username
$password   = "YOUR_DB_PASSWORD";        // apna MySQL password
$dbname     = "if0_40022389_Reg_user";   // database ka naam

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<div class='alert alert-danger'>Database connection failed</div>");
}

// Get form data safely
$name          = $conn->real_escape_string($_POST['name']);
$email         = $conn->real_escape_string($_POST['email']);
$mobile        = $conn->real_escape_string($_POST['mobile']);
$password      = $conn->real_escape_string($_POST['password']);
$conf_password = $conn->real_escape_string($_POST['conf_password']);

// Validate passwords
if ($password !== $conf_password) {
    echo "<div class='alert alert-danger'>Passwords do not match</div>";
    exit;
}

// Hash password before saving (security)
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Insert into DB
$sql = "INSERT INTO reg_user (name, email, mobile, password, conf_password) 
        VALUES ('$name', '$email', '$mobile', '$hashed_password', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "<div class='alert alert-success'>Registration successful ✅</div>";
} else {
    echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
}

$conn->close();
?>
