<html>  
<head>  
<meta charset="UTF-8">  
<meta name="viewport" content="width=device-width, initial-scale=1.0">  
<title>UBAlerts</title>  
<style>  
  body, html {  
    height: 100%;  
    margin: 0;  
    padding: 0;  
    font-family: 'Roboto', sans-serif;  
    background-color: #ffffff;  
    color: #333333;  
    display: flex;  
    justify-content: center;  
    align-items: center;  
    overflow: hidden;  
  }  
  .loading-container {  
    text-align: center;  
    background-color: #ffffff;  
    padding: 40px;  
    border-radius: 10px;  
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);  
  }  
  .logo {  
    font-size: 48px;  
    font-weight: bold;  
    margin-bottom: 20px;  
    letter-spacing: 2px;  
    color: #2196F3; /* Change to blue */  
  }  
  .loading-bar {  
    width: 200px;  
    height: 4px;  
    background-color: #e0e0e0;  
    margin: 20px auto;  
    position: relative;  
    overflow: hidden;  
    border-radius: 2px;  
  }  
  .loading-progress {  
    width: 0;  
    height: 100%;  
    background-color: #2196F3; /* Change to blue */  
    position: absolute;  
    top: 0;  
    left: 0;  
    animation: loading 2s ease-in-out infinite;  
  }  
  .loading-text {  
    font-size: 18px;  
    margin-top: 20px;  
    opacity: 0.8;  
    color: #666666;  
  }  
  .weather-icon {  
    font-size: 64px;  
    margin: 20px 0;  
    animation: float 3s ease-in-out infinite;  
    color: #4CAF50;  
  }  
  @keyframes loading {  
    0% { width: 0; }  
    50% { width: 100%; }  
    100% { width: 0; }  
  }  
  @keyframes float {  
    0%, 100% { transform: translateY(0); }  
    50% { transform: translateY(-10px); }  
  }  
</style>  
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">  
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">  
</head>  
<body>  
  <div class="loading-container">  
    <div class="logo">UBAlerts</div>  
    <div class="weather-icon">  
      <i class="material-icons">wb_sunny</i>  
    </div>  
    <div class="loading-bar">  
      <div class="loading-progress"></div>  
    </div>  
    <div class="loading-text">Chargement des données météo...</div>  
  </div>  

  <script>  
    // Simuler un chargement et rediriger vers le tableau de bord  
    setTimeout(() => {  
      window.location.href = 'home.php';  
    }, 3000);  

    // Animation du texte de chargement  
    const loadingText = document.querySelector('.loading-text');  
    const texts = [  
      "Chargement des données météo...",  
      "Analyse des prévisions...",  
      "Préparation des alertes...",  
      "Mise à jour des informations..."  
    ];  
    let currentTextIndex = 0;  

    setInterval(() => {  
      currentTextIndex = (currentTextIndex + 1) % texts.length;  
      loadingText.textContent = texts[currentTextIndex];  
    }, 2000);  

    // Animation de l'icône météo  
    const weatherIcon = document.querySelector('.weather-icon i');  
    const icons = ['wb_sunny', 'cloud', 'grain', 'ac_unit'];  
    let currentIconIndex = 0;  

    setInterval(() => {  
      currentIconIndex = (currentIconIndex + 1) % icons.length;  
      weatherIcon.textContent = icons[currentIconIndex];  
    }, 3000);  
  </script>  
</body>  
</html>