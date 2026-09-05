<?php
/*nono */
include "config.php"; 
include "HautEntreprise3.php";

session_start();


$id_offre = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id_offre) {
    echo "Offre introuvable.";
    exit;
}


$stmt = $conn->prepare("SELECT o.*, e.nom_entreprise, e.photo_entreprise FROM offres o
                        JOIN entreprise e ON o.id_entreprise = e.id_entreprise
                        WHERE o.id_offre = ?");
if (!$stmt) {
    die("Erreur de préparation de la requête : " . $conn->error);
}

$stmt->bind_param("i", $id_offre);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows === 0) {
    echo "Aucune offre trouvée pour l'ID : " . $id_offre;
    exit;
}

$offre = $result->fetch_assoc();


$id_utilisateur = isset($_SESSION['id_utilisateur']) ? $_SESSION['id_utilisateur'] : null;


if (isset($_POST['ajouter_commentaire'], $_POST['contenu']) && !empty($_POST['contenu']) && $id_utilisateur) {
    $contenu = htmlspecialchars(trim($_POST['contenu']));

    $sqlInsert = "INSERT INTO commentaire (id_utilisateur, id_offre, contenu, date_commentaire)
                  VALUES (?, ?, ?, NOW())";

    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param("iis", $id_utilisateur, $id_offre, $contenu);
    $stmtInsert->execute();


    header("Location: ?id=$id_offre");
    exit;
}


$sqlCommentaires = "SELECT c.*, u.name 
                   FROM commentaire c
                   JOIN utilisateur u ON c.id_utilisateur = u.id_utilisateur
                   WHERE c.id_offre = ?
                   ORDER BY c.date_commentaire DESC";

$stmtCommentaires = $conn->prepare($sqlCommentaires);
$stmtCommentaires->bind_param("i", $id_offre);
$stmtCommentaires->execute();

$resultCommentaires = $stmtCommentaires->get_result();
$commentaires = $resultCommentaires->fetch_all(MYSQLI_ASSOC);


if (isset($_GET['supprimer_commentaire'])) {
    $id_commentaire = filter_input(INPUT_GET, 'supprimer_commentaire', FILTER_VALIDATE_INT);

    if ($id_commentaire) {
       
        $sqlCheckUser = "SELECT id_utilisateur FROM commentaire WHERE id = ?";
        $stmtCheckUser = $conn->prepare($sqlCheckUser);
        $stmtCheckUser->bind_param("i", $id_commentaire);
        $stmtCheckUser->execute();
        $resultCheckUser = $stmtCheckUser->get_result();

        if ($resultCheckUser->num_rows > 0) {
            $commentaire = $resultCheckUser->fetch_assoc();
            if ($commentaire['id_utilisateur'] == $id_utilisateur) {
                
                $sqlDelete = "DELETE FROM commentaire WHERE id = ?";
                $stmtDelete = $conn->prepare($sqlDelete);
                $stmtDelete->bind_param("i", $id_commentaire);
                $stmtDelete->execute();
            } else {
                echo "Vous ne pouvez pas supprimer ce commentaire.";
            }
        } else {
            echo "Commentaire introuvable.";
        }
    }


    header("Location: ?id=$id_offre");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de l'Offre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/ProfilOffre1.css">
</head>
<body class="bg-light">

    <div class="container bg-white p-4 rounded shadow">
        <h2 class="mb-4">Détails de l'offre : <?= htmlspecialchars($offre['titre']) ?></h2>
        <div class="row">

            <div class="col-md-4">
                <?php if (!empty($offre['photo_entreprise']) && file_exists('uploads/photosEntrep/' . $offre['photo_entreprise'])): ?>
                    <img src="uploads/photosEntrep/<?= htmlspecialchars($offre['photo_entreprise']) ?>" class="img-fluid rounded" alt="Photo entreprise">
                <?php else: ?>
                    <p>Pas de photo disponible pour l'entreprise</p>
                <?php endif; ?>
                <p><strong>Entreprise :</strong> <?= htmlspecialchars($offre['nom_entreprise']) ?></p>
            </div>
                    <div class="col-md-8">
                <p><strong>Titre de l'offre :</strong> <?= htmlspecialchars($offre['titre']) ?></p>
                <p><strong>Description :</strong> <?= nl2br(htmlspecialchars($offre['description'])) ?></p>
                <p><strong>Salaire :</strong> <?= htmlspecialchars($offre['salaire']) ?> DH</p>
                <p><strong>Lieu :</strong> <?= htmlspecialchars($offre['lieu']) ?></p>
                <p><strong>Type de contrat :</strong> <?= htmlspecialchars($offre['type_contrat']) ?></p>
                <p><strong>Date de publication :</strong> <?= htmlspecialchars($offre['date_publication']) ?></p>
                <p><strong>Autres informations :</strong> <?= nl2br(htmlspecialchars($offre['autres'])) ?></p>

                <?php if (!empty($offre['doc']) && file_exists('uploads/docs/' . $offre['doc'])): ?>
                    <p><strong>Document associé :</strong> <a href="uploads/docs/<?= htmlspecialchars($offre['doc']) ?>" target="_blank">Voir le document</a></p>
                <?php else: ?>
                    <p><strong>Document :</strong> Aucun document associé</p>
                <?php endif; ?>
            </div>
        </div>
        <a href="ListeOffreE.php" class="btn btn-secondary mt-4">← Retour à la liste des offres</a> 
       
    </div>
    <div class="comment-section">
  
    <div class="card mt-4">
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label for="contenu" class="form-label">Ajouter un commentaire</label>
                    <textarea class="form-control" id="contenu" name="contenu" rows="3" required></textarea>
                </div>
                <button type="submit" name="ajouter_commentaire">Publier</button>
            </form>
        </div>
    </div>

    <?php foreach ($commentaires as $commentaire): ?>
        <div class="card mt-3">
            <div class="card-body">
                <p class="comment-author"><?= htmlspecialchars($commentaire['name']) ?> :</p>
                <p class="comment-content"><?= nl2br(htmlspecialchars($commentaire['contenu'])) ?></p>
                <small class="comment-date"><?= htmlspecialchars($commentaire['date_commentaire']) ?></small>
                
                <?php if ($commentaire['id_utilisateur'] == $id_utilisateur): ?>
                    <a href="?id=<?= $id_offre ?>&supprimer_commentaire=<?= $commentaire['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>


</body>
</html>
