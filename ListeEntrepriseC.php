<?php
include "HautCandidat3.php";
include "config.php"; 

$result = $conn->query("SELECT id_entreprise, nom_entreprise, photo_entreprise FROM entreprise");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des entreprises</title>
    <link rel="stylesheet" href="css/Liste.css">
</head>
<body>
    <h1>Liste des entreprises</h1>
    <div class="grid-container">
        <?php while ($entreprise = $result->fetch_assoc()): ?>
            <div class="offre-card" style="border: 5px solid var(--beige);">
                <div class="text-part">
                    <strong><?= htmlspecialchars($entreprise['nom_entreprise']) ?></strong><br>
                    <a href="ProfilEntreprise1C.php?id=<?= $entreprise['id_entreprise'] ?>">Voir détails ></a>
                </div>
                <div class="photo-part" style="border: 5px solid var(--beige);">
                    <?php if (!empty($entreprise['photo_entreprise']) && file_exists('uploads/photosEntrep/' . $entreprise['photo_entreprise'])): ?>
                        <img src="uploads/photosEntrep/<?= htmlspecialchars($entreprise['photo_entreprise']) ?>" 
                             alt="Logo <?= htmlspecialchars($entreprise['nom_entreprise']) ?>" 
                             width="110" height="130" 
                             style="object-fit: cover; border-radius: 8px; margin-right:-2.5%;">
                    <?php else: ?>
                        <p>Photo non disponible</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>