<?php  
// Inclure le fichier de connexion à la base de données  
include 'BD_utilisateurs.php';  

// Récupérer les données JSON envoyées via POST  
$data = json_decode(file_get_contents('php://input'), true);  
$id = $data['id'];  
$type = $data['type'];  

if ($type == 'user') {  
    $query = "DELETE FROM utilisateurs WHERE id = ?";  
} elseif ($type == 'admin') {  
    $query = "DELETE FROM administrateurs WHERE id = ?";  
} else {  
    echo json_encode(['success' => false]);  
    exit;  
}  

$stmt = $conn->prepare($query);  
$stmt->bind_param("i", $id);  

if ($stmt->execute()) {  
    echo json_encode(['success' => true]);  
} else {  
    echo json_encode(['success' => false]);  
}  

$stmt->close();  
$conn->close();  
?>