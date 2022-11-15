<!--Page proposant pour le match choisi de rentrer les scores -->

<html lang="fr">
<head>
    <title>Scores par set</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <?php
    session_start();
    require("app/bdd.php");

    /*requête réccupérant tous les informations de la bdd tel que l'id du match de la table match soit relié à l'id du match dans la table set*/
    $req = $bdd->prepare("SELECT `ID`, `Id_reservation`, `Id_joueur1`, `Id_joueur2`, `type` FROM `match` WHERE `ID`= ?;");
    $req->execute([$_GET['match']]);
    $donnees_set = $req->fetch();

    /*requête réccupérant le nom prénom du joueur 1*/
    $req_joueur1= $bdd->prepare("SELECT prenom, nom FROM utilisateur WHERE ID = ?;");
    $req_joueur1->execute([$donnees_set["Id_joueur1"]]);
    $donnees_joueur1= $req_joueur1->fetch();

    /*requête réccupérant le nom prénom du joueur 2*/
    $req_joueur2= $bdd->prepare("SELECT prenom, nom FROM utilisateur WHERE ID = ?");
    $req_joueur2->execute([$donnees_set["Id_joueur2"]]);
    $donnees_joueur2= $req_joueur2->fetch();

    $req_exist=$bdd->prepare("SELECT numero_set FROM `set` WHERE Id_match = ?");
    $req_exist->execute([$_GET['match']]);
    $exist = $req_exist->fetch();

    /*requête réccupérant les données des trois sets, si les sets sont inexistants, ils sont créés*/
    if ($exist){
        $req_set1= $bdd->prepare("SELECT score1, score2 FROM `set` WHERE Id_match = ? AND numero_set = 1");
        $req_set1->execute([$_GET["match"]]);
        $donnees_set1= $req_set1->fetch();
        $req_set2= $bdd->prepare("SELECT score1, score2 FROM `set` WHERE Id_match = ? AND numero_set = 2");
        $req_set2->execute([$_GET["match"]]);
        $donnees_set2= $req_set2->fetch();
        $req_set3= $bdd->prepare("SELECT score1, score2 FROM `set` WHERE Id_match = ? AND numero_set = 3");
        $req_set3->execute([$_GET["match"]]);
        $donnees_set3= $req_set3->fetch();
    }else{
        $create_set1= $bdd->prepare("INSERT INTO `set` (Id_match, numero_set, score1, score2) VALUES (?, 1, 0, 0)");
        $create_set1->execute([$_GET["match"]]);
        $create_set2= $bdd->prepare("INSERT INTO `set` (Id_match, numero_set, score1, score2) VALUES (?, 2, 0, 0)");
        $create_set2->execute([$_GET["match"]]);
        $create_set3= $bdd->prepare("INSERT INTO `set` (Id_match, numero_set, score1, score2) VALUES (?, 3, 0, 0)");
        $create_set3->execute([$_GET["match"]]);
        $req_set1= $bdd->prepare("SELECT score1, score2 FROM `set` WHERE Id_match = ? AND numero_set = 1");
        $req_set1->execute([$_GET["match"]]);
        $donnees_set1= $req_set1->fetch();
        $req_set2= $bdd->prepare("SELECT score1, score2 FROM `set` WHERE Id_match = ? AND numero_set = 2");
        $req_set2->execute([$_GET["match"]]);
        $donnees_set2= $req_set2->fetch();
        $req_set3= $bdd->prepare("SELECT score1, score2 FROM `set` WHERE Id_match = ? AND numero_set = 3");
        $req_set3->execute([$_GET["match"]]);
        $donnees_set3= $req_set3->fetch();


        /*besoin de fetch les nouvelles données dans la table sinon ne fonctionne pas */
    }


    ?>

</head>
<body>
    <!--Afficher les participants-->
    <?php
    include("public/navbar.php");
    ?>
    <div>
        <table>
            <tr>
                <td>
                <?php
                /*affiche le nom et prenom des participants*/
                echo " Les joueurs de ce match sont : ";?><br><?php
                echo $donnees_joueur1["prenom"]." ". $donnees_joueur1["nom"];?><br><?php
                echo $donnees_joueur2["prenom"]." ". $donnees_joueur2["nom"];?>
                </td>
            </tr>

        </table>
    </div>
    <!--Le formulaire suivant permet de rentrer les scores lors des trois sets du match -->
    <div>
        <form action="update_scores.php?match=<?php echo $_GET["match"]; ?>" method="post">
            <label for="set_1">Set 1 : </label>
            <!--affiche le score du joueur 1 et 2 pour chaque set -->
            <div>
                <label for="set1_score1">Score de <?php echo $donnees_joueur1["prenom"]." ". $donnees_joueur1["nom"]; ?>: </label>
                <input type="text" id="set1_score1" name="set1_score1" value="<?php echo $donnees_set1["score1"]; ?>"><br>
                <label for="set1_score2">Score de <?php echo $donnees_joueur2["prenom"]." ". $donnees_joueur2["nom"]; ?>: </label>
                <input type="text" id="set1_score2" name="set1_score2" value="<?php echo $donnees_set1["score2"]; ?>">
            </div>
            <label for="set_2">Set 2 : </label>
            <div>
                <label for="set2_score1">Score de <?php echo $donnees_joueur1["prenom"]." ". $donnees_joueur1["nom"]; ?>: </label>
                <input type="text" id="set2_score1" name="set2_score1" value="<?php echo $donnees_set2["score1"]; ?>"><br>
                <label for="set2_core2">Score de <?php echo $donnees_joueur2["prenom"]." ". $donnees_joueur2["nom"]; ?>: </label>
                <input type="text" id="set2_score2" name="set2_score2" value="<?php echo $donnees_set2["score2"]; ?>">
            </div>
            <label for="set_3">Set 3 : </label>
            <div>
                <label for="set3_score1">Score de <?php echo $donnees_joueur1["prenom"]." ". $donnees_joueur1["nom"]; ?>: </label>
                <input type="text" id="set3_score1" name="set3_score1" value="<?php echo $donnees_set3["score1"]; ?>"><br>
                <label for="set3_score2">Score de <?php echo $donnees_joueur2["prenom"]." ". $donnees_joueur2["nom"]; ?>: </label>
                <input type="text" id="set3_score2" name="set3_score2" value="<?php echo $donnees_set3["score2"]; ?>">
            </div>
            <div>
                <input type="submit" value="Soumettre les scores">
            </div>
        </form>
    </div>
</body>
</html>