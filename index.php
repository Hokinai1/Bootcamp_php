<?php
require_once("db.php");

// se connectter à son compte

// verifier la soumission du formulaire avec la methode post

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // on recupère les information saisie pour se connecter
    $email = $_POST["email"];
    $password = $_POST["password"];

    // on va dans la base de données pour verifier si les données saisi sont juste et disponible dans la base de données

    $sql = "SELECT * FROM Users WHERE email = :email";

    // on le prepare et on l'execute
    $stmt = $pdo->prepare($sql);

    // preparer l'execution

    $stmt->execute([
        "email"=> $email,
    ]);
    // afficher sous forme d'un tableau associatif

    $user = $stmt->fetch();

    // verifier si les identifiant son correct on le donne acces
    if($user && password_verify($password, $user["password"])){
        // on memorise les information de l'utilisateur
        $_SESSION['user_id'] = $user["id"];
        $_SESSION["user_nom"] = $user["nom"];

        // on le redirige vers la page d'accueil

        header("location: products.php");
        exit();

    } else{
        $erreur = "Email ou mot de passe incorrect !";
    }

}





?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Connexion</h3>
                        
                        <?php if (isset($erreur)): ?>
                            <div class="alert alert-danger"><?php echo $erreur; ?></div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            
                            <div class="mb-3">
                                <label>Mot de passe</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                        </form>
                        
                        <div class="text-center mt-3">
                            <a href="register.php">Créer un compte</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>