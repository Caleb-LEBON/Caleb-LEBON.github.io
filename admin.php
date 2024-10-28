<?php  
$servername = "localhost";  
$username = "root";  
$password = "";  
$dbname = "ubalerts";  

// Créer une connexion  
$conn = new mysqli($servername, $username, $password, $dbname);  

// Vérifier la connexion  
if ($conn->connect_error) {  
    die("Échec de la connexion : " . $conn->connect_error);  
}  

// Récupérer les utilisateurs  
$sql = "SELECT id, nom, telephone FROM utilisateurs";  
$result = $conn->query($sql);  
$utilisateurs = ($result->num_rows > 0) ? $result->fetch_all(MYSQLI_ASSOC) : [];  

// Récupérer les administrateurs  
$sql = "SELECT id, nom, numero, mot_de_passe FROM admins";  
$result = $conn->query($sql);  
$administrateurs = ($result->num_rows > 0) ? $result->fetch_all(MYSQLI_ASSOC) : [];  

// Récupérer le nombre total d'utilisateurs  
$sql = "SELECT COUNT(*) as total FROM utilisateurs";  
$result = $conn->query($sql);  
$row = ($result->num_rows > 0) ? $result->fetch_assoc() : ['total' => 0];  

// Récupérer le nombre total d'administrateurs  
$sql = "SELECT COUNT(*) as total_admin FROM admins";  
$result = $conn->query($sql);  
$row_admin = ($result->num_rows > 0) ? $result->fetch_assoc() : ['total_admin' => 0];  

$conn->close();  
?>  
<!DOCTYPE html>  
<html lang="fr">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>UBAlerts Admin - Gestion du Système d'Alerte Météorologique</title>  
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">  
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">  
    <style>  
        /* Ajoutez ici vos styles CSS existants */  
        body {  
            font-family: 'Nunito', sans-serif;  
            margin: 0;  
            padding: 0;  
            background-color: #f0f0f0;  
        }  
        nav {  
    background-color: #343a40;  
    padding: 15px;  
    color: white;  
    text-align: center; /* Centre le contenu du menu */  
}  

nav ul {  
    list-style-type: none;  
    padding: 0;  
    margin: 0; /* Supprime la marge pour centrer correctement */  
}  

nav ul li {  
    display: inline-block; /* Change à inline-block pour le centrage */  
    margin: 0 15px; /* Ajoute une marge symétrique des deux côtés */  
}  

nav a {  
    color: white;  
    text-decoration: none;  
}
        .content {  
            padding: 20px;  
        }  
        .dashboard {  
            display: flex;  
            justify-content: space-between;  
            margin-bottom: 20px;  
        }  
        .dashboard-card {  
            background: white;  
            padding: 15px;  
            border-radius: 5px;  
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);  
            flex: 1;  
            margin-right: 10px;  
        }  
        .dashboard-card:last-child {  
            margin-right: 0;  
        }  
        table {  
            width: 100%;  
            border-collapse: collapse;  
            margin-bottom: 20px;  
        }  
        th, td {  
            border: 1px solid #ddd;  
            padding: 8px;  
            text-align: left;  
        }  
        th {  
            background-color: #f2f2f2;  
        }  
        button {  
            background-color: #007bff;  
            border: none;  
            color: white;  
            padding: 8px 12px;  
            text-align: center;  
            text-decoration: none;  
            margin: 4px 2px;  
            cursor: pointer;  
            border-radius: 4px;  
        }  
        button:hover {  
            background-color: #0056b3;  
        }  
    </style>  
