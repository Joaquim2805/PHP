<?php require("admin_verification.php"); ?>

<?php

if(isset($_GET['id'])){
    $req_reservation_delete = $bdd->prepare("DELETE FROM reservation WHERE id = ?");
    $req_reservation_delete->execute([$_GET['id']]);
    header("location: reservation.php");
}else{
    header("location: reservation.php");
}

?>