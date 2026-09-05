<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE name = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user["password"])) {
            $_SESSION["id_utilisateur"] = $user["id_utilisateur"];
            $_SESSION["user_type"] = $user["user_type"];
            $_SESSION["id_entreprise"] = $user["id_entreprise"]; 

            if ($user["user_type"] == "candidat") {
                if (!empty($user["id_candidat"])) {
                    header("Location: ProfilCandidat.php");
                } else {
                    header("Location: InfoCandidat.php");
                }
                exit();
            } elseif ($user["user_type"] == "entreprise") {
                if (!empty($user["id_entreprise"])) {
                    header("Location: ListeOffreParEntrepE.php?id=" . $user["id_entreprise"]);

                } else {
                    header("Location: PageInitEntrep.php");
                }
                exit();
            }
        } else {
            $_SESSION['error'] = "Mot de passe incorrect";
            header("Location: Connexion.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Aucun utilisateur trouvé avec ce nom";
        header("Location: Connexion.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>