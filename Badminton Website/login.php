<?php
session_start();
if(isset($_SESSION['id'])){
    header("location: user.php".$_SESSION['id']);
}
require("app/bdd.php");
if(isset($_POST['email']) && isset($_POST['password'])){
    $req = $bdd->prepare("SELECT ID FROM utilisateur WHERE email = ? AND mot_de_passe = ?");
    $req->execute([$_POST['email'],md5($_POST['password'])]);
    $_SESSION['id'] = $req->fetch()['ID'];
    print(md5($_POST['password']));
    print($_POST['password']);
    echo $_SESSION['id'];
    header("location: user.php?id=".$_SESSION['id']);
}

?>

<html lang="fr">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <title>Connexion</title>
</head>
<body>
    <div class="row d-flex align-items-center h-100">
        <div class="col"></div>
        <div class="col align-self-center">
            <form method="post" action="#" class="row">
                <h4 class="form-group col-12 text-center">Connexion</h4><br>
                <input class="form-group form-control" type="text" id="email" name="email" placeholder="Email" required>
                <input class="form-group form-control" type="password" id="password" name="password" placeholder="Mot de passe" required>
                <input type="submit" class="form-group col-12 btn btn-primary" value="Se connecter">
                <a class="col-12 btn btn-link" href="register.php">S'inscrire</a>
            </form>
        </div>
        <div class="col"></div>
    </div>
</body>
</html>
