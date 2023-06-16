<?php
require_once "config/config.php";
$result;

if (!isset($_GET['idvil'])) {
    header("location: index.php");
} else {
    $idvil = $_GET['idvil'];
    $stmt = $conn->prepare("SELECT site.*, ville.nomvil, pays.nompay, continent.nomcon from site
    JOIN ville ON site.idvil = ville.idvil
    JOIN pays ON pays.idpay = ville.idpay
    JOIN continent ON pays.idcon = continent.idcon
    WHERE ville.idvil = $idvil
   ");
    $stmt->execute();
    $result = $stmt;
    echo "<pre>";
    // echo "row count " . $stmt->rowCount() . "<br>";
    // while ($ob = $stmt->fetchObject()) {
    //     print_r($ob);
    // }
    echo "</pre>";

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="page3.css">
    <title>Informations de ville</title>
</head>

<body>
    <!-- <h1><u>Informations de ville</u></h1>
    <h2>Nom de la ville : Algerie</h2>
    <h2>Qualque photos :</h2>
    <img src="alg.jpg" alt="">
    <img src="alg2.jpg" alt="">
    <img src="alg4.jpg" alt="">
    <h2>Endroit à visiter :</h2>
    <h3>Alger , Oran , Bejaia , Mostaganem , Vieux kouba</h3> -->

    <div class="search-result">
            <div class="content">
               <?php
if ($result->rowCount() != 0) {
    while ($site = $result->fetchObject()) {
        echo "
            <div class='desc'>
                <h4>$site->nomsit</h4>
                <p>$site->nompay</p>
                <p>$site->cheminphoto</p>
                <p>$site->nomcon</p>
            </div>
      ";
    }
} else {
    echo "<p> Not Found </p>";
}
?>
            </div>
        </div>
</body>

</html>