</head>  
<body>  

    <div id="app">  
        <nav>  
            <ul>  
                <li><a href="home.php"><i class="fas fa-home"></i> Accueil</a></li>  
                <li><a href="connexion_admin.php"><i class="fas fa-user-shield"></i> Déconnexion</a></li>  
                <li><a href="alert.php"><i class="fas fa-bell"></i> Alertes Météo</a></li>  
            </ul>  
        </nav>  

        <div class="content">  
            <div>  
                <h1><center>Tableau de bord</center></h1>  
                <div class="dashboard">  
                    <div class="dashboard-card">  
                        <h2>Utilisateurs total : <?php echo $row["total"]; ?></h2>  
                    </div>  

                    <div class="dashboard-card">  
                        <h2>Administrateurs total : <?php echo $row_admin["total_admin"]; ?></h2>   
                    </div>  
                </div>  


    <style>  
        body {  
            font-family: Arial, sans-serif;  
        }  
        .dashboard {  
            display: flex;  
            gap: 20px;  
            padding: 20px;  
        }  
        .dashboard-card {  
            text-align: center;  
        }  
        .dashboard-card a {  
            display: inline-block;  
            width: 100%;  
            padding: 20px;  
            font-size: 16px;  
            cursor: pointer;  
            border: none;  
            border-radius: 5px;  
            background-color: blue;  
            color: black; /* Changer la couleur du texte à noir */  
            text-decoration: none; /* Supprimer le soulignement */  
            transition: background-color 0.3s, color 0.3s; /* Ajouter une transition pour la couleur */  
        }  
        .dashboard-card a:hover {  
            background-color: orange;  
            color: black; /* Garder le texte en noir au survol */
            
        }  
        .a {  
            display: inline-block;  
            width: 100%;  
            padding: 20px;  
            font-size: 16px;  
            cursor: pointer;  
            border: none;  
            border-radius: 5px;  
            background-color: blue;  
            color: black; /* Changer la couleur du texte à noir */  
            text-decoration: none; /* Supprimer le soulignement */  
            transition: background-color 0.3s, color 0.3s; /* Ajouter une transition pour la couleur */  
        }  
        .a:hover {  
            background-color: orange;  
            color: black; /* Garder le texte en noir au survol */  
    </style> 
</head>  
<body>  
    <div class="dashboard">  
        <div class="dashboard-card">  
            <a href="home.php">Ajouter Utilisateur</a>  
        </div>  

        <div class="dashboard-card">  
            <a href="ajouteradmin.php">Ajouter Administrateur</a>  
        </div>  
    </div>  
                <h2>Utilisateurs</h2>  
                <table>  
                    <thead>  
                        <tr>  
                            <th>ID</th>  
                            <th>Nom</th>  
                            <th>Téléphone</th>
                            <th>Actions</th>  
                        </tr>  
                    </thead>  
                    <tbody>  
                        <tr v-for="user in utilisateurs" :key="user.id">  
                            <td>{{ user.id }}</td>  
                            <td>{{ user.nom }}</td>
                            <td>{{ user.telephone }}</td>  
                            <td>  
                                <button @click="deleteUser(user.id)">Supprimer</button>  
                            </td>  
                        </tr>  
                    </tbody>  
                </table>  

                <h2>Administrateurs</h2>  
                <table>  
                    <thead>  
                        <tr>  
                            <th>ID</th>  
                            <th>Nom</th>  
                            <th>Télépone</th>
                            <th>Mot de passe</th>
                            <th>Actions</th>  
                        </tr>  
                    </thead>  
                    <tbody>  
                        <tr v-for="admin in administrateurs" :key="admin.id">  
                            <td>{{ admin.id }}</td>  
                            <td>{{ admin.nom }}</td>  
                            <td>{{ admin.numero }}</td> 
                            <td>{{ admin.mot_de_passe }}</td> 
                            <td>  
                                <button @click="deleteAdmin(admin.id)">Supprimer</button>  
                            </td>  
                        </tr>  
                    </tbody>  
                </table>  


                <script>
  new Vue({
    el: '#app',
    data: {
      utilisateurs: <?php echo json_encode($utilisateurs); ?>,
      administrateurs: <?php echo json_encode($administrateurs); ?>
    },
    methods: {
      editUser(id) {
        // Logique pour éditer un utilisateur
        alert("Édition de l'utilisateur avec ID : " + id);
      },
      deleteUser(id) {
        if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
          // Trouver l'index de l'utilisateur à supprimer
          const index = this.utilisateurs.findIndex(user => user.id === id);
          if (index !== -1) {
            // Retirer l'utilisateur de la liste
            this.utilisateurs.splice(index, 1);
            alert("Utilisateur avec ID : " + id + " supprimé.");
          } else {
            alert("Utilisateur non trouvé.");
          }
        }
      },
      editAdmin(id) {
        // Logique pour éditer un administrateur
        alert("Édition de l'administrateur avec ID : " + id);
      },
      deleteAdmin(id) {
        if (confirm("Êtes-vous sûr de vouloir supprimer cet administrateur ?")) {
          // Trouver l'index de l'administrateur à supprimer
          const index = this.administrateurs.findIndex(admin => admin.id === id);
          if (index !== -1) {
            // Retirer l'administrateur de la liste
            this.administrateurs.splice(index, 1);
            alert("Administrateur avec ID : " + id + " supprimé.");
          } else {
            alert("Administrateur non trouvé.");
          }
        }
      }
    }
  });
</script>

            </div>  
        </div>  
    </div>  
</body>  
</html>