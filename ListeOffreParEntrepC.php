<?php
include "HautCandidat1.php";
include "config.php";


if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "⚠️ ID de l'entreprise manquant dans l'URL.";
    exit;
}

$id_entreprise = intval($_GET['id']);

$query = "SELECT o.id_offre, o.titre, o.description, e.photo_entreprise, e.nom_entreprise 
          FROM offres o
          JOIN entreprise e ON o.id_entreprise = e.id_entreprise
          WHERE o.id_entreprise = $id_entreprise";
$result = $conn->query($query);

if (!$result) {
    die("Erreur dans la requête: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Offres de l'entreprise</title>
    <link rel="stylesheet" href="css/Liste.css">
</head>
<body>
    <h1>Offres publiées par cette entreprise</h1>
    <div class="grid-container">
        <?php if ($result->num_rows === 0): ?>
            <p>Aucune offre trouvée pour cette entreprise.</p>
        <?php else: ?>
            <?php while ($offre = $result->fetch_assoc()): ?>
                <div class="offre-card" style="border: 5px solid #D2B48C;">
                    <div class="text-part">
                        <strong><?= htmlspecialchars($offre['titre']) ?></strong><br>
                        <?= htmlspecialchars($offre['description']) ?><br>
                        <a href="ProfilOffreC.php?id=<?= $offre['id_offre'] ?>">plus de détails ></a>
                    </div>
                    <div class="photo-part" style="border: 5px solid #D2B48C;">
                        <?php if (!empty($offre['photo_entreprise']) && file_exists('uploads/photosEntrep/' . $offre['photo_entreprise'])): ?>
                            <img src="uploads/photosEntrep/<?= htmlspecialchars($offre['photo_entreprise']) ?>" 
                                 alt="Photo entreprise" 
                                 width="110" height="130" 
                                 style="object-fit: cover; border-radius: 8px;">
                        <?php else: ?>
                            <p>Photo non disponible</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</body>
</html>

<?php 
$result->close();
$conn->close();
?>
