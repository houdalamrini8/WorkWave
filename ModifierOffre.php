<?php
session_start();
include "config.php";

if (!isset($_SESSION["id_utilisateur"]) || $_SESSION["user_type"] !== "entreprise") {
    header("Location: Connexion.php");
    exit;
}

$id_utilisateur = $_SESSION["id_utilisateur"];

$query = $conn->prepare("SELECT id_entreprise FROM utilisateur WHERE id_utilisateur = ?");
if (!$query) {
    die("Erreur dans prepare() : " . $conn->error);
}
$query->bind_param("i", $id_utilisateur);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Utilisateur non trouvé.");
}

$id_entreprise = $user['id_entreprise'];


$id_offre = isset($_GET['id_offre']) ? $_GET['id_offre'] : null;
if (!$id_offre) {
    die("ID de l'offre non spécifié.");
}


$stmt = $conn->prepare("SELECT o.*, e.photo_entreprise FROM offres o 
                        JOIN entreprise e ON e.id_entreprise = o.id_entreprise 
                        WHERE o.id_offre = ? AND o.id_entreprise = ?");
if (!$stmt) {
    die("Erreur dans prepare() : " . $conn->error);
}
$stmt->bind_param("ii", $id_offre, $id_entreprise);
$stmt->execute();
$result = $stmt->get_result();
$offre = $result->fetch_assoc();

if (!$offre) {
    die("Offre non trouvée.");
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
    $titre = $_POST['titre'];
    $lieu = $_POST['lieu'];
    $salaire = $_POST['salaire'];
    $description = $_POST['description'];
    $type_contrat = $_POST['type_contrat'];
    $date_publication = $_POST['date_publication'];

 
    $photo_entreprise = $offre['photo_entreprise']; 
    if (isset($_FILES['photo_entreprise']) && $_FILES['photo_entreprise']['error'] === 0) {
        $photo_entreprise = uniqid() . '_' . basename($_FILES['photo_entreprise']['name']);
        move_uploaded_file($_FILES['photo_entreprise']['tmp_name'], "uploads/photosEntrep/" . $photo_entreprise);
    }

    $doc = $offre['doc']; 
    if (isset($_FILES['doc']) && $_FILES['doc']['error'] === 0) {
        $doc = uniqid() . '_' . basename($_FILES['doc']['name']);
        move_uploaded_file($_FILES['doc']['tmp_name'], "uploads/docs/" . $doc);
    }


    $update_stmt = $conn->prepare("UPDATE offres SET titre=?, lieu=?, salaire=?, description=?, type_contrat=?, date_publication=?, doc=? WHERE id_offre=? AND id_entreprise=?");
    if (!$update_stmt) {
        die("Erreur dans prepare() : " . $conn->error);
    }

    $update_stmt->bind_param("ssssssssi", $titre, $lieu, $salaire, $description, $type_contrat, $date_publication, $doc, $id_offre, $id_entreprise);

    if ($update_stmt->execute()) {
        
        if ($photo_entreprise !== $offre['photo_entreprise']) {
            $update_photo_stmt = $conn->prepare("UPDATE entreprise SET photo_entreprise=? WHERE id_entreprise=?");
            if (!$update_photo_stmt) {
                die("Erreur dans prepare() : " . $conn->error);
            }

            $update_photo_stmt->bind_param("si", $photo_entreprise, $id_entreprise);
            $update_photo_stmt->execute();
        }

        header("Location: ProfilOffreE.php?id_offre=" . $id_offre); 
        exit;
    } else {
        echo "Erreur de mise à jour.";
    }
}

include "HautEntreprise3.php"; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'Offre</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
  <link rel="stylesheet" href="CSS/ModifierOffre.css">

    <body>
<div class="container">
    <h2 class="my-4">Modifier l'offre</h2>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" value="<?= htmlspecialchars($offre['titre']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="lieu" class="form-label">Lieu</label>
            <input type="text" class="form-control" id="lieu" name="lieu" value="<?= htmlspecialchars($offre['lieu']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="salaire" class="form-label">Salaire</label>
            <input type="text" class="form-control" id="salaire" name="salaire" value="<?= htmlspecialchars($offre['salaire']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required><?= htmlspecialchars($offre['description']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="type_contrat" class="form-label">Type de contrat</label>
            <input type="text" class="form-control" id="type_contrat" name="type_contrat" value="<?= htmlspecialchars($offre['type_contrat']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="date_publication" class="form-label">Date de publication</label>
            <input type="date" class="form-control" id="date_publication" name="date_publication" value="<?= htmlspecialchars($offre['date_publication']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="photo_entreprise" class="form-label">Photo de l'entreprise</label>
            <input type="file" class="form-control" id="photo_entreprise" name="photo_entreprise">
            <?php if (!empty($offre['photo_entreprise'])): ?>
                <img src="uploads/photosEntrep/<?= htmlspecialchars($offre['photo_entreprise']) ?>" width="100">
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="doc" class="form-label">Document PDF</label>
            <input type="file" class="form-control" id="doc" name="doc">
            <?php if (!empty($offre['doc'])): ?>
                <a href="uploads/docs/<?= htmlspecialchars($offre['doc']) ?>" target="_blank">📄 Voir le document</a>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="ProfilOffreE.php?id_offre=<?= $offre['id_offre'] ?>" class="btn btn-secondary">Annuler</a>
    </form>
</div>
</body>
</html>
