<?php
header("Content-Type: application/json");

$servername = "sql212.infinityfree.com";
$username = "if0_37461381";
$password = "bboXdumcqoZPyEE";
$dbname = "if0_37461381_api";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"));

$email = $data->email;
$password = password_hash($data->password, PASSWORD_BCRYPT);

$sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("message" => "User registered successfully"));
} else {
    echo json_encode(array("message" => "Error: " . $conn->error));
}

$conn->close();
?>
