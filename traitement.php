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

//var_dump($_GET);
if (isset($_GET['action'])) {
    switch($_GET['action']) {
        case "nompersonnage":
            $nompersonnage = $_GET['name'];//name
            $idpersonnage = $_GET['id'];//name
            echo $nompersonnage;
            $_SESSION['nompersonnage']=[$nompersonnage,$nompersonnage];
            $_SESSION['idpersonnage']=[$idpersonnage,$idpersonnage];
           
           // session_unset();
           // session_destroy();
           
    }
}
header("Location:index.php");exit;
?>

</body>
</html>