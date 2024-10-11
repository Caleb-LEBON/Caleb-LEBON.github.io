<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>UBAlerts - Administrateur Créé avec Succès</title>
<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f0f4f8;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: #333;
  }
  .container {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 2rem;
    text-align: center;
    max-width: 400px;
    width: 90%;
  }
  h1 {
    color: #2c3e50;
    margin-bottom: 1rem;
  }
  p {
    margin-bottom: 1.5rem;
  }
  .icon {
    width: 80px;
    height: 80px;
    margin-bottom: 1rem;
  }
  .btn {
    background-color: #3498db;
    color: white;
    padding: 0.8rem 1.5rem;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.3s ease;
  }
  .btn:hover {
    background-color: #2980b9;
  }
  @keyframes checkmark {
    0% {
      stroke-dashoffset: 100;
    }
    100% {
      stroke-dashoffset: 0;
    }
  }
  .checkmark {
    stroke-dasharray: 100;
    stroke-dashoffset: 100;
    animation: checkmark 1s ease-in-out forwards;
  }
</style>
</head>
<body>
  <div class="container">
    <svg class="icon" viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg" aria-labelledby="checkmarkTitle">
      <title id="checkmarkTitle">Icône de validation</title>
      <circle cx="26" cy="26" r="25" fill="none" stroke="#3498db" stroke-width="2"/>
      <path class="checkmark" fill="none" stroke="#3498db" stroke-width="2" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
    </svg>
    <h1>Maintenant vous avez des privilèges administrateurs système !</h1>
    <p>Votre compte Administrateur UBAlerts a été créé avec succès. Nous sommes ravis de vous compter parmi nos administrateurs.</p>
    <a href="connexion_admin.php" class="btn">Administrer maintenant !</a>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const btn = document.querySelector('.btn');
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        btn.style.transform = 'scale(0.95)';
        setTimeout(() => {
          btn.style.transform = 'scale(1)';
          window.location.href = btn.href;
        }, 150);
      });
    });
  </script>
</body>
</html>