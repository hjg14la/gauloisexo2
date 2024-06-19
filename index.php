<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
</head>
<body>
    
<?php

//unset($_SESSION);
try//nomrecette tempspreparation categorie
{
	$mysqlClient = new PDO('mysql:host=localhost;dbname=gaulois;charset=utf8', 'root', '',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
//$id_lieu = 4;
$sqlQuery = 'SELECT * FROM personnage';//where lieu.id_lieu=:id_lieu';
$gauloisStatement = $mysqlClient->prepare($sqlQuery);
$gauloisStatement->execute();
$gauloisl = $gauloisStatement->fetchAll();

?>

<?php echo "<div><table><tbody>";
?>
<?php foreach ($gauloisl as $gauloisc) { 
    echo "<li><a href=traitement.php?action=nompersonnage&id=".$gauloisc['id_personnage']."
    &name=".$gauloisc['nom_personnage'].
    ">".$gauloisc['nom_personnage']."</a></li>";

} 
?>    

<?php echo "</tbody></table></div>";

//$_GLOBALS=null;

//echo var_dump($_SESSION);
$id_personnage=$_SESSION['idpersonnage'];
$nom_du_personnage="";

foreach ($gauloisl as $gauloisc) {
 if ($gauloisc['id_personnage']==$id_personnage[0]) {
    $nom_du_personnage=$gauloisc['nom_personnage'];
 }
}
$perso=$nom_du_personnage;//$_SESSION['nomvillage'];
echo "PERSONNAGE: ".$perso." ";
?>
<?php
$id_personnage=$_SESSION['idpersonnage'];

$sqlQuery = 'SELECT *
FROM personnage
WHERE personnage.id_personnage=:id_personnage';
$personnagesStatement = $mysqlClient->prepare($sqlQuery);
$personnagesStatement->execute(["id_personnage" => $id_personnage[0]]);
$personnagesl = $personnagesStatement->fetchAll();

?>
<div>
    <p>welcome<?php echo "";?></p>
</div>
<div>

<?php 
    $idspecialitedupersonnage=0;
    //$personnnagesl ne contient que un personnage 
    foreach ($personnagesl as $personnagesc) { 

    
    echo "<p> ".$personnagesc['nom_personnage']." ".
    $personnagesc['adresse_personnage']." ".
    $personnagesc['image_personnage']."</p>";
    $specialitedupersonnage=$personnagesc['id_specialite'];
    break;

    }
    
    $sqlQuery = 'SELECT specialite.nom_specialite
    FROM specialite
    WHERE specialite.id_specialite=:id_specialite';
    $speStatement = $mysqlClient->prepare($sqlQuery);
    $speStatement->execute(["id_specialite" => $specialitedupersonnage]);
    $spel = $speStatement->fetchAll();
    echo $spel[0]['nom_specialite'];

    $sqlQuery = "SELECT distinct bataille.nom_bataille
    FROM personnage,bataille,prendre_casque
    WHERE prendre_casque.id_personnage=:id_personnage
    AND bataille.id_bataille=prendre_casque.id_bataille";

    $batailleStatement = $mysqlClient->prepare($sqlQuery);
    $batailleStatement->execute(["id_personnage" => $id_personnage[0]]);
    $bataillel = $batailleStatement->fetchAll();
    echo var_dump($bataille);
    foreach ($bataillel as $bataillec) { 
        echo "<p> ".$bataillec['nom_bataille']."<p>";
    }

?>
</div>


    </body>
    </html>