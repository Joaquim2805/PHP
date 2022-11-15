<?php 

require("admin_verification.php");

if(isset($_GET['id'])){
    $terrain_update_req = $bdd->prepare("UPDATE terrain SET nom_terrain = ?, lieu = ?, disponibilite = ? WHERE id = ?");
    $terrain_update_req->execute([$_POST['nom_terrain'], $_POST['place'], $_POST['disponibility'], $_GET['id']]);
    header("location: terrain.php");
}else{
    header("location: terrain.php");
}

?>