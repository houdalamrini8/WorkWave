<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Information sur Candidat</title>
    <link rel="stylesheet" href="css/InfoCandidat.css">
</head>
<body>

<?php include("HautCandidat.php");?>

<main>
    <h1>Information sur Candidat</h1>


    <div class="progress-bar">
        <span class="step active" data-step="1"></span>
        <span class="step" data-step="2"></span>
        <span class="step" data-step="3"></span>
        <span class="step" data-step="4"></span>
    </div>

    <form id="offerForm" action="AjoutCandidat.php" method="POST" enctype="multipart/form-data">

    
        <div class="form-container step-container active" data-step="1">
            <div class="form-grid">
                <div>
                    <label>NOM</label>
                    <input type="text" name="nom_candidat" required>
                </div>
                <div>
                    <label>PRENOM</label>
                    <input type="text" name="prenom_candidat" required>
                </div>
                <div>
                    <label>GENRE</label>
                    <input type="text" name="genre" required>

                </div>
                <div>
                    <label>AGE</label>
                    <input type="number" name="age" required>
                </div>
                <div>
                    <label>EMAIL</label>
                    <input type="email" name="email_candidat" required>
                </div>
                <div>
                    <label>PAYS</label>
                    <input type="text" name="pays" required>
                </div>
            </div>

            <div class="btn-container">
                <button type="button" onclick="nextStep()">Suivant</button>
            </div>
        </div>


        <div class="form-container step-container" data-step="2">
            <div class="form-grid">
                <label style="color: white; font-size: 120%;margin-left:0%;" >Spécialité:</label>
                <input type="text" name="specialite" class="specialite" 
                style="width: 90%; padding: 12px;border: none;border-radius: 30px;margin-left:-80%; margin-bottom: 5%;margin-top:-2%;
                 font-size: 14px;outline: none;"
                 required>

            </div>
            <br\>
            <div class="autre">
                <div>
                    <label>INFORMATIONS SUPPLÉMENTAIRES SUR VOUS:</label><br><br>
                    <textarea name="autres" rows="8" cols="130"></textarea>
                                </div>
            </div>

            <div class="btn-container">
                <button type="button" onclick="prevStep()">Retour</button>
                <button type="button" onclick="nextStep()">Suivant</button>
            </div>
        </div>


        <div class="form-container step-container" data-step="3">
        <div class="profil">
                <div>
                    <label>PHOTO DE PROFILE</label><br>
                    <input type="file" name="photo_candidat" accept=".jpg,.jpeg,.png" required class="profile">
                </div>
            </div>

            <div class="btn-container">
                <button type="button" onclick="prevStep()">Retour</button>
                <button type="button" onclick="nextStep()">Suivant</button>
            </div>
        </div>


        <div class="form-container step-container" data-step="4">
           
            <div class="Cv">
                <div>
                    <label>CV</label>
                    <input type="file" name="cv" id="cv" accept=".pdf" required class="cv"><br>
                    <small class="taillepdf">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         (Max: 10 Mo)</small>
                </div>
            </div>
            <div class="btn-container">
                <button type="button" onclick="prevStep()">Retour</button>
                <button type="submit">Valider</button>
            </div>
        </div>

    </form>

</main>

<script src="javascript/script.js"></script>
</body>
</html>
