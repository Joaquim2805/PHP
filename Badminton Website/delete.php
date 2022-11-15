<?php
session_start();
require("app/bdd.php");

if($_GET['choice']==2){
    $req_supp = $bdd->prepare("DELETE FROM reservation WHERE ID = ?");
    $req_supp->execute([$_GET['reservation']]);

    $req_supp2 = $bdd->prepare("DELETE FROM `match` WHERE Id_reservation = ?");
    $req_supp2->execute([$_GET['reservation']]);

}
else{
    $req_update = $bdd->prepare("select id_terrain FROM reservation WHERE ID = ?");
    $req_update->execute([$_GET['reservation']]);
    $id_terrain=$req_update->fetchColumn();

    $lien = 'reservation.php?mode=update&id_reservation='.$_GET['reservation'].'&id_terrain='.$id_terrain;
    header("location:$lien");
}
?>







<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>

<body>
<h1>Suppression confirmée </h1>

<strong><a href="search.php" > Retour au terrain </a></strong><br>
<strong><a href="MesReservations.php" > Retour à mes réservations </a></strong>

</body>


</html>