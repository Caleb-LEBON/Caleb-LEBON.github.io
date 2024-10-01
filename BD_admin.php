<?php  
$servername = "localhost";  
$username = "root"; // ou votre utilisateur MySQL  
$password = ""; // ou votre mot de passe MySQL  
$dbname = "ubalerts";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête SQL pour récupérer les administrateurs
$sql = "SELECT id, nom, email FROM admins";
$result = $conn->query($sql);

$admins = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $admins[] = $row;
    }
} else {
    echo json_encode([]);
    exit();
}

echo json_encode($admins);

$conn->close();
?>

$conn->close();  
?>