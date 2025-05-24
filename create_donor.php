<?php
require_once "db.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid JSON"]);
    exit();
}

$name = $data['name'] ?? null;
$age = $data['age'] ?? null;
$blood_group = $data['blood_group'] ?? null;
$gender = $data['gender'] ?? null;
$email = $data['email'] ?? null;
$phone = $data['phone'] ?? null;
$address = $data['address'] ?? null;

if (!$name || !$age || !$blood_group || !$gender || !$address) {
    http_response_code(400);
    echo json_encode(["error" => "Missing required fields"]);
    exit();
}

$stmt = $conn->prepare("INSERT INTO donors (name, age, blood_group, gender, email, phone, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $name, $age, $blood_group, $gender, $email, $phone, $address);

if ($stmt->execute()) {
    http_response_code(201);
    echo json_encode(["success" => true, "message" => "Donor created"]);
} else {
    http_response_code(500);
    echo json_encode(["error" => $stmt->error]);
}
$stmt->close();
$conn->close();
?>
