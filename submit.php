<?php
include('./config/db.php');

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$rating = $_POST['rating'];

$sql = "INSERT INTO feedback (name, email, message, rating)
        VALUES ('$name', '$email', '$message', '$rating')";

if ($conn->query($sql)) {
    echo "<script>alert('Feedback Submitted Successfully'); window.location.href='index.php';</script>";
} else {
    echo "Error: " . $conn->error;
}
?>