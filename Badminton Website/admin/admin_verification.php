<?php

session_start();
require("../app/bdd.php");
if(isset($_SESSION['id'])){
    $req_admin_test = $bdd->prepare("SELECT role FROM utilisateur WHERE id = ?");
    $req_admin_test->execute([$_SESSION['id']]);
    if($req_admin_test->fetch()['role'] != 2){
        header("location: ../user.php?id=".$_SESSION['id']);
    }
}else{
    header("location: ../login.php");
}
    
?>