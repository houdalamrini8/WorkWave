<?php
session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : array();
unset($_SESSION['errors']);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - WorkWave</title>
    <link rel="stylesheet" href="CSS/StyleConnexion.css">
</head>
<body>
    <header>
    <div class="logo" style="width:10%;">
        <a href="index.php">
        <img src="images/logo.png" alt="logo" style="width: 120%; margin-left:5%; margin-top:-35%;margin-bottom:-45%;"></a>
        </div>
        <div class="background"></div>
        <nav>
    <ul>

        <li><a href="Connexion.php" class="active">Connexion</a></li>
        <li><a href="Inscrire.php">S'inscrire</a></li>
    </ul>
</nav>

    </header>
    
    <main>
        <section class="welcome">
    <div class="form-container">
    <div class="form-box">
    <div class="form-title-bar">
    <span class="form-title-text"  >CONNEXION</span>
      </div>
            
            <?php if (!empty($errors)): ?>
                <div class="error-box">
                    <?php foreach ($errors as $error): ?>
                        <p class="error-msg"><?= ($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <form action="connexion1.php" method="POST" >
                 <div class="input-group">
                   <label for="username" class="text">• NOM UTILISATEUR</label>
                   <input type="text" id="username" name="username" required>
                   </div>

                
                <div class="input-group">
                    <label for="password" class="text">• MOT DE PASSE</label>
                    <input type="password" id="password" name="password" required>
                
                    <div class="submit-container">
                      <div class="form-button-bar">
                      <div class="button-border">
                   <button type="submit" name="submit" class="register-btn" value="Connexion">SE CONNECTER</button>
                    </div>
                 </div>        
        </form>
            
            <div class="login-link">
                <p>Vous n'avez pas de compte? <a href="Inscrire.php" class="lien">Inscrivez-vous ici</a></p>
            </div>
        </div>
    </main>
         
         </section>
    <script src="script.js"></script>
</body>
</html>