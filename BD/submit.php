<?php  
// Informations de connexion à la base de données  
$servername = "localhost";  
$username = "root"; // Utilisateur par défaut pour XAMPP  
$password = ""; // Laissez vide si vous n'avez pas défini de mot de passe  
$dbname = "ubalerts"; // Assurez-vous que le nom de la base de données est correct  

// Créer une connexion  
$conn = new mysqli($servername, $username, $password, $dbname);  

// Vérifier la connexion  
if ($conn->connect_error) {  
    die("Erreur de connexion: " . $conn->connect_error);  
}  

// Vérifier si le formulaire a été soumis  
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    // Valider et échapper les données d'entrée  
    $nom = $conn->real_escape_string(trim($_POST['nom']));  
    $telephone = $conn->real_escape_string(trim($_POST['telephone']));  

    // Préparer et lier  
    $stmt = $conn->prepare("INSERT INTO utilisateurs (nom, telephone) VALUES (?, ?)");  

    if ($stmt) {  
        $stmt->bind_param("ss", $nom, $telephone);  

        // Exécuter la requête  
        if ($stmt->execute()) {  
            // Rediriger vers la page de succès après l'inscription  
            header("Location: success.php"); // Remplacez "success.php" par le chemin correct si nécessaire  
            exit(); // Assurez-vous d'arrêter le script après la redirection  
        } else {  
            echo "Impossible de créer un compte: " . $stmt->error;  
        }  

        // Fermer la déclaration  
        $stmt->close();  
    } else {  
        echo "Erreur lors de la préparation de la déclaration: " . $conn->error;  
    }  
}  

// Fermer la connexion  
$conn->close();  
?>