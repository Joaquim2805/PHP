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
                <h1 class="form-group col-12 text-center">Liste des réservation</h1>
                <div class=" form-group col-12 row"><span class="col">ID</span><span class="col">Email</span><span class="col">Terrain</span><span class="col">Date</span></div>
                <hr/>
                <?php
                
                $reservations_req = $bdd->prepare("SELECT reservation.id as id, email, terrain.nom_terrain as nom_terrain, date_debut FROM reservation INNER JOIN utilisateur ON id_joueur = utilisateur.id INNER JOIN terrain ON id_terrain = terrain.id");
                $reservations_req->execute();
                $reservations = $reservations_req->fetchAll();

                foreach ($reservations as $reservation) {
                ?>

                <div class="form-group col-12 row">
                    <span class="col"><?php print($reservation['id']); ?></span>
                    <span class="col"><?php print($reservation['email']); ?></span>
                    <span class="col"><?php print($reservation['nom_terrain']); ?></span>
                    <span class="col"><?php print($reservation['date_debut']); ?></span>
                </div>
                <div class="form-group col-12 row">
                    <a class="form-group col btn btn-outline-danger" href="reservation_delete.php?id=<?php print($reservation['id']) ?>">Supprimer la réservation</a>
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