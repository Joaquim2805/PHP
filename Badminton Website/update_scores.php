<?php
session_start();
require("app/bdd.php");

$update_set1 = $bdd->prepare("UPDATE `set` SET score1=?, score2=? WHERE numero_set = 1 AND Id_match = ?");
$update_set1->execute([$_POST['set1_score1'], $_POST['set1_score2'], $_GET['match']]);

$update_set2 = $bdd->prepare("UPDATE `set` SET score1=?, score2=? WHERE numero_set = 2 AND Id_match = ?");
$update_set2->execute([$_POST['set2_score1'], $_POST['set2_score2'], $_GET['match']]);

$update_set3 = $bdd->prepare("UPDATE `set` SET score1=?, score2=? WHERE numero_set = 3 AND Id_match = ?");
$update_set3->execute([$_POST['set3_score1'], $_POST['set3_score2'], $_GET['match']]);

$req = $bdd->prepare("SELECT numero_set, score1, score2 FROM `set` WHERE Id_match = ?");
$req->execute([$_GET['match']]);
$scores = $req->fetchAll();

/*var_dump($scores);*/


?>

<html>
<head>

</head>
<body>
<h1>Liste des scores</h1>
<?php
        foreach ($scores as $score):
            echo $score["numero_set"]." ";
            echo $score["score1"]." ";
            echo $score["score2"]." ";?> <br>
        <?php endforeach; ?>

</body>
</html>