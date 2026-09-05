<?php  
session_start();
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $photoDir = 'uploads/photosEntrep/';
    $docDir = 'uploads/docs/';
    if (!is_dir($photoDir)) mkdir($photoDir, 0777, true);
    if (!is_dir($docDir)) mkdir($docDir, 0777, true);


    $nom_entreprise = isset($_POST['nom_entreprise']) ? $_POST['nom_entreprise'] : '';
    $domaine = isset($_POST['domaine']) ? $_POST['domaine'] : '';
    $email_entreprise = isset($_POST['email_entreprise']) ? $_POST['email_entreprise'] : '';
    $statut = isset($_POST['statut']) ? $_POST['statut'] : '';
    $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : '';
    $horaire = isset($_POST['horaire']) ? $_POST['horaire'] : '';
    $siteweb = isset($_POST['siteweb']) ? $_POST['siteweb'] : '';

    $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $salaire = isset($_POST['salaire']) ? $_POST['salaire'] : '';
    $lieu = isset($_POST['lieu']) ? $_POST['lieu'] : '';
    $type_contrat = isset($_POST['type_contrat']) ? $_POST['type_contrat'] : '';
    $date_publication = isset($_POST['date_publication']) ? $_POST['date_publication'] : '';
    $autres = isset($_POST['autres']) ? $_POST['autres'] : '';


    $photo = isset($_FILES['photo_entreprise']) ? $_FILES['photo_entreprise'] : null;
    $photoName = null;
    if ($photo && $photo['error'] === 0) {
        $ext = strtolower(pathinfo($photo['name'], PATHINFO_EXTENSION));
        if (in_array($ext, array('jpg', 'jpeg', 'png'))) {
            $photoName = uniqid() . '_' . basename($photo['name']);
            move_uploaded_file($photo['tmp_name'], $photoDir . $photoName);
        } else {
            die("Erreur : Seuls les fichiers JPG, JPEG et PNG sont autorisés.");
        }
    }

    $doc = isset($_FILES['doc']) ? $_FILES['doc'] : null;
    $docName = null;
    if ($doc && $doc['error'] === 0 && $doc['size'] > 0) {
        $ext = strtolower(pathinfo($doc['name'], PATHINFO_EXTENSION));
        if ($ext === 'pdf') {
            $docName = uniqid() . '_' . basename($doc['name']);
            if (!move_uploaded_file($doc['tmp_name'], $docDir . $docName)) {
                die("Erreur : Le fichier PDF n'a pas pu être enregistré.");
            }
        } else {
            die("Erreur : Seuls les fichiers PDF sont autorisés.");
        }
    } else {
        die("Erreur : Le fichier PDF est requis.");
    }


    $stmtCheckEntreprise = $conn->prepare("SELECT id_entreprise FROM entreprise WHERE nom_entreprise = ?");
    if (!$stmtCheckEntreprise) die("Erreur préparation vérification entreprise : " . $conn->error);
    $stmtCheckEntreprise->bind_param("s", $nom_entreprise);
    $stmtCheckEntreprise->execute();
    $stmtCheckEntreprise->store_result();

    if ($stmtCheckEntreprise->num_rows > 0) {

        $stmtCheckEntreprise->bind_result($id_entreprise);
        $stmtCheckEntreprise->fetch();
    } else {

        $stmtEntreprise = $conn->prepare("INSERT INTO entreprise (nom_entreprise, domaine, email_entreprise, statut, adresse, horaire, siteweb, photo_entreprise) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmtEntreprise) die("Erreur préparation entreprise : " . $conn->error);
        $stmtEntreprise->bind_param("ssssssss", $nom_entreprise, $domaine, $email_entreprise, $statut, $adresse, $horaire, $siteweb, $photoName);
        if (!$stmtEntreprise->execute()) die("Erreur insertion entreprise : " . $stmtEntreprise->error);

        $id_entreprise = $conn->insert_id;
    }


    $stmtOffre = $conn->prepare("INSERT INTO offres (titre, description, salaire, lieu, type_contrat, date_publication, autres, doc, id_entreprise) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmtOffre) die("Erreur préparation offre : " . $conn->error);
    $stmtOffre->bind_param("ssssssssi", $titre, $description, $salaire, $lieu, $type_contrat, $date_publication, $autres, $docName, $id_entreprise);

    if ($stmtOffre->execute()) {

        $id_utilisateur = isset($_SESSION['id_utilisateur']) ? $_SESSION['id_utilisateur'] : null;

        if ($id_utilisateur !== null) {

            $updateStmt = $conn->prepare("UPDATE utilisateur SET id_entreprise = ? WHERE id_utilisateur = ?");
            $updateStmt->bind_param("ii", $id_entreprise, $id_utilisateur);
            $updateStmt->execute();

            $updateStmt->close();
        }

        header("Location: ListeOffreE.php");
        
        exit;
    } else {
        die("Erreur insertion offre : " . $stmtOffre->error);
    }
}
?>
