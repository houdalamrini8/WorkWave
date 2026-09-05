<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Information Entreprise & Offre</title>
    <link rel="stylesheet" href="css/InfoOffre.css">
</head>
<body>

<?php include("HautEntreprise3.php");?>

<main>
    <h1>Information sur l'Entreprise & l'Offre</h1>

    <div class="progress-bar">
        <span class="step active" data-step="1"></span>
        <span class="step" data-step="2"></span>
        <span class="step" data-step="3"></span>
        <span class="step" data-step="4"></span>
        <span class="step" data-step="5"></span>
    </div>


    <form id="jointureForm" action="AjoutOffre.php" method="POST" enctype="multipart/form-data">

  
        <div class="form-container step-container active" data-step="1">
            <div class="form-grid">
                <div>
                    <label>Nom de l'entreprise</label>
                    <input type="text" name="nom_entreprise" required>
                </div>
                <div>
                    <label>Domaine</label>
                    <input type="text" name="domaine" required>
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" name="email_entreprise" required>
                </div>
                <div>
                    <label>Statut</label>
                    <input type="text" name="statut" required>
                </div>
                <div>
                    <label>Adresse</label>
                    <input type="text" name="adresse" required>
                </div>
                <div>
                    <label>Horaire</label>
                    <input type="text" name="horaire" required>
                </div>
                
            </div>

            <div class="btn-container">
                <button type="button" onclick="nextStep()">Suivant</button>
            </div>
        </div>


        <div class="form-container step-container" data-step="2">
            <div class="form-grid">
                <div>
                    <label>Titre de l'offre</label>
                    <input type="text" name="titre" required>
                </div>
                <div>
                    <label>Lieu</label>
                    <input type="text" name="lieu" required>
                </div>
                <div>
                    <label>Salaire</label>
                    <input type="text" name="salaire" required>
                </div>
               
                <div>
                    <label>Description</label>
                    <input type="text" name="description" required>
                </div>
                <div>
                    <label>Type de contrat</label>
                    <input type="text" name="type_contrat" required>
                </div>
                <div>
                    <label>Date de publication</label>
                    <input type="date" name="date_publication" required>
                </div>

            </div>

            <div class="btn-container">
                <button type="button" onclick="prevStep()">Retour</button>
                <button type="button" onclick="nextStep()">Suivant</button>
            </div>
        </div>

        <div class="form-container step-container" data-step="3">
  
            <div class="form-grid">
                <label style="color: white; font-size: 120%;margin-left:0%;" >Site Web:</label>
                <input type="text" name="siteweb" class="siteweb" 
                style="width: 90%; padding: 12px;border: none;border-radius: 30px;margin-left:-80%; margin-bottom: 5%;margin-top:-2%;
                 font-size: 14px;outline: none;"
                 required>

            </div>
            <br\>
            <div class="autre">
                <div>
                    <label>AUTRES INFORMATIONS :</label><br><br>
                    <textarea name="autres" rows="8" cols="130"></textarea>
                                </div>
            </div>
            <div class="btn-container">
                <button type="button" onclick="prevStep()">Retour</button>
                <button type="button" onclick="nextStep()">Suivant</button>
            </div>
        </div>

        <div class="form-container step-container" data-step="4">
            <div class="profil">
                <div>
                    <label>Photo de l'entreprise</label><br>
                    <input type="file" name="photo_entreprise" accept=".jpg,.jpeg,.png" required class="profile">
                </div>
            </div>

            <div class="btn-container">
                <button type="button" onclick="prevStep()">Retour</button>
                <button type="button" onclick="nextStep()">Suivant</button>
            </div>
        </div>

        <div class="form-container step-container" data-step="5">
            <div class="Cv">
                <div>
                    <label>Document PDF de l'offre</label>
                    <input type="file" name="doc" accept=".pdf" required class="cv">
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
