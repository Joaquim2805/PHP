<?php 
    session_start();
    if (empty($_GET["id"])){
       header("location:search.php?list=users");
    }
    require("app/bdd.php");
    $req = $bdd->prepare("SELECT nom, prenom, adresse, email, mot_de_passe FROM utilisateur WHERE ID = ?");
    $req->execute([$_GET['id']]);
    $donnees = $req->fetch();
?>



<html lang="fr">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <title>
        <?php
        print($donnees['nom']." ".$donnees['prenom']);
        ?>
    </title>
</head>
<body>
    <?php include("public/navbar.php") ?>
    <form action="update_info.php?id=<?php echo $_SESSION['id'];?>" method="post">
        <label for="adresse">Adresse</label>
        <input type="text" id="adresse" name="adresse" class="col-12 form-control" value="<?php print($donnees['adresse']) ?>" required="required" >
        <label for="email">Email</label>
        <input type="text" id="email" name="email" class="col-12 form" value="<?php print($donnees['email']) ?>" required="required" >
        <?php
            if($_SESSION['id'] == $_GET['id'])
            {?>
        <input type="submit" value="Valider les modifications"><br>
            <?php
            } ?>

    </form>
    <?php
    if($_SESSION['id'] == $_GET['id'])
    {?>
    <form action="update_mdp.php?id=<?php echo $_SESSION['id'];?>" method="post">
        <label for="old_password">Ancien Mot de passe : </label>
        <input type="password" id="old_password" name="old_password"><br>
        <label for="new_password">Nouveau Mot de passe : </label>
        <input type="password" id="new_password" name="new_password"><br>
        <input type="submit" value="Changer mon mot de passe"><br>
    </form><?php
    } ?>

</body>
</html>
