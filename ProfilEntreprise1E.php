<?php
include "config.php";
include "HautEntreprise.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo " ID de l'entreprise manquant dans l'URL.";
    exit;
}

$id_entreprise = intval($_GET['id']);

$result = $conn->query("SELECT * FROM entreprise WHERE id_entreprise = $id_entreprise");

if (!$result) {
    die(" Erreur lors de l'exécution de la requête : " . $conn->error);
}

if ($result->num_rows === 0) {
    echo "Aucune entreprise trouvée avec l'ID $id_entreprise.";
    exit;
}

$entreprise = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil Entreprise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/ProfilEntreprise1.css">
</head>
<body class="bg-light m-0 p-0">

<div class="container-fluid px-0">
    <div class="content">
        <h2 class="mb-4">Profil de l'entreprise : <?= htmlspecialchars($entreprise['nom_entreprise']) ?></h2>
        <div class="row">
            <div class="col-md-4">
                <?php if (!empty($entreprise['photo_entreprise']) && file_exists('uploads/photosEntrep/' . $entreprise['photo_entreprise'])): ?>
                    <img src="uploads/photosEntrep/<?= htmlspecialchars($entreprise['photo_entreprise']) ?>" class="img-fluid rounded" alt="Photo entreprise">
                <?php else: ?>
                    <p>Photo non disponible</p>
                <?php endif; ?>
            </div>
            <div class="col-md-8">
                <p><strong>Nom :</strong> <?= htmlspecialchars($entreprise['nom_entreprise']) ?></p>
                <p><strong>Email :</strong> <?= htmlspecialchars($entreprise['email_entreprise']) ?></p>
                <p><strong>Adresse :</strong> <?= htmlspecialchars($entreprise['adresse']) ?></p>
                <p><strong>Site web :</strong> <?= htmlspecialchars($entreprise['siteweb']) ?></p>

                <a href="ListeOffreParEntrepE.php?id=<?= $entreprise['id_entreprise'] ?>" class="btn-offres mt-3">Voir les offres de cette entreprise</a>
            </div>
        </div>
        <a href="ListeOffreE.php" class="btn btn-secondary mt-4">← Retour à la liste</a>
    </div>
</div>

</body>
</html>
