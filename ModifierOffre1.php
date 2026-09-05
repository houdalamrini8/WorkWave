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


$id_offre = $_GET['id_offre'] ?? null; 

if (!$id_offre) {
    die("ID de l'offre non spécifié.");
}

$stmt = $conn->prepare("SELECT * FROM offres WHERE id_offre = ? AND id_entreprise = ?");
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


    $photoName = $offre['photo_entreprise'];
    if ($_FILES['photo_entreprise']['error'] === 0) {
        $ext = strtolower(pathinfo($_FILES['photo_entreprise']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
            $photoName = uniqid() . '_' . basename($_FILES['photo_entreprise']['name']);
            move_uploaded_file($_FILES['photo_entreprise']['tmp_name'], "uploads/photosEntrep/" . $photoName);
        }
    }

    $docName = $offre['doc'];
    if ($_FILES['doc']['error'] === 0) {
        $ext = strtolower(pathinfo($_FILES['doc']['name'], PATHINFO_EXTENSION));
        if ($ext === 'pdf') {
            $docName = uniqid() . '_' . basename($_FILES['doc']['name']);
            move_uploaded_file($_FILES['doc']['tmp_name'], "uploads/docs/" . $docName);
        }
    }

    $update = $conn->prepare("UPDATE offres SET titre=?, lieu=?, salaire=?, description=?, type_contrat=?, date_publication=?, photo_entreprise=?, doc=? WHERE id_offre=?");
    $update->bind_param("ssssssssi", $titre, $lieu, $salaire, $description, $type_contrat, $date_publication, $photoName, $docName, $id_offre);

    if ($update->execute()) {
        header("Location: ProfilOffreE.php?id_offre=" . $id_offre);  
        exit;
    } else {
        die("Erreur de mise à jour.");
    }
}
?>
