<?php
include "config.php";
include "HautCandidat.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Candidat introuvable.";
    exit;
}

$id_candidat = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM candidat WHERE id_candidat = ?");
$stmt->bind_param("i", $id_candidat);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Candidat non trouvé.";
    exit;
}

$candidat = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil Candidat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- responsive -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/ProfilCandidat1.css">
</head>
<body style="margin: 0; padding: 0; background-color: #f8f9fa;">

    <div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 100vh; padding: 0 20px;">
        <div class="container bg-white p-5 rounded shadow" style="max-width: 1100px; width: 100%;">
            <h2 class="mb-5 text-center">Profil de <?= htmlspecialchars($candidat['prenom_candidat']) ?> <?= htmlspecialchars($candidat['nom_candidat']) ?></h2>
            <div class="row">
                <div class="col-md-4 text-center mb-4 mb-md-0" style="margin-top: -40px;">
                    <?php if (!empty($candidat['photo_candidat'])): ?>
                        <img src="uploads/photos/<?= htmlspecialchars($candidat['photo_candidat']) ?>" class="img-fluid rounded-circle border" alt="Photo" style="width: 180px; height: 180px; object-fit: cover;">
                    <?php else: ?>
                        <p>Pas de photo disponible</p>
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <p><strong>Email :</strong> <?= htmlspecialchars($candidat['email_candidat']) ?></p>
                    <p><strong>Pays :</strong> <?= htmlspecialchars($candidat['pays']) ?></p>
                    <p><strong>Genre :</strong> <?= htmlspecialchars($candidat['genre']) ?></p>
                    <p><strong>Spécialité :</strong> <?= htmlspecialchars($candidat['specialite']) ?></p>
                    <p><strong>Autres :</strong> <?= nl2br(htmlspecialchars($candidat['autres'])) ?></p>

                    <?php if (!empty($candidat['cv'])): ?>
                        <p><strong>CV :</strong> <a href="uploads/cv/<?= htmlspecialchars($candidat['cv']) ?>" target="_blank">📄 Voir le CV</a></p>
                    <?php endif; ?>

                    <?php if (!empty($candidat['id_pdf'])): ?>
                        <p><strong>PDF :</strong> <a href="uploads/pdf/<?= htmlspecialchars($candidat['id_pdf']) ?>" target="_blank">📑 Voir le PDF</a></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="mt-5 text-start">
                <a href="ListeCandidatC.php" class="btn btn-secondary">← Retour à la liste</a>
            </div>
        </div>
    </div>

</body>
</html>
