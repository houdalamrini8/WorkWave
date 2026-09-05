<?php include "HautCandidat2.php"; ?>
<?php include "ModifierCandidat1.php"; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/ModifierOffre.css">
</head>
<body class="bg-light"> 

<div class="container bg-white p-5 rounded shadow mt-5">
    <h2 class="mb-4 text-center">Modifier votre profil</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col">
                <label>Nom</label>
                <input type="text" class="form-control" name="nom_candidat" value="<?= htmlspecialchars($candidat['nom_candidat']) ?>" required>
            </div>
            <div class="col">
                <label>Prénom</label>
                <input type="text" class="form-control" name="prenom_candidat" value="<?= htmlspecialchars($candidat['prenom_candidat']) ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" name="email_candidat" value="<?= htmlspecialchars($candidat['email_candidat']) ?>" required>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Pays</label>
                <input type="text" class="form-control" name="pays" value="<?= htmlspecialchars($candidat['pays']) ?>" required>
            </div>
            <div class="col">
                <label>Genre</label>
                <select class="form-control" name="genre">
                    <option <?= $candidat['genre'] === 'Homme' ? 'selected' : '' ?>>Homme</option>
                    <option <?= $candidat['genre'] === 'Femme' ? 'selected' : '' ?>>Femme</option>
                    <option <?= $candidat['genre'] === 'Autre' ? 'selected' : '' ?>>Autre</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Spécialité</label>
            <input type="text" class="form-control" name="specialite" value="<?= htmlspecialchars($candidat['specialite']) ?>" required>
        </div>

        <div class="mb-3">
            <label>Autres informations</label>
            <textarea class="form-control" name="autres"><?= htmlspecialchars($candidat['autres']) ?></textarea>
        </div>

        <div class="mb-3">
            <label>Photo actuelle</label><br>
            <img src="uploads/photos/<?= htmlspecialchars($candidat['photo_candidat']) ?>" alt="Photo" width="100">
            <input type="hidden" name="ancienne_photo" value="<?= htmlspecialchars($candidat['photo_candidat']) ?>">
            <input type="file" class="form-control mt-2" name="photo_candidat" accept="image/*">
        </div>

        <div class="mb-3">
            <label>CV actuel</label><br>
            <a href="uploads/cv/<?= htmlspecialchars($candidat['cv']) ?>" target="_blank">📥 Voir le CV</a>
            <input type="hidden" name="ancien_cv" value="<?= htmlspecialchars($candidat['cv']) ?>">
            <input type="file" class="form-control mt-2" name="cv" accept="application/pdf">
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        <a href="ProfilCandidat.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>
</body>
</html>
