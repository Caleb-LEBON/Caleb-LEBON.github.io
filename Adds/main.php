<html><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>UBAlerts - Météo de Goma</title>
<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(135deg, #3498db, #8e44ad);
    color: #fff;
    min-height: 100vh;
  }
  .container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
  }
  header {
    background-color: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    position: sticky;
    top: 0;
    z-index: 1000;
    transition: background-color 0.3s ease;
  }
  header:hover {
    background-color: rgba(255, 255, 255, 0.2);
  }
  nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 5%;
  }
  .logo {
    font-size: 24px;
    font-weight: bold;
    color: #fff;
    text-decoration: none;
    display: flex;
    align-items: center;
  }
  nav ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
    display: flex;
  }
  nav ul li {
    margin-left: 30px;
  }
  nav ul li a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
    transition: all 0.3s ease;
    padding: 8px 15px;
    border-radius: 20px;
  }
  nav ul li a:hover {
    background-color: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
  }
  h1 {
    text-align: center;
    margin-bottom: 30px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
  }
  .weather-card {
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 20px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(10px);
    transition: transform 0.3s ease;
  }
  .weather-card:hover {
    transform: translateY(-5px);
  }
  .weather-icon {
    width: 150px;
    height: 150px;
    margin: 0 auto;
    display: block;
    filter: drop-shadow(3px 3px 2px rgba(0,0,0,0.3));
  }
  .temperature {
    font-size: 54px;
    text-align: center;
    margin: 20px 0;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
  }
  .details {
    display: flex;
    justify-content: space-around;
    margin-top: 30px;
  }
  .detail-item {
    text-align: center;
    background-color: rgba(255, 255, 255, 0.1);
    padding: 15px;
    border-radius: 15px;
    transition: background-color 0.3s ease;
  }
  .detail-item:hover {
    background-color: rgba(255, 255, 255, 0.2);
  }
  .modal {
    display: none;
    position: fixed;
    z-index: 1001;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(5px);
  }
  .modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 30px;
    border: 1px solid #888;
    width: 300px;
    border-radius: 15px;
    color: #333;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
  }
  .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    transition: color 0.3s ease;
  }
  .close:hover,
  .close:focus {
    color: #000;
    text-decoration: none;
  }
  form {
    display: flex;
    flex-direction: column;
  }
  input, button {
    margin: 10px 0;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #ddd;
    font-size: 16px;
  }
  button {
    background-color: #3498db;
    color: white;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  button:hover {
    background-color: #2980b9;
  }
</style>
</head>
<body>
  <header>
    <nav>
      <a href="/" class="logo">
        UBAlerts
      </a>
      <ul>
        <li><a href="../index.php">Accueil</a></li>
        <li><a href="../index.php" id="createAccountLink">Créer un compte</a></li>
        <li><a href="connexion_admin.php" id="adminLink">Admin</a></li>
      </ul>
    </nav>
  </header>

  <div class="container">
    <h1>Météo à Goma</h1>
    <div class="weather-card">
      <svg class="weather-icon" viewBox="0 0 100 100">
        <defs>
          <linearGradient id="sun-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#FFD700;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#FFA500;stop-opacity:1" />
          </linearGradient>
          <linearGradient id="cloud-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#FFFFFF;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#E6E6E6;stop-opacity:1" />
          </linearGradient>
        </defs>
        
        <!-- Sun -->
        <circle cx="50" cy="50" r="20" fill="url(#sun-gradient)">
          <animate attributeName="opacity" values="0.7;1;0.7" dur="5s" repeatCount="indefinite" />
        </circle>
        
        <!-- Cloud 1 -->
        <path d="M25,60 Q40,45 55,60 Q70,60 80,50 Q90,55 80,65 Q65,80 40,75 Q25,75 25,60" fill="url(#cloud-gradient)">
          <animate attributeName="d" values="M25,60 Q40,45 55,60 Q70,60 80,50 Q90,55 80,65 Q65,80 40,75 Q25,75 25,60;
                                             M20,65 Q35,50 50,65 Q65,65 75,55 Q85,60 75,70 Q60,85 35,80 Q20,80 20,65;
                                             M25,60 Q40,45 55,60 Q70,60 80,50 Q90,55 80,65 Q65,80 40,75 Q25,75 25,60" 
                   dur="20s" repeatCount="indefinite" />
        </path>
        
        <!-- Cloud 2 -->
        <path d="M60,40 Q70,30 80,40 Q90,40 95,35 Q100,38 95,45 Q85,55 70,52 Q60,52 60,40" fill="url(#cloud-gradient)" opacity="0.7">
          <animate attributeName="d" values="M60,40 Q70,30 80,40 Q90,40 95,35 Q100,38 95,45 Q85,55 70,52 Q60,52 60,40;
                                             M55,45 Q65,35 75,45 Q85,45 90,40 Q95,43 90,50 Q80,60 65,57 Q55,57 55,45;
                                             M60,40 Q70,30 80,40 Q90,40 95,35 Q100,38 95,45 Q85,55 70,52 Q60,52 60,40" 
                   dur="15s" repeatCount="indefinite" />
        </path>
      </svg>
      <div class="temperature">28°C</div>
      <div class="details">
        <div class="detail-item">
          <p>Humidité</p>
          <p>65%</p>
        </div>
        <div class="detail-item">
          <p>Vent</p>
          <p>10 km/h</p>
        </div>
        <div class="detail-item">
          <p>Précipitations</p>
          <p>0%</p>
        </div>
      </div>
    </div>
  </div>

  <script>
    function openModal(modalId) {
      document.getElementById(modalId).style.display = "block";
    }

    function closeModal(modalId) {
      document.getElementById(modalId).style.display = "none";
    }

    document.getElementById("createAccountLink").onclick = function() {
      openModal("createAccountModal");
    }

    document.getElementById("adminLink").onclick = function() {
      openModal("adminModal");
    }

    var spans = document.getElementsByClassName("close");
    for (var i = 0; i < spans.length; i++) {
      spans[i].onclick = function() {
        closeModal(this.parentElement.parentElement.id);
      }
    }

    window.onclick = function(event) {
      if (event.target.className === "modal") {
        event.target.style.display = "none";
      }
    }

    document.getElementById("createAccountForm").onsubmit = function(e) {
      e.preventDefault();
      alert("Compte créé avec succès!");
      closeModal("createAccountModal");
    }

    document.getElementById("adminForm").onsubmit = function(e) {
      e.preventDefault();
      alert("Connexion admin réussie!");
      closeModal("adminModal");
    }

    setInterval(function() {
      var temp = Math.floor(Math.random() * (35 - 20 + 1)) + 20;
      document.querySelector('.temperature').textContent = temp + '°C';
      
      var humidity = Math.floor(Math.random() * (80 - 50 + 1)) + 50;
      document.querySelector('.detail-item:nth-child(1) p:last-child').textContent = humidity + '%';
      
      var wind = Math.floor(Math.random() * (20 - 5 + 1)) + 5;
      document.querySelector('.detail-item:nth-child(2) p:last-child').textContent = wind + ' km/h';
      
      var precip = Math.floor(Math.random() * 50);
      document.querySelector('.detail-item:nth-child(3) p:last-child').textContent = precip + '%';
    }, 5000);

    // Ajout de l'effet de parallaxe sur le header
    window.addEventListener('scroll', function() {
      var header = document.querySelector('header');
      var scrollPosition = window.scrollY;

      if (scrollPosition > 50) {
        header.style.backgroundColor = 'rgba(255, 255, 255, 0.2)';
      } else {
        header.style.backgroundColor = 'rgba(255, 255, 255, 0.1)';
      }
    });
  </script>
</body></html>