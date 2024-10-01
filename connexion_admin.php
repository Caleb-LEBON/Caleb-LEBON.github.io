<html><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>UBAlerts - Admin Login</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
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
        font-family: 'Poppins', sans-serif;
        background-color: var(--bg-color);
        color: var(--text-color);
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 810" preserveAspectRatio="xMidYMid slice"><path fill="%23f4f4f4" d="M0 0h1440v810H0z"/><g fill="%23ffffff" fill-opacity="0.7"><circle cx="1395" cy="140" r="3"/><circle cx="1145" cy="95" r="3"/><circle cx="920" cy="175" r="3"/><circle cx="690" cy="120" r="3"/><circle cx="455" cy="90" r="3"/><circle cx="230" cy="180" r="3"/><circle cx="10" cy="140" r="3"/><circle cx="1370" cy="270" r="3"/><circle cx="1125" cy="320" r="3"/><circle cx="895" cy="290" r="3"/><circle cx="670" cy="350" r="3"/><circle cx="435" cy="310" r="3"/><circle cx="210" cy="280" r="3"/><circle cx="35" cy="340" r="3"/><circle cx="1390" cy="460" r="3"/><circle cx="1155" cy="510" r="3"/><circle cx="930" cy="480" r="3"/><circle cx="705" cy="540" r="3"/><circle cx="470" cy="500" r="3"/><circle cx="245" cy="470" r="3"/><circle cx="20" cy="530" r="3"/><circle cx="1405" cy="650" r="3"/><circle cx="1170" cy="700" r="3"/><circle cx="945" cy="670" r="3"/><circle cx="720" cy="730" r="3"/><circle cx="485" cy="690" r="3"/><circle cx="260" cy="660" r="3"/><circle cx="35" cy="720" r="3"/></g></svg>');
        background-attachment: fixed;
        background-size: cover;
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
        align-items: center;
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
        font-weight: 500;
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
        margin-bottom: 20px;
    }
    .logo svg {
        width: 150px;
        height: auto;
    }
    .login-container {
        background-color: white;
        border-radius: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 40px;
        width: 100%;
        max-width: 400px;
    }
    h1 {
        color: var(--primary-color);
        font-size: 1.8em;
        margin-bottom: 20px;
        font-weight: 500;
        text-align: center;
    }
    form {
        display: flex;
        flex-direction: column;
    }
    .input-group {
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-bottom: 5px;
        color: var(--secondary-color);
        font-weight: 500;
    }
    input[type="password"] {
        width: 100%;
        padding: 12px;
        border: 2px solid #e0e0e0;
        border-radius: 20px;
        font-size: 16px;
        transition: border-color 0.3s ease;
    }
    input[type="password"]:focus {
        outline: none;
        border-color: var(--primary-color);
    }
    button {
        background-color: var(--accent-color);
        color: white;
        border: none;
        padding: 12px;
        border-radius: 20px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    button:hover {
        background-color: #e67e22;
    }
</style>
</head>
<body>
    <div id="app">
        <nav>
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i> Accueil</a></li>
            </ul>
        </nav>

        <div class="content">
            <div class="login-container">
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

                <h1>Connexion Admin</h1>
                <?php  
                if (isset($_GET['error'])) {  
                    echo '<p style="color:red;">Mot de passe incorrect. Veuillez réessayer.</p>';  
                }  
            ?>  
                <form id="admin-login-form" method="POST" action="process_login.php">  
                    <div class="input-group">  
                        <label for="nom">Nom</label>  
                        <input type="text" id="nom" name="nom" required style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 20px; font-size: 16px; transition: border-color 0.3s ease;">  
                    </div>  
                    <div class="input-group">  
                        <label for="password">Mot de passe</label>  
                        <input type="password" id="password" name="password" required style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 20px; font-size: 16px; transition: border-color 0.3s ease;">  
                    </div>  
                    <button type="submit">Se connecter</button>  
                </form>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('admin-login-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const nom = document.getElementById('nom').value; // Ajout de cette ligne pour définir la variable 'nom'
        const password = document.getElementById('password').value;

        if (nom === 'Caleb LeBon AM' && password === '@elite00') {
            // Redirection vers le panneau d'administration
            window.location.href = 'admin.php';
        } else {
            alert('Le nom ou le mot de passe est incorrect. Veuillez réessayer.');
        }
    });
    </script>
</body>

</html>