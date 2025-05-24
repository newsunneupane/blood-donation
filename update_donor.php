<?php
require_once "db.php";

$data = json_decode(file_get_contents("php://input"), true);
// Instead of:
// parse_str(file_get_contents("php://input"), $put_vars);
// $data = $put_vars;

$id = $data['id'] ?? null;
$name = $data['name'] ?? null;
$age = $data['age'] ?? null;
$blood_group = $data['blood_group'] ?? null;
$gender = $data['gender'] ?? null;
$email = $data['email'] ?? null;
$phone = $data['phone'] ?? null;
$address = $data['address'] ?? null;

if (!$id || !$name || !$age || !$blood_group || !$gender || !$address) {
    http_response_code(400);
    echo json_encode(["error" => "Missing required fields"]);
    exit();
}

$stmt = $conn->prepare("UPDATE donors SET name=?, age=?, blood_group=?, gender=?, email=?, phone=?, address=? WHERE id=?");
$stmt->bind_param("sisssssi", $name, $age, $blood_group, $gender, $email, $phone, $address, $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Donor updated"]);
} else {
    http_response_code(500);
    echo json_encode(["error" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
