
<?php include "inscrire1.php"; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - WorkWave</title>
    <link rel="stylesheet" href="css/StyleInscrire.css">
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

                <li><a href="Connexion.php">Connexion</a></li>
                <li><a href="Inscrire.php" class="active">S'inscrire</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
      
  <div class="form-container">
    <div class="form-box">
    <div class="form-title-bar">
    <span class="form-title-text"  >INSCRIPTION</span>
  </div>
  <?php if (!empty($errors)): ?>
    <div class="error-messages" style="color: red; margin-bottom: 15px;">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

  <form method="POST" action="Inscrire.php">
        <div class="input-group">
          <label for="name" class="text">• NOM UTILISATEUR</label>
          <input type="text" id="name" name="name" required>
        </div>

        <div class="input-group">
          <label for="email" class="text">• EMAIL</label>
          <input type="email" id="email" name="email" required>
        </div>

        <div class="input-group">
          <label for="password" class="text">• MOT DE PASSE</label>
          <input type="password" id="password" name="password" required minlength="5">
        </div>
        <div class="input-group">
       <label for="cpassword" class="text">• CONFIRMER MOT DE PASSE</label>
        <input type="password" id="cpassword" name="cpassword" required minlength="5">
        </div>

        <div class="input-group">
          <label class="text">• TYPE</label>
          <div class="user-type-select">
            <label><input type="radio" class="button" name="user_type" value="candidat"  required> CANDIDATS</label>
            <label><input type="radio" class="button" name="user_type" value="entreprise" required> ENTREPRISE</label>
          </div>
        </div>

        <div class="submit-container">
     <div class="form-button-bar">
    <div class="button-border">
      <button type="submit" class="register-btn">VALIDER</button>
    </div>
  </div>
</div>

      </form>
    </div>
  </div>
</main>


    
    <script src="script.js"></script>
</body>
</html>