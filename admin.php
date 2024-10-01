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
        :root {  
            --primary-color: #3498db;  
            --secondary-color: #2c3e50;  
            --accent-color: #f39c12;  
            --text-color: #333;  
            --bg-color: #f4f4f4;  
        }  
        body, html {  
            margin: 0;  
            padding: 0;  
            height: 100%;  
            font-family: 'Nunito', sans-serif;  
            background-color: var(--bg-color);  
            color: var(--text-color);  
        }  
        #app {  
            display: flex;  
            flex-direction: column;  
            min-height: 100vh;  
        }  
        .content {  
            flex-grow: 1;  
            display: flex;  
            justify-content: center;  
            padding: 20px;  
        }  
        nav {  
            background-color: var(--secondary-color);  
            padding: 15px 0;  
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);  
        }  
        nav ul {  
            list-style-type: none;  
            padding: 0;  
            margin: 0;  
            display: flex;  
            justify-content: center;  
        }  
        nav ul li {  
            margin: 0 20px;  
        }  
        nav ul li a {  
            color: #fff;  
            text-decoration: none;  
            font-weight: 600;  
            transition: color 0.3s ease;  
            display: flex;  
            align-items: center;  
        }  
        nav ul li a:hover {  
            color: var(--accent-color);  
        }  
        h1, h2 {  
            color: var(--primary-color);  
            margin-bottom: 20px;  
            font-weight: 700;  
            text-align: center;  
        }  
        .dashboard {  
            display: flex;  
            flex-wrap: wrap;  
            gap: 20px;  
            justify-content: center;  
        }  
        .dashboard-card {  
            background-color: #fff;  
            border-radius: 10px;  
            padding: 20px;  
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);  
            flex: 1 1 300px;  
            text-align: center;  
        }  
        table {  
            width: 100%;  
            border-collapse: collapse;  
            margin-top: 20px;  
            text-align: center;  
        }  
        th, td {  
            padding: 12px;  
            border: 1px solid #ddd;  
        }  
        th {  
            background-color: var(--primary-color);  
            color: white;  
        }  
        tr:hover {  
            background-color: #f1f1f1;  
        }  
    </style>  
</head>  
<body>  

    <div id="app">  
        <nav>  
            <ul>  
                <li><a href="index.php"><i class="fas fa-home"></i>Acceuil</a></li>
                <li><a href="connexion_admin.php"><i class="fas fa-user-shield"></i>Deconnexion</a></li>  
                <li><a href="main.php"><i class="fas fa-bell"></i> Alertes Météo</a></li>  
            </ul>  
        </nav>  

        <div class="content">  
            <div>  
                <h1>Tableau de Bord</h1>  
                <div class="dashboard">  
                    <div class="dashboard-card">  
                        <h2>Utilisateurs Totals : <span class="stat-value">{{ totalUsers }}</span></h2>  
                    </div>  
                    <div class="dashboard-card">  
                        <h2>Administrateurs Totals : <span class="stat-value">{{ totalAdmins }}</span></h2>  
                    </div>  
                    <div class="dashboard-card">  
                        <h2>SMS Envoyés : <span class="stat-value">{{ smsSent }}</span></h2>  
                    </div>  
                </div>  

                <h2>Utilisateurs</h2>  
                <table>  
                    <thead>  
                        <tr>  
                            <th>ID</th>  
                            <th>Nom</th>  
                            <th>Actions</th>  
                        </tr>  
                    </thead>  
                    <tbody>  
                        <tr v-for="user in recentUsers" :key="user.id">  
                            <td>{{ user.id }}</td>  
                            <td>{{ user.name }}</td>  
                            <td>  
                                <button @click="editUser(user.id)">Éditer</button>  
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
                            <th>Actions</th>  
                        </tr>  
                    </thead>  
                    <tbody>  
                        <tr v-for="admin in recentAdmins" :key="admin.id">  
                            <td>{{ admin.id }}</td>  
                            <td>{{ admin.name }}</td>  
                            <td>  
                                <button @click="editAdmin(admin.id)">Éditer</button>  
                                <button @click="deleteAdmin(admin.id)">Supprimer</button>  
                            </td>  
                        </tr>  
                    </tbody>  
                </table>  
            </div>  
        </div>  
    </div>  

    <script>  
new Vue({  
    el: '#app',  
    data: {  
        totalUsers: 0,  
        totalAdmins: 0,  
        activeAlerts: 0,  
        smsSent: 0,  
        recentUsers: [],  
        recentAdmins: [],   
        activeAlertsList: []  
    },  
    created() {  
        this.fetchUsers();  
        this.fetchAdmins();  
        this.fetchAlerts();  
    },  
    methods: {  
        fetchUsers() {  
            axios.get('http://localhost/caleb-lebon.github.io/BD_utilisateurs.php')  // Ensure this URL is correct  
                .then(response => {  
                    this.recentUsers = response.data;  
                    this.totalUsers = this.recentUsers.length;  
                })  
                .catch(error => {  
                    console.error("Erreur lors de la récupération des utilisateurs :", error);  
                });  
        },  
        fetchAdmins() {  
            axios.get('http://localhost/Caleb-LEBON.github.io/BD_admin.php')  // Ensure this URL is correct  
                .then(response => {  
                    this.recentAdmins = response.data;  
                    this.totalAdmins = this.recentAdmins.length;  
                })  
                .catch(error => {  
                    alert("Erreur lors de la récupération des administrateurs.");  
                    console.error("Erreur :", error);  
                });  
        },  
        fetchAlerts() {  
            axios.get('http://localhost/caleb-lebon.github.io/BD_alerts.php')  // Ensure this URL is correct  
                .then(response => {  
                    this.activeAlertsList = response.data;  
                    this.activeAlerts = this.activeAlertsList.length;  
                })  
                .catch(error => {  
                    console.error("Erreur lors de la récupération des alertes :", error);  
                });  
        },  
        editUser(userId) {  
            alert(`Édition de l'utilisateur avec l'ID ${userId}`);  
        },  
        deleteUser(userId) {  
            if (confirm(`Êtes-vous sûr de vouloir supprimer l'utilisateur avec l'ID ${userId} ?`)) {  
                axios.delete(`ubalerts/utilisateur/${userId}`)  
                    .then(() => {  
                        alert(`Utilisateur avec l'ID ${userId} supprimé`);  
                        this.recentUsers = this.recentUsers.filter(user => user.id !== userId);  
                        this.totalUsers--;  
                    })  
                    .catch(error => {  
                        console.error("Erreur lors de la suppression de l'utilisateur :", error);  
                    });  
            }  
        },  
        editAdmin(adminId) {  
            alert(`Édition de l'administrateur avec l'ID ${adminId}`);  
        },  
        deleteAdmin(adminId) {  
            if (confirm(`Êtes-vous sûr de vouloir supprimer l'administrateur avec l'ID ${adminId} ?`)) {  
                axios.delete(`ubalerts/admin/${adminId}`)  
                    .then(() => {  
                        alert(`Administrateur avec l'ID ${adminId} supprimé`);  
                        this.recentAdmins = this.recentAdmins.filter(admin => admin.id !== adminId);  
                        this.totalAdmins--;  
                    })  
                    .catch(error => {  
                        console.error("Erreur lors de la suppression de l'administrateur :", error);  
                    });  
            }  
        }  
    }  
});

    </script>  
</body>  
</html>