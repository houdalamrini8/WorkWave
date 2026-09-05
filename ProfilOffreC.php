<?php
session_start();
include "config.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID de l'offre manquant dans l'URL.";
    exit;
}

$id_offre = intval($_GET['id']);


$stmt = $conn->prepare("
    SELECT e.*, o.* 
    FROM entreprise e 
    JOIN offres o ON e.id_entreprise = o.id_entreprise 
    WHERE o.id_offre = ?
");
if (!$stmt) {
    die("Erreur dans prepare() : " . $conn->error);
}
$stmt->bind_param("i", $id_offre);
$stmt->execute();
$result = $stmt->get_result();
$offre = $result->fetch_assoc();

if (!$offre) {
    echo "Offre introuvable.";
    exit;
}


$photoPath = !empty($offre['photo_entreprise']) ? 'uploads/photosEntrep/' . basename($offre['photo_entreprise']) : 'images/company_default.png';
$docPath = !empty($offre['doc']) ? 'uploads/docs/' . basename($offre['doc']) : null;

include "HautCandidat1.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil de l'Offre</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/HautEntreprise.css">
    <link rel="stylesheet" href="CSS/ProfilOffre.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600&family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="container py-5" style="border: 5px solid var(--beige);">
    <div class="row">
       
        <div class="col-md-6 text-center">
            <img src="<?= $photoPath ?>" class="rounded mb-3" width="120" height="120" alt="Photo Entreprise">
            <p><strong>Nom Entreprise :</strong> <?= htmlspecialchars($offre['nom_entreprise']) ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($offre['email_entreprise']) ?></p>
            <p><strong>Domaine :</strong> <?= htmlspecialchars($offre['domaine']) ?></p>
            <p><strong>Statut :</strong> <?= htmlspecialchars($offre['statut']) ?></p>
            <p><strong>Adresse :</strong> <?= htmlspecialchars($offre['adresse']) ?></p>
            <p><strong>Horaire :</strong> <?= htmlspecialchars($offre['horaire']) ?></p>
            <p><strong>Site Web :</strong> <?= htmlspecialchars($offre['siteweb']) ?></p>
            <p><strong>Autres Informations :</strong> <?= nl2br(htmlspecialchars($offre['autres'])) ?></p>
        </div>

        <div class="col-md-6 border-start">
            <h4><strong>Détails de l'Offre</strong></h4>
            <p><strong>Titre :</strong> <?= htmlspecialchars($offre['titre']) ?></p>
            <p><strong>Lieu :</strong> <?= htmlspecialchars($offre['lieu']) ?></p>
            <p><strong>Salaire :</strong> <?= htmlspecialchars($offre['salaire']) ?></p>
            <p><strong>Description :</strong> <?= htmlspecialchars($offre['description']) ?></p>
            <p><strong>Type de contrat :</strong> <?= htmlspecialchars($offre['type_contrat']) ?></p>
            <p><strong>Date de publication :</strong> <?= htmlspecialchars($offre['date_publication']) ?></p>
            <p><strong>Document PDF :</strong>
                <?php if ($docPath): ?>
                    <a href="<?= $docPath ?>" target="_blank">📄 Voir le document</a>
                <?php else: ?>
                    <span>Aucun document disponible</span>
                <?php endif; ?>
            </p>

            <?php if (isset($_SESSION['id_entreprise']) && $_SESSION['id_entreprise'] == $offre['id_entreprise']): ?>
 
                <div class="d-flex gap-3 mt-4">
                    <a href="ModifierOffre.php?id_offre=<?= $offre['id_offre'] ?>" class="btn btn-warning">Modifier l'offre</a>
                    <a href="SuppOffre.php?id_offre=<?= $offre['id_offre'] ?>" 
                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ?');" 
                       class="btn btn-danger">Supprimer</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
