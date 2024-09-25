<html><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ubAlerts Admin - Gestion du Système d'Alerte Météorologique</title>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
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
    nav ul li a i {
        margin-right: 8px;
        font-size: 1.2em;
    }
    .logo {
        text-align: center;
        margin: 20px 0;
    }
    .logo svg {
        width: 200px;
        height: auto;
    }
    h1, h2 {
        color: var(--primary-color);
        margin-bottom: 20px;
        font-weight: 700;
    }
    .dashboard {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
    .dashboard-card {
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        flex: 1 1 300px;
    }
    .stats {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    .stat-item {
        text-align: center;
    }
    .stat-value {
        font-size: 24px;
        font-weight: 700;
        color: var(--primary-color);
    }
    .stat-label {
        font-size: 14px;
        color: var(--text-color);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        text-align: left;
        padding: 12px;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: var(--primary-color);
        color: white;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
    .action-buttons {
        display: flex;
        gap: 10px;
    }
    .btn {
        padding: 8px 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .btn-edit {
        background-color: var(--accent-color);
        color: white;
    }
    .btn-delete {
        background-color: #e74c3c;
        color: white;
    }
    .btn:hover {
        opacity: 0.8;
    }
</style>
</head>
<body>
    <div id="app">
        <nav>
            <ul>
                <li><a href="../main.php"><i class="fas fa-home"></i> Météo</a></li>
                <li><a href="../index.php"><i class="fas fa-user-shield"></i> Deconnexion</a></li>
            </ul>
        </nav>

        <div class="logo">
            <svg viewBox="0 0 300 100">
                <defs>
                    <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:#3498db;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#2c3e50;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <text x="10" y="80" font-family="Poppins, sans-serif" font-size="60" fill="url(#gradient)" font-weight="700">
                    UBAlerts
                </text>
                <path d="M260 30 L275 30 L267.5 45 Z" fill="#f39c12" />
            </svg>
        </div>

        <div class="content">
            <div class="dashboard">
                <div class="dashboard-card">
                    <h2>Tableau de bord</h2>
                    <div class="stats">
                        <div class="stat-item">
                            <div class="stat-value">{{ totalUsers }}</div>
                            <div class="stat-label">Utilisateurs</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ activeAlerts }}</div>
                            <div class="stat-label">Alertes actives</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ smsSent }}</div>
                            <div class="stat-label">SMS envoyés</div>
                        </div>
                    </div>
                </div>
                <div class="dashboard-card">
                    <h2>Utilisateurs récents</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in recentUsers" :key="user.id">
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.phone }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-edit" @click="editUser(user.id)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-delete" @click="deleteUser(user.id)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="dashboard-card">
                    <h2>Alertes actives</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Localisation</th>
                                <th>Niveau</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="alert in activeAlertsList" :key="alert.id">
                                <td>{{ alert.type }}</td>
                                <td>{{ alert.location }}</td>
                                <td>{{ alert.level }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-edit" @click="editAlert(alert.id)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-delete" @click="deleteAlert(alert.id)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
    new Vue({
        el: '#app',
        data: {
            totalUsers: 1245,
            activeAlerts: 3,
            smsSent: 5678,
            recentUsers: [
                { id: 1, name: 'Jean Dupont', email: 'jean.dupont@email.com', phone: '06 12 34 56 78' },
                { id: 2, name: 'Marie Martin', email: 'marie.martin@email.com', phone: '07 23 45 67 89' },
                { id: 3, name: 'Pierre Durand', email: 'pierre.durand@email.com', phone: '06 34 56 78 90' },
            ],
            activeAlertsList: [
                { id: 1, type: 'Orage', location: 'Paris', level: 'Élevé' },
                { id: 2, type: 'Inondation', location: 'Lyon', level: 'Modéré' },
                { id: 3, type: 'Canicule', location: 'Marseille', level: 'Sévère' },
            ]
        },
        methods: {
            editUser(userId) {
                alert(`Édition de l'utilisateur avec l'ID ${userId}`);
            },
            deleteUser(userId) {
                if (confirm(`Êtes-vous sûr de vouloir supprimer l'utilisateur avec l'ID ${userId} ?`)) {
                    alert(`Utilisateur avec l'ID ${userId} supprimé`);
                    this.recentUsers = this.recentUsers.filter(user => user.id !== userId);
                }
            },
            editAlert(alertId) {
                alert(`Édition de l'alerte avec l'ID ${alertId}`);
            },
            deleteAlert(alertId) {
                if (confirm(`Êtes-vous sûr de vouloir supprimer l'alerte avec l'ID ${alertId} ?`)) {
                    alert(`Alerte avec l'ID ${alertId} supprimée`);
                    this.activeAlertsList = this.activeAlertsList.filter(alert => alert.id !== alertId);
                    this.activeAlerts--;
                }
            }
        }
    });
    </script>
</body>
</html>