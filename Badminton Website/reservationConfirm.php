<?php
session_start();
require("app/bdd.php");

?>







<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>

<body>
    
<h1>Opération confirmée</h1>

<strong><a href="search.php" > Retour au terrain </a></strong><br>
<strong><a href="MesReservations.php" > Retour à mes réservations </a></strong>
<?php


$debut=explode('|',$_POST["JOUR"])[0]; 
$fin=explode('|',$_POST["JOUR"])[1];



if ($_POST['mode']=='create') {

    $req_reservation= $bdd->prepare("INSERT INTO reservation (id_joueur,id_terrain,date_debut,date_fin) VALUES(?,?,?,?)");
    $req_reservation->execute([$_SESSION['id'], $_GET['id_terrain'], $debut,$fin]);

    $req_idReserv = $bdd->prepare("SELECT ID FROM reservation WHERE date_debut = ? AND date_fin= ? AND id_terrain =? ");
    $req_idReserv->execute([$debut,$fin,$_GET['id_terrain']]);
    $id_Reserv = $req_idReserv->fetchColumn();

    $req_match= $bdd->prepare("INSERT INTO `match` (Id_reservation,Id_joueur1,Id_joueur2,type) VALUES(?,?,?,?)");
    $req_match->execute([$id_Reserv,$_SESSION['id'],$_POST['adversaire'],$_POST['match_type']]);

}

else if ($_POST['mode']=='update') {

$req_upddate=$bdd->prepare("UPDATE reservation SET date_debut = ?, date_fin = ? WHERE ID = ?");
$req_upddate->execute([$debut,$fin,$_POST["id_reservation"]]);

$req_upddatem=$bdd->prepare("UPDATE `match` SET Id_joueur2 = ?, type = ? WHERE Id_reservation = ?");
$req_upddatem->execute([$_POST["adversaire"],$_POST["match_type"],$_POST["id_reservation"]]);

}

?>




</body>


</html>