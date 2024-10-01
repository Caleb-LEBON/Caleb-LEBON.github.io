<?php  
session_start(); // Démarrer la session  

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

    // Valider le numéro de téléphone (exemple pour les numéros de la RDC)
    if (!preg_match("/^(\\+243|0)[0-9]{9}$/", $telephone)) {
        $_SESSION['error_message'] = "Numéro de téléphone invalide. Veuillez entrer un numéro valide de la RDC.";
        header("Location: ../index.php");
        exit();
    }

    // Vérifiez d'abord si le numéro de téléphone existe déjà  
    $phone_check_stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE telephone = ?");  
    $phone_check_stmt->bind_param("s", $telephone);  
    $phone_check_stmt->execute();  
    $result = $phone_check_stmt->get_result();  

    if ($result->num_rows > 0) {  
        // Mettez un message d'erreur dans la session et redirigez vers le formulaire  
        $_SESSION['error_message'] = "Impossible de créer un compte. Ce numéro de téléphone est déjà utilisé.";  
        header("Location: ../index.php"); // Mettez ici le nom de votre fichier de formulaire  
        exit();  
    } else {  
        // Préparer et lier  
        $stmt = $conn->prepare("INSERT INTO utilisateurs (nom, telephone) VALUES (?, ?)");  

        if ($stmt) {  
            $stmt->bind_param("ss", $nom, $telephone);  

            // Exécuter la requête  
            if ($stmt->execute()) {  
                // Rediriger vers la page de succès après l'inscription  
                header("Location: success.php"); // Remplacez "success.php" par le chemin correct si nécessaire  
                exit();   
            } else {  
                echo "Erreur lors de l'exécution de la requête: " . $stmt->error;  
            }
            
            // Fermer la déclaration  
            $stmt->close();  
        } else {  
            echo "Erreur lors de la préparation de la déclaration: " . $conn->error;  
        }  
    }  
    // Fermer la déclaration de vérification du numéro de téléphone  
    $phone_check_stmt->close();  
}  

// Fermer la connexion  
$conn->close();  
?>