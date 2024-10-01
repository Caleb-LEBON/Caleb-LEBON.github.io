<html><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>UBAlerts - Accueil</title>
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
    h1 {
        color: var(--primary-color);
        font-size: 1.8em;
        margin-bottom: 20px;
        font-weight: 500;
    }
    p {
        font-size: 1em;
        line-height: 1.6;
        margin-bottom: 20px;
    }
    .main-container {
        display: flex;
        justify-content: space-between;
        max-width: 1000px;
        width: 100%;
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    .info-section, .signup-section {
        padding: 40px;
        width: 50%;
    }
    .signup-section {
        background-color: var(--primary-color);
        color: white;
        border-radius: 0 30px 30px 0;
    }
    .signup-form input {
        width: 100%;
        padding: 15px;
        margin-bottom: 20px;
        border: none;
        border-radius: 25px;
        font-family: 'Poppins', sans-serif;
        font-size: 1em;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
    }
    .signup-form input:focus {
        outline: none;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }
    .signup-button {
        background-color: var(--accent-color);
        color: white;
        border: none;
        padding: 15px 30px;
        border-radius: 25px;
        font-size: 1em;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
        text-decoration: none;  

    }
    .signup-button:hover {
        background-color: #e67e22;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }
</style>
</head>
<body>
    <div id="app">
        <nav>
        <ul>  
            <li><a href="index.php"><i class="fas fa-home"></i> Accueil</a></li>  
            <li><a href="connexion_admin.php"><i class="fas fa-user-shield"></i> Admin</a></li>  
        </ul>

        </nav>

        <div class="content">
            <div class="main-container">
                <div class="info-section">
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

                    <h1>Bienvenue sur UBAlerts</h1>
                    <p>
                        UBAlerts est votre solution intelligente pour rester informé en temps réel.
                        Recevez des alertes personnalisées sur les sujets qui vous intéressent,
                        où que vous soyez, quand vous le souhaitez.
                    </p>
                    <p>
                        <i class="fas fa-bell"></i> Alertes personnalisées<br>
                        <i class="fas fa-clock"></i> Informations en temps réel<br>
                        <i class="fas fa-mobile-alt"></i> Compatible multi-plateformes<br>
                        <br>
                        <a href="main.php" class="signup-button">Consultez la météo</a>
                    </p>
                </div>
                <div class="signup-section">
                    <br><br>
                    <h2>Inscrivez-vous maintenant</h2>
                    <form class="signup-form" action="submit.php" method="post">  
                        <input type="text" name="nom" placeholder="Nom" required>  
                        <input type="tel" name="telephone" placeholder="Numéro de téléphone" required>  
                        <button type="submit" class="signup-button">S'inscrire</button>  
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    document.getElementById('admin-login-form').addEventListener('submit', function(e) {  
    e.preventDefault();  
    const nom = document.getElementById('nom').value;  
    const telephone = document.getElementById('telephone').value;  

    // Fonction pour valider le numéro de téléphone  
    function validerNumeroRDC(telephone) {  
        return /^(\+243\d{9}|0\d{9})$/.test(telephone);  
    }  

    if (validerNumeroRDC(telephone)) {  
        // Vérifier si le numéro de téléphone existe déjà via une requête AJAX  
        fetch('check_phone.php', {  
            method: 'POST',  
            headers: {  
                'Content-Type': 'application/x-www-form-urlencoded'  
            },  
            body: `telephone=${telephone}`  
        })  
        .then(response => response.json())  
        .then(data => {  
            if (data.exists) {  
                alert('Le numéro de téléphone existe déjà.');  
            } else {  
                // Soumettre le formulaire si le numéro n'existe pas  
                document.getElementById('admin-login-form').submit();  
            }  
        })  
        .catch(error => console.error('Erreur:', error));  
    } else {  
        alert('Le numéro de téléphone n\'est pas valide. Veuillez entrer un numéro de la RDC.');  
    }  
});
</script>
</html>