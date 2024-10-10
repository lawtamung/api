<?php
header("Content-Type: application/json");

$servername = "sql212.infinityfree.com";
$username = "if0_37461381";
$password = "bboXdumcqoZPyEE";
$dbname = "if0_37461381_paramat";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"));

$email = $data->email;
$password = $data->password;

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        echo json_encode(array("message" => "Login successful"));
    } else {
        echo json_encode(array("message" => "Incorrect password"));
    }
} else {
    echo json_encode(array("message" => "User not found"));
}

$conn->close();
?>
