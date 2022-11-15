<?php 
session_start();
require("app/bdd.php");
if(isset($_POST['gender']) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["date_naissance"]) && isset($_POST["adresse"]) && isset($_POST["email"])){
    $req = $bdd->prepare("INSERT INTO utilisateur (civilite,nom,prenom,date_naissance,adresse,email,mot_de_passe,role) VALUES (?,?,?,?,?,?,?,?)");
    $req->execute([$_POST["gender"],$_POST["nom"],$_POST["prenom"],$_POST["date_naissance"],$_POST["adresse"],$_POST["email"],bin2hex(random_bytes(8)),1]);
    $lien = 'id_terrain='.$_GET['id_terrain'];
    header("location: reservation.php?$lien");}
?>










<html>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    </head>

    <body>
    <div class="row d-flex align-items-center h-100">
            <div class="col"></div>
            <form class="col" method="post" action="#">
            <h4 class="form-group col-12 text-center">Enregistrer un invité</h4><br>
                <div class="row form-group">
                    <label class="col" for="gender">Civilité</label>
                    <div class="col form-check">
                        <input class="form-check-input" id="monsieur" type="radio" value="0" name="gender">
                        <label class="form-check-label" for="monsieur">Monsieur</label>
                    </div>
                    <div class="col form-check">
                        <input class="form-check-input" id="madame" type="radio" value="1" name="gender">
                        <label class="form-check-label" for="madame">Madame</label>
                    </div>
                </div>
                <div class="row form-group">
                    <input class="form-control col" type="text" id="nom" name="nom" required="required" placeholder="Nom">
                    <span class="col-1"></span>
                    <input class="form-control col" type="text" id="prenom" name="prenom" required="required" placeholder="Prénom">
                </div>
                <div class="row form-group">
                    <label class="col-12" for="date_naissance">Date de naissance</label>
                    <input type="date" id="date_naissance" name="date_naissance" class="col-12 form-control" required="required">
                </div>
                <div class="row form-group">
                    <label class="col-12" for="adresse">Adresse</label>
                    <input type="text" id="adresse" name="adresse" class="col-12 form-control" placeholder="Exemple : 1 rue du Chêne" required="required">
                </div>
                <div class="row form-group">
                    <label class="col-12" for="email">Email</label>
                    <input type="email" id="email" name="email" class="col-12 form-control" required="required">
                </div>
            
                <div class="row form-group">
                    <input class="col btn btn-danger" type="reset">
                    <span class="col-1"></span>
                    <input class="col btn btn-primary" type="submit">
                </div>
            </form>
            <div class="col"></div>
        </div>




    </body>


</html>