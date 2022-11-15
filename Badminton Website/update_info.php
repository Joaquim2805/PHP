<?php
session_start();
require("app/bdd.php");
if ($_SESSION['id'] == $_GET['id'])
{
    $update_adr = $bdd->prepare("UPDATE utilisateur SET adresse = ?, email=?  WHERE ID = ? ");
    $update_adr->execute([$_POST['adresse'], $_POST['email'],$_GET['id']]);
    header("location:user.php?id=".$_SESSION['id']);
}else{
    header("location:user.php?id=".$_SESSION['id']);
}

?>
