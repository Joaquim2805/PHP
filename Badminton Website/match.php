<html lang="fr">
<head>
    <title>Matchs</title>
</head>
<body>
    <table>
    <th>
       <p>Joueur 1</p>
    </th>
    <th>
        <p>Joueur 2</p>
    </th>
    <th>
        <p>Type de match</p>
    </th>
    <?php
        session_start();
        require("app/bdd.php");
        $req_matchs = $bdd->prepare("SELECT * FROM `match`");
        $req_matchs->execute();
        $donnees_matchs = $req_matchs->fetchAll();
        foreach ( $donnees_matchs as $req_matchs){
    ?>
    <div>
        <tr>
            <td><?php
                $joueur1 = $bdd->prepare("SELECT nom, prenom FROM utilisateur WHERE ID =". $req_matchs['Id_joueur1']);
                $joueur1->execute();
                $donnees_joueur1 = $joueur1->fetch();
                print($donnees_joueur1["nom"] . ' ' . $donnees_joueur1["prenom"]);
                ?></td>
            <td><?php
                $joueur2 = $bdd->prepare("SELECT nom, prenom FROM utilisateur WHERE ID =". $req_matchs['Id_joueur2']);
                $joueur2->execute();
                $donnees_joueur2 = $joueur2->fetch();
                print($donnees_joueur2["nom"] . ' ' . $donnees_joueur2["prenom"]);
                ?></td>
            <td><?php
                if ($req_matchs['type'] == 1){
                    echo "double";
                }else{
                    echo "simple";
                }
                ?> </td>
            <td>
                <!--Si pas de session ouverte le lien ne peut pas se générer : manque ID de session-->
                <a href="set.php?id=<?php echo $_SESSION['id']?>&match=<?php echo $req_matchs['ID'] ?>">Details</a>
            </td>
        </tr>
    <?php } ?>
    </table><br>
</div>
</body>
</html>