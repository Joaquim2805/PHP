<?php require("admin_verification.php") ?>

<?php

    if(isset($_POST['nom_terrain']) && isset($_POST['place']) && isset($_POST['disponibility'])){
        $req_new_terrain = $bdd->prepare("INSERT INTO terrain (nom_terrain, lieu, disponibilite) VALUES (?, ?, ?)");
        $req_new_terrain->execute([$_POST['nom_terrain'], $_POST['place'], $_POST['disponibility']]);
        header("location: terrain.php");
    }

?>

<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    </head>
    <body>
        <div class="row d-flex align-items-center h-100">
            <div class="col"></div>
            <div class="col">
                <form method="post" action="#" class="row">
                    <h4 class="form-group col-12 text-center">Nouveau terrain</h4><br>
                    <input class="form-group form-control" type="text" id="nom_terrain" name="nom_terrain" placeholder="Nom" required>
                    <div class="col-12 row form-group">
                        <label class="col" for="place">Lieu</label>
                        <div class="col form-check">
                            <input class="form-check-input" id="interieur" type="radio" value="0" name="place">
                            <label class="form-check-label" for="interieur">Intérieur</label>
                        </div>
                        <div class="col form-check">
                            <input class="form-check-input" id="exterieur" type="radio" value="1" name="place">
                            <label class="form-check-label" for="exterieur">Extérieur</label>
                        </div>
                    </div>
                    <div class="col-12 row form-group">
                        <label class="col" for="disponibility">Disponibilité</label>
                        <div class="col form-check">
                            <input class="form-check-input" id="indisponible" type="radio" value="0" name="disponibility">
                            <label class="form-check-label" for="indisponible">Indisponible</label>
                        </div>
                        <div class="col form-check">
                            <input class="form-check-input" id="disponible" type="radio" value="1" name="disponibility">
                            <label class="form-check-label" for="disponible">Disponible</label>
                        </div>
                    </div>
                    <input type="submit" class="form-group col-12 btn btn-primary" value="Créer">
                </form>
            </div>
            <div class="col"></div>
        </div>
    </body>
</html>