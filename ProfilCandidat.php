<?php
session_start();
include "config.php";

if (!isset($_SESSION["id_utilisateur"]) || $_SESSION["user_type"] !== "candidat") {
    header("Location: Connexion.php");
    exit;
}

$id_utilisateur = $_SESSION["id_utilisateur"];


$query = $conn->prepare("SELECT id_candidat FROM utilisateur WHERE id_utilisateur = ?");
$query->bind_param("i", $id_utilisateur);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

if (!$user || !$user['id_candidat']) {
    header("Location: InfoCandidat.php");
    exit;
}

$id_candidat = $user['id_candidat'];


$stmt = $conn->prepare("SELECT * FROM candidat WHERE id_candidat = ?");
$stmt->bind_param("i", $id_candidat);
$stmt->execute();
$result = $stmt->get_result();
$candidat = $result->fetch_assoc();

if (!$candidat) {
    echo "Erreur : informations du candidat introuvables.";
    exit;
}

$photoPath = !empty($candidat['photo_candidat']) ? 'uploads/photos/' . htmlspecialchars($candidat['photo_candidat']) : 'images/avatar.png';
include "HautCandidat2.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>WorkWave - Profil Candidat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600&family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="CSS/ProfilCandidat2.css">
</head>

<body>
<div class="container py-5" style="border: 5px solid var(--beige);">
    <div class="row">
        <div class="col-md-6 text-center">

            <img src="<?= $photoPath ?>" class="rounded-circle mb-3" width="120" height="120" alt="Photo du candidat">


            <p><strong>Nom Complet :</strong> <?= htmlspecialchars($candidat['nom_candidat']) . ' ' . htmlspecialchars($candidat['prenom_candidat']) ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($candidat['email_candidat']) ?></p>
            <p><strong>Genre :</strong> <?= htmlspecialchars($candidat['genre']) ?></p>
            <p><strong>Pays :</strong> <?= htmlspecialchars($candidat['pays']) ?></p>
            <p><strong>Specialite :</strong> <?= htmlspecialchars($candidat['specialite']) ?></p>
            <p><strong>Autres informations :</strong> <?= htmlspecialchars($candidat['autres']) ?></p>

            <p><strong>CV :</strong> 
                <?php if (!empty($candidat['cv'])): ?>
                    <a href="uploads/cv/<?= htmlspecialchars($candidat['cv']) ?>" target="_blank">📥 Voir le CV</a>
                <?php else: ?>
                    <span>Aucun fichier</span>
                <?php endif; ?>
            </p>
            <a href="ModifierCandidat.php" class="btn btn-warning mt-3">Modifier</a>
        </div>
        <div class="col-md-6 border-start">
            <div class= "text">
            <p><strong>Boost ta carrière avec un CV qui cartonne !</strong> </p>
            <ul>
                <li>✅ Les secrets d’un CV qui se démarque</li>
                <li>✅ Les erreurs à éviter absolument</li>
                <li>✅ Un modèle prêt à l’emploi + conseils personnalisés</li>
            </ul>
            <p>🌟 Inscris-toi maintenant et transforme ton CV en une vraie machine à opportunités !</p>
            </div>
            <a href="coursCV.php" class=" btn-outline-warning " class="cv">COURS CV</a>
        </div>
    </div>
</div>
</body>
</html>