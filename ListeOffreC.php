<?php 
include "HautCandidat1.php";
include "config.php";
$sql = "SELECT offres.*, entreprise.nom_entreprise, entreprise.photo_entreprise 
        FROM offres 
        INNER JOIN entreprise ON offres.id_entreprise = entreprise.id_entreprise";

$result = $conn->query($sql);

if (!$result) {
    die("Erreur SQL : " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>WorkWave</title>
        <link rel="stylesheet" href="css/Liste.css">
    </head>
    
    <h1>Liste des Offres</h1>

    <div class="grid-container">
        <?php while ($offre = $result->fetch_assoc()): ?>
            <div class="offre-card" style="border: 5px solid var(--beige);">
                <div class="text-part">
                    <strong><?= htmlspecialchars($offre['titre']) ?> </strong>
                    <br><?= htmlspecialchars($offre['description']) ?><br><br>
                    <div style="margin-bottom: 50px;">
                    <a href="ProfilOffre1C.php?id=<?= $offre['id_offre'] ?>">plus de détails ></a>
                    </div>
                </div>
                <div class="photo-part" style="border: 5px solid var(--beige);">
                    <?php if (!empty($offre['photo_entreprise'])): ?>
                        <img src="uploads/photosEntrep/<?= htmlspecialchars($offre['photo_entreprise']) ?>" alt="Photo du entreprise" width="110" height="130" style="object-fit: cover; border-radius: 8px; margin-right:-2.5%;">
                    <?php else: ?>
                        <p>Photo non disponible</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
