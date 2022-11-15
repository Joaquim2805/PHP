<?php 
    session_start();
    if(isset($_SESSION['id'])){
        header("location: user.php?id=".$_SESSION['id']);
    }
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <title>Accueil</title>
</head>
<body>
    <div class="row d-flex align-items-center h-100">
        <div class="col"></div>
        <div class="col row  align-self-center">
            <h1 class="col-12 text-center form-group">Badminton</h1>
            <a class="col-12 form-group btn btn-outline-primary btn-lg" href="login.php">Se connecter</a>
            <a class="col-12 form-group btn btn-outline-dark btn-lg" href="register.php">S'inscrire</a>
        </div>
        <div class="col"></div>
    </div>
</body>
</html>