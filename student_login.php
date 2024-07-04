<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "0806@sree";
$dbname = "eventhub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$student_username = $_POST['third'];
$student_password = $_POST['password3'];

// Prepare and bind
$stmt = $conn->prepare("SELECT * FROM student WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $student_username, $student_password);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Check if any rows are returned
if ($result->num_rows > 0) {
    // Correct credentials, redirect to studentview.html
    header("Location: studentview.html");
} else {
    // Invalid credentials, show an alert
    echo "<script>alert('Invalid username or password'); window.location.href='loginpage.html';</script>";
}

// Close connection
$stmt->close();
$conn->close();
?>
