<?php  
// Affichage des erreurs pour le débogage  
ini_set('display_errors', 1);  
ini_set('display_startup_errors', 1);  
error_reporting(E_ALL);  

// Récupération des données du formulaire  
$message = $_POST['message'];  
$schedule = $_POST['schedule'];  

// Connexion à la base de données  
$dsn = 'mysql:host=localhost;dbname=ubalerts';  
$username = 'root';  
$password = '';  
$options = [  
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  
];  

try {  
    $pdo = new PDO($dsn, $username, $password, $options);  
} catch (PDOException $e) {  
    die('Connexion échouée : ' . $e->getMessage());  
}  

// Récupération des numéros de téléphone des utilisateurs et des administrateurs  
$sql = 'SELECT telephone FROM utilisateurs';  
$stmt = $pdo->query($sql);  
$recipients = $stmt->fetchAll(PDO::FETCH_COLUMN);  

// Vérification des numéros de téléphone récupérés  
if (empty($recipients)) {  
    echo "Aucun numéro de téléphone trouvé.";  
    exit;  
}  

// Vérifier et formater les numéros de téléphone
foreach ($recipients as &$recipient) {  
    if (!preg_match("/^\+243\d{9}$/", $recipient)) {  
        echo "Numéro invalide: $recipient<br>";  
        continue;  
    }  
}  
unset($recipient); // Détruire la référence par précaution

$url = 'https://api.infobip.com/sms/2/text/advanced';  
$apiKey = '03d9dd27cbcb00bbc006a997924f6037-7d209826-7695-4750-8bb2-301659c39fbe';  

// Boucle pour envoyer les messages  
foreach ($recipients as $recipient) {  
    $data = [  
        'messages' => [  
            [  
                'from' => 'UBAlerts',  
                'destinations' => [  
                    ['to' => $recipient]  
                ],  
                'text' => $message  
            ]  
        ]  
    ];  

    $options = [  
        'http' => [  
            'header'  => [  
                "Authorization: App $apiKey",  
                "Content-Type: application/json",  
            ],  
            'method'  => 'POST',  
            'content' => json_encode($data),  
        ],  
    ];  

    $context = stream_context_create($options);  
    $result = file_get_contents($url, false, $context);  

    if ($result === FALSE) {  
        // Gérer les erreurs si nécessaire  
        error_log("Erreur lors de l'envoi à $recipient");  
        echo "Erreur lors de l'envoi à $recipient<br>";  
    } else {  
        // Traitez la réponse de l'API  
        $response = json_decode($result, true);  
        if (isset($response['messages'][0]['status']['groupId']) && $response['messages'][0]['status']['groupId'] != 1) {  
            error_log("Erreur API: " . $response['messages'][0]['status']['description']);  
            echo "Erreur lors de l'envoi à $recipient: " . $response['messages'][0]['status']['description'] . "<br>";  
        } else {  
            echo "SMS envoyé à $recipient avec succès.<br>";  
        }  
        // Ajoutez ceci pour inspecter la réponse complète
        echo "<pre>";
        print_r($response);
        echo "</pre>";
    }  
}  

// Fermer la connexion à la base de données  
$pdo = null;  

// Message final de confirmation  
echo "Tous les SMS ont été traités.";  
?>
