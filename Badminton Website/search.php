<?php
session_start();
require("app/bdd.php");
?>
<html lang="fr">
<head>
    <title>Search</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
    <?php
    include("public/navbar.php");

        if (empty($_GET["list"])){
            header("location:search.php?list=all");
        }
        if ( $_GET["list"] == "terrains" || $_GET["list"] == "all" ) {
            $terrains = $bdd->prepare("SELECT ID, nom_terrain, lieu FROM terrain WHERE disponibilite = 1");
            $terrains->execute();
            $donnees_terrain = $terrains->fetchAll();
            foreach ( $donnees_terrain as $terrain){
                ?><div>
                <table>
                    <tr>
                    <td> <a href= "reservation.php?id_terrain=<?php echo $terrain['ID']?>"> <?php echo $terrain["nom_terrain"]?> </a> </td>
                    </tr>
                </table><br>
                </form>
                </div>
            <?php }

        }
        if ( $_GET["list"] == "users" || $_GET["list"] == "all" ){
            if(isset($_GET['query'])){

                $users= $bdd->prepare("SELECT ID, nom, prenom FROM utilisateur WHERE concat(nom,prenom) LIKE '%".$_GET['query']."%'");

                $users->execute();

                $donnees = $users->fetchAll();

            }else{

                $users= $bdd->prepare("SELECT ID, nom, prenom FROM utilisateur");

                $users->execute();

                $donnees = $users->fetchAll();

            }
            foreach ($donnees as $user){
               ?>
                <div>
                <table>
                    <tr>
                        <td><?php print($user["ID"]);?></td>
                        <td><?php print($user["nom"]);?></td>
                        <td><?php print($user["prenom"]); ?> </td>
                    </tr>
                </table><br>
                </div>
            <?php }
        }
    ?>
</body>
</html>
