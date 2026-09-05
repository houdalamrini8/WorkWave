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

$stmt = $conn->prepare("DELETE FROM offres WHERE id_offre = ? AND id_entreprise = ?");
if (!$stmt) {
    die("Erreur dans prepare() : " . $conn->error);
}

$stmt->bind_param("ii", $id_offre, $id_entreprise); 
if ($stmt->execute()) {
   
    header("Location: ListeOffreParEntrepE.php?id=" . $id_entreprise);
    exit;
} else {
    die("Erreur lors de la suppression de l'offre : " . $stmt->error);
}
?>
