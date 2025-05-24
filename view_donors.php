<?php
require_once 'db.php';
$result = $conn->query("SELECT * FROM donors");
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Donors</title>
    <style>
        table { border-collapse: collapse; width: 90%; margin: auto; }
        th, td { border: 1px solid #444; padding: 8px; }
        th { background-color: #ddd; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Donor List</h2>
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Age</th><th>Blood Group</th><th>Gender</th>
            <th>Email</th><th>Phone</th><th>Address</th><th>Registered At</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['age'] ?></td>
            <td><?= $row['blood_group'] ?></td>
            <td><?= $row['gender'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= $row['address'] ?></td>
            <td><?= $row['created_at'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
