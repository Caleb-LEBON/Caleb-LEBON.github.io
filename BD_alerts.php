<?php  
$servername = "localhost";  
$username = "root"; // ou votre utilisateur MySQL  
$password = ""; // ou votre mot de passe MySQL  
$dbname = "ubalerts";  

$conn = new mysqli($servername, $username, $password, $dbname);  

if ($conn->connect_error) {  
    die("Connexion échouée: " . $conn->connect_error);  
}  

if ($_SERVER['REQUEST_METHOD'] === 'GET') {  
    $sql = "SELECT * FROM alerts";  
    $result = $conn->query($sql);  

    $alerts = [];  
    while($row = $result->fetch_assoc()) {  
        $alerts[] = $row;  
    }  
    echo json_encode($users);  
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {  
    $alertsId = $_GET['id'];  
    $sql = "DELETE FROM alerts WHERE id = $alertsId";  
    $conn->query($sql);  
    echo json_encode(["status" => "success"]);  
}  

$conn->close();  
?>