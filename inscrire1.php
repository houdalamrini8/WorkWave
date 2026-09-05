<?php

include 'config.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $name = mysqli_real_escape_string($conn, isset($_POST['name']) ? $_POST['name'] : '');

    $email = mysqli_real_escape_string($conn, isset($_POST['email']) ? $_POST['email'] : '');
    

    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $cpassword = isset($_POST['cpassword']) ? $_POST['cpassword'] : '';

    $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : 'candidat';


    if (empty($name)) $errors[] = "Le nom est requis";
    

    if (empty($email)) $errors[] = "L'email est requis";

    if (empty($password)) $errors[] = "Le mot de passe est requis";
    

    if ($password !== $cpassword) $errors[] = "Les mots de passe ne correspondent pas";

    if (strlen($password) < 5) $errors[] = "Le mot de passe doit contenir au moins 5 caractères";

    if (empty($errors)) {
       
        $check_email = "SELECT email FROM utilisateur WHERE email = ?";
        $stmt = mysqli_prepare($conn, $check_email);
        

        mysqli_stmt_bind_param($stmt, "s", $email);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_store_result($stmt);
        

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $errors[] = "Cet email est déjà utilisé";
        }
        

        mysqli_stmt_close($stmt);
    }

    if (empty($errors)) {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        

        $insert = "INSERT INTO utilisateur (name, email, password, user_type) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insert);
        
       
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $hashed_password, $user_type);
        

        if (mysqli_stmt_execute($stmt)) {
            
            header('Location: Connexion.php?success=1');
            exit(); 
        } else {

            $errors[] = "Erreur lors de l'inscription: " . mysqli_error($conn);
        }
        
   
        mysqli_stmt_close($stmt);
    }
}

?>