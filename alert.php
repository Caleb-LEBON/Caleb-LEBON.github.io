<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Interface d'envoi des SMS météo aux abonnés</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #87CEEB, #4682B4);
    margin: 0;
    padding: 20px;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .container {
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    width: 100%;
  }
  h1 {
    color: #333;
    text-align: center;
    margin-bottom: 30px;
  }
  .form-group {
    margin-bottom: 20px;
  }
  label {
    display: block;
    margin-bottom: 5px;
    color: #555;
  }
  input, select, textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
  }
  button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
    transition: background-color 0.3s;
  }
  button:hover {
    background-color: #45a049;
  }
  .weather-icon {
    text-align: center;
    margin-bottom: 20px;
  }
  .success-message {
    display: none;
    background-color: #dff0d8;
    color: #3c763d;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
    margin-top: 20px;
  }
  /* Styles pour le menu */
  nav {
    background-color: #343a40;
    padding: 15px;
    color: white;
    text-align: center;
  }
  nav ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: center;
  }
  nav ul li {
    margin: 0 15px;
  }
  nav a {
    color: white;
    text-decoration: none;
  }
  nav a:hover {
    text-decoration: underline;
  }
</style>
</head>
<body>
  <div id="app">
    <nav>
      <ul>
        <li><a href="home.php"><i class="fas fa-home"></i> Accueil</a></li>
        <li><a href="connexion_admin.php"><i class="fas fa-user-shield"></i> Déconnexion</a></li>
        <li><a href="admin.php"><i class="fas fa-bell"></i> Tableau de bord</a></li>
      </ul>
    </nav>
    <div class="container">
      <div class="weather-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#4682B4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"></path>
        </svg>
      </div>
      <h1>Envoi des SMS météo</h1>
      <form id="smsForm" action="send_sms.php" method="POST" onsubmit="showSuccessMessage(event)">
        <div class="form-group">
          <label for="message">Message météo :</label>
          <textarea id="message" name="message" rows="4" required></textarea>
        </div>
        <div class="form-group">
          <label for="schedule">Planification :</label>
          <input type="datetime-local" id="schedule" name="schedule" required>
        </div>
        <button type="submit">Envoyer les SMS</button>
      </form>
      <div id="successMessage" class="success-message">
        SMS météo programmés avec succès !
      </div>
    </div>
  </div>
  <script>
    function showSuccessMessage(e) {
      e.preventDefault(); // Empêche le rechargement de la page
      const form = e.target;
      const data = new FormData(form);

      fetch(form.action, {
        method: form.method,
        body: data
      })
      .then(response => response.text())
      .then(data => {
        // Afficher le message de succès
        document.getElementById('successMessage').style.display = 'block';
        // Réinitialiser le formulaire après l'affichage du message de succès
        form.reset();
        // Masquer le message de succès après 3 secondes
        setTimeout(() => {
          document.getElementById('successMessage').style.display = 'none';
        }, 10000);
      })
      .catch(error => {
        console.error('Erreur:', error);
      });
    }

    // Animation de l'icône météo
    const weatherIcon = document.querySelector('.weather-icon svg');
    weatherIcon.style.transition = 'transform 0.5s ease-in-out';
    setInterval(() => {

      weatherIcon.style.transform = 'scale(1.1)';
      setTimeout(() => {
        weatherIcon.style.transform = 'scale(1)';
      }, 250);
    }, 3000);
  </script>
</body>
</html>
