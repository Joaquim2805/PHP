<?php
session_start();
require("app/bdd.php");

$req_terrain = $bdd->prepare("SELECT id,disponibilite,nom_terrain,lieu  FROM terrain WHERE id = ? ");
$req_terrain->execute([$_GET['id_terrain']]);
$tab_terrain =  $req_terrain->fetch();
if($tab_terrain["disponibilite"]==1){
    $req_reservation = $bdd->prepare("SELECT date_debut,date_fin FROM reservation WHERE id_terrain = ?"); 
    $req_reservation->execute([$tab_terrain["id"]]);
    $tab_reservation = $req_reservation->fetchAll();

}
else{
    header("location:search.php?list=terrains");
}


$jourDebut=date('Y-m-d');


for ($i=0; $i <10 ; $i++) { 
    $jour=date('Y-m-d',strtotime('+ '.$i.' days'));
    for ($j=6;$j <22 ; $j++) { 
        if ($j<10) $heureDeb='0'.$j.':00:00'; else $heureDeb=$j.':00:00';
        if ($j+1<10) $heureFin='0'.($j+1).':00:00'; else $heureFin=($j+1).':00:00';
        $tabReserv[$jour][$heureDeb][$heureFin]=0;
    }
}




foreach($tab_reservation as $reservation){
    
    $date=substr($reservation["date_debut"],0,10);
    $heureDebut=substr($reservation["date_debut"],11,8);
    $heureFin=substr($reservation["date_fin"],11,8);
    $tabReserv[$date][$heureDebut][$heureFin]=1;
    
}



$req_joueur = $bdd->prepare("SELECT ID,nom,prenom  FROM utilisateur WHERE id <> ? ");
$req_joueur->execute([$_SESSION["id"]]);
$tab_joueur = $req_joueur->fetchAll();


?>




<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <title>Vos reservations</title>
</head>
<body>
<?php


$selectSimple='checked';
$selectDouble='';

if (isset($_GET['mode']) &&  $_GET['mode']=="update" ) {
    
    $renderString='<h2>Modifier votre réservation</h2><br>';
    $renderString.='<input type="hidden" name="mode" value="update" >';

    $req_update = $bdd->prepare("SELECT Id_joueur1,Id_joueur2,`type` FROM `match` WHERE Id_reservation = ?");
    $req_update->execute([$_GET['id_reservation']]);
    $tab_PrecReservation = $req_update->fetch();

    if ($tab_PrecReservation["type"]==2) {
        $selectSimple='';
        $selectDouble='checked';        
    } 

}
else $renderString='<h2>Faire une réservation</h2><br>';


$selectString='<select name="adversaire" >';
        foreach ($tab_joueur as $joueur) {
            if ( (isset($_GET['mode']) &&  $_GET['mode']=="update"  && $tab_PrecReservation["Id_joueur2"]==$joueur["ID"]) )
            $selectString.='<option selected value="'.$joueur["ID"].'">'.$joueur["prenom"].' '.$joueur["nom"].'</option>';
            else $selectString.='<option value="'.$joueur["ID"].'">'.$joueur["prenom"].' '.$joueur["nom"].'</option>';
        }


        $selectString.='</select>';


$renderString.='<form method="post" action="reservationConfirm.php?id_terrain='.$_GET['id_terrain'].'"><table><tr>';

if (isset($_GET['mode']) &&  $_GET['mode']=="update" ) {
    $renderString.='<input type="hidden" name="mode" value="update" >';
    $renderString.='<input type="hidden" name="id_reservation" value="'.$_GET['id_reservation'].'" >';
}
else $renderString.='<input type="hidden" name="mode" value="create" >';



$renderString.='Type de match : <br>
        Simple<input type="radio" '.$selectSimple.' name="match_type" value="1" required="required" ><br>
        Double<input type="radio" '.$selectDouble.' name="match_type" value="2" required="required" ><br>
        Avec qui voulez vous jouer : <br>
        '.$selectString.'
        <br><a href="invite.php?id_terrain='.$_GET['id_terrain'].'" target="_blank"> <input type="button" value="Enregistrer un invité"> </a><br><br>';


for ($i=0; $i <10 ; $i++) {
        $jour=date('Y-m-d',strtotime('+ '.$i.' days'));
        $renderString.='<td>'.$jour.'</td>';
}
            
$renderString.='</tr><tr>';

for ($i=0; $i <10 ; $i++) {
    $jour=date('Y-m-d',strtotime('+ '.$i.' days'));
    $renderString.='<td>';
    for ($j=6;$j<22 ; $j++) { 
        if ($j<10) $heureDeb='0'.$j.':00:00'; else $heureDeb=$j.':00:00';
        if ($j+1<10) $heureFin='0'.($j+1).':00:00'; else $heureFin=($j+1).':00:00'; 
        if($tabReserv[$jour][$heureDeb][$heureFin]==0) {
            $renderString.='<button style="background-color:#ccffcc;" type="submit" name="JOUR" value="'.$jour.' '.$heureDeb.'|'.$jour.' '.$heureFin.'">'.$heureDeb.'-'.$heureFin.'</button>';
            //$renderString.='<input type="submit" class="col btn btn-primary"  name = "'.$jour.' '.$heureDeb.'|'.$jour.' '.$heureFin.'" value="'.$heureDeb.'-'.$heureFin.'"><br/>';
        }
        else{   
            $renderString.='<button disabled style="background-color:#ff8888;">'.$heureDeb.'-'.$heureFin.'</button>';
        }
    }
    $renderString.='</td>';
}

$renderString.='</tr></table></form>';   

echo $renderString;

?>

</body>
</html>


