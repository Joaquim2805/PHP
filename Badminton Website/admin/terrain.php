<?php require("admin_verification.php"); ?>

<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php include("../public/navbar.php") ?>
        <div class="row d-flex align-items-center h-100">
            <div class="col"></div>
            <div class="col">
                <h1 class="form-group col-12 text-center">Liste des terrains</h1>
                <a class="form-group btn btn-primary col-12" href="terrain_new.php">Créer un nouveau terrain</a>
                <div class=" form-group col-12 row"><span class="col">Nom</span><span class="col">Lieu</span><span class="col">Disponibilité</span></div>
                <hr/>
                <?php
                
                $terrains_req = $bdd->prepare("SELECT id, nom_terrain, lieu, disponibilite FROM terrain");
                $terrains_req->execute();
                $terrains = $terrains_req->fetchAll();

                foreach ($terrains as $terrain) {
                ?>

                <div class="form-group col-12 row">
                    <span class="col"><?php print($terrain['nom_terrain']) ?></span>
                    <span class="col"><?php if($terrain['lieu'] == 0){print("Intérieur");}else{print("Extérieur");} ?></span>
                    <span class="col"><?php if($terrain['disponibilite'] == 0){print("Indisponible");}else{print("Disponible");} ?></span>
                </div>
                <div class="form-group col-12 row">
                    <a class="form-group col btn btn-outline-primary" href="terrain_edit.php?id=<?php print($terrain['id']) ?>">Éditer le terrain</a>
                    <span class="col-1"></span>
                    <a class="form-group col btn btn-outline-danger" href="terrain_delete.php?id=<?php print($terrain['id']) ?>">Supprimer le terrain</a>
                </div>
                <hr/>

                <?php
                }
                
                ?>
            </div>
            <div class="col"></div>
        </div>
    </body>
</html>