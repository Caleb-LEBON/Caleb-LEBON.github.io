<?php
$apiKey = 'votre_cle_api';
$location = 'Goma, DRC';
$url = "http://api.weatherstack.com/current?access_key=$apiKey&query=$location";

$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data && isset($data['current'])) {
    $type_alerte = $data['current']['weather_descriptions'][0];
    $description = $data['current']['weather_descriptions'][0];
    $date_debut = date('Y-m-d H:i:s');
    $date_fin = date('Y-m-d H:i:s', strtotime('+1 hour'));
    $niveau_severite = 'modere'; // Exemple de niveau de sévérité
    $zone_geographique = $location;
    $statut = 'active';
    $numero_telephone = 'votre_numero_telephone';
    $message_sms = "Alerte météo: $description à $location.";

    // Connexion à la base de données
    $conn = new mysqli('localhost', 'username', 'password', 'database');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insérer les données dans la table alerte
    $sql = "INSERT INTO alerte (type_alerte, description, date_debut, date_fin, niveau_severite, zone_geographique, statut, numero_telephone, message_sms)
            VALUES ('$type_alerte', '$description', '$date_debut', '$date_fin', '$niveau_severite', '$zone_geographique', '$statut', '$numero_telephone', '$message_sms')";

    if ($conn->query($sql) === TRUE) {
        echo "Nouvelle alerte créée avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
