<?php require("admin_verification.php"); ?>

<?php

if(isset($_GET['id'])){
    $req_terrain_delete = $bdd->prepare("DELETE FROM terrain WHERE id = ?");
    $req_terrain_delete->execute([$_GET['id']]);
    header("location: terrain.php");
}else{
    header("location: terrain.php");
}

?>