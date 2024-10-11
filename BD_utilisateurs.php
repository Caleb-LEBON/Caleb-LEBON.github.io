<?php  
$servername = "localhost";  
$username = "root"; // ou votre utilisateur MySQL  
$password = ""; // ou votre mot de passe MySQL  
$dbname = "ubalerts";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête SQL pour récupérer les utilisateurs
$sql = "SELECT id, nom, telephone FROM utilisateurs";
$result = $conn->query($sql);

$utilisateurs = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $utilisateurs[] = $row;
    }
} else {
    echo json_encode([]);
    exit();
}

echo json_encode($utilisateurs);

$conn->close();
?>