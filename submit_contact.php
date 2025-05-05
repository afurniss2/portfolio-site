<?php
$conn = new mysqli("localhost", "root", "root", "assignmentdb");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$name = $_POST["name"];
$email = $_POST["email"];
$content = $_POST["content"];

$stmt = $conn->prepare("INSERT INTO messages (name, email, content) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $content);
$stmt->execute();

echo "success";

$stmt->close();
$conn->close();
?>