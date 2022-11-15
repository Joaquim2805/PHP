<?php

require("admin_verification.php");

?>

<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <title>Admin panel</title>
</head>
<body>
        <?php include("../public/navbar.php"); ?>
        <div class="row d-flex align-items-center h-75">
            <div class="col"></div>
            <div class="col row align-middle">
                <a class="form-group col-12 btn btn-outline-primary" href="terrain.php">Administrer les terrains</a>
                <a class="form-group col-12 btn btn-outline-primary" href="user.php">Administrer les utilisateurs</a>
                <a class="form-group col-12 btn btn-outline-primary" href="reservation.php">Administrer les réservations</a>
            </div>
            <div class="col"></div>
        </div>
</body>
</html>