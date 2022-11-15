<?php require("admin_verification.php"); ?>

<?php

if(isset($_GET['id'])){
    $terrain_edit_req = $bdd->prepare("SELECT nom_terrain, lieu, disponibilite FROM terrain WHERE id = ?");
    $terrain_edit_req->execute([$_GET['id']]);
    $terrain = $terrain_edit_req->fetch();
    if($terrain == NULL){
        header("location: terrain.php");
    }
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
                <form method="post" action="terrain_update.php?id=<?php print($_GET['id']) ?>" class="row">
                    <h4 class="form-group col-12 text-center">Éditer terrain</h4><br>
                    <input class="form-group form-control" type="text" id="nom_terrain" name="nom_terrain" placeholder="Nom" value="<?php print($terrain['nom_terrain']) ?>" required>
                    <div class="col-12 row form-group">
                        <label class="col" for="place">Lieu</label>
                        <div class="col form-check">
                            <input class="form-check-input" id="interieur" type="radio" value="0" name="place" <?php if($terrain['lieu'] == 0){print("checked");} ?>>
                            <label class="form-check-label" for="interieur">Intérieur</label>
                        </div>
                        <div class="col form-check">
                            <input class="form-check-input" id="exterieur" type="radio" value="1" name="place" <?php if($terrain['lieu'] == 1){print("checked");} ?>>
                            <label class="form-check-label" for="exterieur">Extérieur</label>
                        </div>
                    </div>
                    <div class="col-12 row form-group">
                        <label class="col" for="disponibility">Disponibilité</label>
                        <div class="col form-check">
                            <input class="form-check-input" id="indisponible" type="radio" value="0" name="disponibility" <?php if($terrain['disponibilite'] == 0){print("checked");} ?>>
                            <label class="form-check-label" for="indisponible">Indisponible</label>
                        </div>
                        <div class="col form-check">
                            <input class="form-check-input" id="disponible" type="radio" value="1" name="disponibility" <?php if($terrain['disponibilite'] == 1){print("checked");} ?>>
                            <label class="form-check-label" for="disponible">Disponible</label>
                        </div>
                    </div>
                    <input type="submit" class="form-group col-12 btn btn-primary" value="Éditer">
                </form>
            </div>
            <div class="col"></div>
        </div>
    </body>
</html>