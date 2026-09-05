<?php 
include "HautEntreprise1.php";
include "config.php";

$result = $conn->query("SELECT id_candidat, nom_candidat, prenom_candidat, specialite, photo_candidat FROM candidat");
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>WorkWave</title>
        <link rel="stylesheet" href="css/Liste.css">
    </head>


    <h1>Liste des Candidats</h1>

    <div class="grid-container">
        <?php while ($offre = $result->fetch_assoc()): ?>
            <div class="offre-card" style="border: 5px solid var(--beige);">
                <div class="text-part">
                    <strong><?= htmlspecialchars($offre['nom_candidat']) ?> <?= htmlspecialchars($offre['prenom_candidat']) ?></strong><br>
                    <?= htmlspecialchars($offre['specialite']) ?><br>
                    <a href="ProfilCandidat1E.php?id=<?= $offre['id_candidat'] ?>">plus de détails ></a>
                </div>

                <div class="photo-part" style="border: 5px solid var(--beige);">
                    <?php if (!empty($offre['photo_candidat'])): ?>
                        <img src="uploads/photos/<?= htmlspecialchars($offre['photo_candidat']) ?>" alt="Photo du candidat" width="110" height="120" style="object-fit: cover; border-radius: 8px; margin-right:-2.5%;">
                    <?php else: ?>
                        <p>Photo non disponible</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
