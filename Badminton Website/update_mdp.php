<?php
    session_start();
    require("app/bdd.php");
    $req=$bdd->prepare("SELECT mot_de_passe FROM utilisateur WHERE ID = ? ");
    $req->execute([$_GET['id']]);
    $donnees = $req->fetch();
    if (md5($_POST['old_password']) == $donnees['mot_de_passe'])
    {
        $update = $bdd->prepare("UPDATE utilisateur SET mot_de_passe = ? WHERE ID = ? ");
        $update->execute([md5($_POST['new_password']),$_GET['id']]);
        header("location:user.php?id=".$_GET['id']);
    }else
    {
        echo "Mauvais mot de passe";
        ?>
        <br>
        <a href="user.php?id=<?php echo $_GET['id']; ?>">Retour</a>
<?php
    }
?>
