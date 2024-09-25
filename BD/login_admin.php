<?php  
session_start();  

// Connexion à la base de données  
$servername = "localhost"; // Remplacez par votre serveur  
$username = "root"; // Remplacez par votre nom d'utilisateur  
$password = ""; // Remplacez par votre mot de passe  
$dbname = "ubalerts"; // Nom de votre base de données  

// Créer une connexion  
$conn = new mysqli($servername, $username, $password, $dbname);  

// Vérifiez la connexion  
if ($conn->connect_error) {  
    die("Échec de la connexion : " . $conn->connect_error);  
}  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    $inputPassword = $_POST['password'];  
    $inputNom = $_POST['nom'];  

    // Récupérer le mot de passe de la base de données  
    $sql = "SELECT mot_de_passe FROM admin WHERE nom = ?";  
    $stmt = $conn->prepare($sql);  
    $stmt->bind_param("s", $inputNom);  
    $stmt->execute();  
    $stmt->bind_result($adminPasswordFromDB);  
    $stmt->fetch();  
    $stmt->close();  

    // Vérifiez le mot de passe  
    if ($inputPassword === $adminPasswordFromDB) {  
        // Rediriger vers le panneau d'administration  
        header("Location: admin.php"); // Changez ceci vers l'URL de votre interface admin  
        exit();  
    } else {  
        // Mot de passe incorrect, redirigez avec un message d'erreur  
        header("Location: connexion_admin.html?error=1");  
        exit();  
    }  
}  

$conn->close();  
?>