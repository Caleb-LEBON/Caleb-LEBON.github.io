<?php
$servername = "localhost";
$username = "root"; // ou votre utilisateur MySQL
$password = ""; // ou votre mot de passe MySQL
$dbname = "ubalerts";

try {
    // Connexion à la base de données avec PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Autres options de configuration ici
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
