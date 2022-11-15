<?php 
session_start();
require("app/bdd.php");

$req_reservation = $bdd->prepare("SELECT ID,id_terrain,date_debut,date_fin FROM reservation WHERE id_joueur = ?");
$req_reservation->execute([$_SESSION['id']]);
$tab_reservation = $req_reservation->fetchAll();
?>







<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <title>Vos reservations</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>

<body>
<?php include("public/navbar.php") ?>
<h1>Vos réservations :</h1>
Que voulez vous faire :<br>
<form method="get" action="delete.php">
Modifier votre réservation : <input type="radio" name="choice" value="1"><br>
Supprimer votre réservation : <input type="radio" name="choice" value="2">
<?php

foreach ($tab_reservation as $reservation) {?>
 <table>
    <tr>
                    
        <td><input type="radio" name="reservation" value="<?php echo $reservation['ID'] ?>"> <?php echo $reservation['date_debut'].' '.$reservation['date_fin'].' sur le terrain '.$reservation['id_terrain']?> </input></td>
<?php } ?>

    </tr></table>
<input type="submit" value="Valider">
</form>



        


</body>


</html>