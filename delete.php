<?php
include 'BD_connexion.php';

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$type = $data['type'];

if ($type == 'user') {
    $query = "DELETE FROM utilisateurs WHERE id = :num LIMIT 1";
} elseif ($type == 'admin') {
    $query = "DELETE FROM admin WHERE id = :num LIMIT 1";
} else {
    echo json_encode(['success' => false]);
    exit;
}

$stmt = $conn->prepare($query);
$stmt->bindParam(':num', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

$stmt->closeCursor();
$conn = null;
?>