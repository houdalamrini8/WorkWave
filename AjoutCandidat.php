<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

include "config.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $photoDir = 'uploads/photos/';
    $cvDir = 'uploads/cv/';
    if (!is_dir($photoDir)) mkdir($photoDir, 0777, true);
    if (!is_dir($cvDir)) mkdir($cvDir, 0777, true);

 
    $nom = isset($_POST['nom_candidat']) ? $_POST['nom_candidat'] : '';
    $prenom = isset($_POST['prenom_candidat']) ? $_POST['prenom_candidat'] : '';
    $specialite = isset($_POST['specialite']) ? $_POST['specialite'] : '';
    $pays = isset($_POST['pays']) ? $_POST['pays'] : '';
    $email = isset($_POST['email_candidat']) ? $_POST['email_candidat'] : '';
    $genre = isset($_POST['genre']) ? $_POST['genre'] : '';
    $autres = isset($_POST['autres']) ? $_POST['autres'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : null;  

  
    $photo = $_FILES['photo_candidat'];
    $photoName = null;
    if ($photo['error'] === 0) {
        $ext = strtolower(pathinfo($photo['name'], PATHINFO_EXTENSION));
        if (in_array($ext, array('jpg', 'jpeg', 'png'))) {
            $photoName = uniqid() . '_' . basename($photo['name']);
            move_uploaded_file($photo['tmp_name'], $photoDir . $photoName);
        } else {
            die("Erreur : Seuls les fichiers JPG et PNG sont autorisés pour la photo.");
        }
    }

    $cv = $_FILES['cv'];
    $cvName = null;
    if ($cv['error'] === 0 && $cv['size'] > 0) {
        $cvExtension = strtolower(pathinfo($cv['name'], PATHINFO_EXTENSION));
        if ($cvExtension === 'pdf') {
            $cvName = uniqid() . '_' . basename($cv['name']);
            $cvPath = $cvDir . $cvName;
            if (!move_uploaded_file($cv['tmp_name'], $cvPath)) {
                die("Erreur : Échec de l'enregistrement du fichier CV.");
            }
        } else {
            die("Erreur : Seuls les fichiers PDF sont autorisés pour le CV.");
        }
    } else {
        die("Erreur : Le fichier CV est requis.");
    }


    $stmt = $conn->prepare("INSERT INTO candidat (nom_candidat, prenom_candidat, specialite, pays, email_candidat, genre, age, cv, photo_candidat, autres) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $nom, $prenom, $specialite, $pays, $email, $genre, $age, $cvName, $photoName, $autres);

    if ($stmt->execute()) {
       
        $id_candidat = $stmt->insert_id;

        $id_utilisateur = isset($_SESSION['id_utilisateur']) ? $_SESSION['id_utilisateur'] : null;

        if ($id_utilisateur !== null) {
           
            $updateStmt = $conn->prepare("UPDATE utilisateur SET id_candidat = ? WHERE id_utilisateur = ?");
            $updateStmt->bind_param("ii", $id_candidat, $id_utilisateur);
            $updateStmt->execute();
            $updateStmt->close();
        }

     
        header("Location: ProfilCandidat.php");
        
        exit;
    } else {
        echo "Erreur lors de l'insertion : " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Méthode invalide.";
}
?>
