<?php  
$servername = "localhost";  
$username = "root"; // ou votre utilisateur MySQL  
$password = ""; // ou votre mot de passe MySQL  
$dbname = "ubalerts";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

$sql = "SELECT id, nom, numero, mot_de_passe FROM admin";
$result = $conn->query($sql);

if (!$result) {
    die("Erreur lors de l'exécution de la requête : " . $conn->error);
}

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
