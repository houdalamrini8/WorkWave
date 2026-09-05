<?php
session_start();
include "config.php";

if (!isset($_SESSION["id_utilisateur"]) || $_SESSION["user_type"] !== "candidat") {
    header("Location: Connexion.php");
    exit;
}

$id_utilisateur = $_SESSION["id_utilisateur"];


$stmt = $conn->prepare("SELECT id_candidat FROM utilisateur WHERE id_utilisateur = ?");
$stmt->bind_param("i", $id_utilisateur);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "Utilisateur introuvable.";
    exit;
}

$id_candidat = $user['id_candidat'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom_candidat'];
    $prenom = $_POST['prenom_candidat'];
    $email = $_POST['email_candidat'];
    $pays = $_POST['pays'];
    $specialite = $_POST['specialite'];
    $genre = $_POST['genre'];
    $autres = $_POST['autres'];


    $photoName = $_POST['ancienne_photo'];
    if ($_FILES['photo_candidat']['error'] === 0) {
        $ext = strtolower(pathinfo($_FILES['photo_candidat']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
            $photoName = uniqid() . '_' . basename($_FILES['photo_candidat']['name']);
            move_uploaded_file($_FILES['photo_candidat']['tmp_name'], "uploads/photos/" . $photoName);
        }
    }

    $cvName = $_POST['ancien_cv'];
    if ($_FILES['cv']['error'] === 0) {
        $ext = strtolower(pathinfo($_FILES['cv']['name'], PATHINFO_EXTENSION));
        if ($ext === 'pdf') {
            $cvName = uniqid() . '_' . basename($_FILES['cv']['name']);
            move_uploaded_file($_FILES['cv']['tmp_name'], "uploads/cv/" . $cvName);
        }
    }

    $update = $conn->prepare("UPDATE candidat SET nom_candidat=?, prenom_candidat=?, email_candidat=?, pays=?, specialite=?, genre=?, autres=?, photo_candidat=?, cv=? WHERE id_candidat=?");
    $update->bind_param("sssssssssi", $nom, $prenom, $email, $pays, $specialite, $genre, $autres, $photoName, $cvName, $id_candidat);
    if ($update->execute()) {
        header("Location:ProfilCandidat.php");
        exit;
    } else {
        echo "Erreur de mise à jour.";
    }
}

$stmt = $conn->prepare("SELECT * FROM candidat WHERE id_candidat = ?");
$stmt->bind_param("i", $id_candidat);
$stmt->execute();
$result = $stmt->get_result();
$candidat = $result->fetch_assoc();

?>