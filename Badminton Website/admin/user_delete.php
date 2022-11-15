<?php require("admin_verification.php"); ?>

<?php

if(isset($_GET['id'])){
    $req_user_delete = $bdd->prepare("DELETE FROM utilisateur WHERE id = ?");
    $req_user_delete->execute([$_GET['id']]);
    header("location: user.php");
}else{
    header("location: user.php");
}

?>