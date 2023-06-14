<?php
require_once "config/config.php";
$result = [];
if (isset($_GET['search'])) {
    $continent = $_GET['continent'];
    $pay = $_GET['pay'];
    $ville = $_GET['ville'];
    $site = $_GET['site'];

    $stmt = $conn->prepare("SELECT site.* , ville.nomvil, pays.nompay, continent.nomcon from site
    JOIN ville ON site.idvil = ville.idvil
    JOIN pays ON ville.idpay = pays.idpay
    JOIN continent ON pays.idcon = continent.idcon
    WHERE(
        continent.nomcon LIKE '%$continent%' AND
        pays.nompay LIKE '%$pay%' AND
        ville.nomvil LIKE '%$ville%' AND
        site.nomsit LIKE '%$site%'
    )
   ");
    $stmt->execute();
    // echo "<pre>";
    // echo "row count " . $stmt->rowCount() . "<br>";
    // while ($ob = $stmt->fetchObject()) {
    //     print_r($ob);
    // }
    // echo "</pre>";

    $result = $stmt;

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="page1.css">
    <title>Move Guide</title>
</head>

<body>
    <header>
        <span class="etudiante">Etudiante</span>
        <ul>
            <li><span>Nom :</span> Koulache</li>
            <li><span>Prénom:</span> Yousra</li>
            <li><span>Spécialité:</span> LI</li>
            <li><span>Section:</span> 01</li>
            <li><span>Groupe:</span> 02</li>
            <li><span>Mail</span> : <a href="mailto:yousrakoulach@gmail.com">yousrakoulach@gmail.com</a></li>
        </ul>
        <hr>
        <div>
            <a href="./page2.html">Ajouter ville</a>
        </div>
    </header>
    <main>
        <div class="banner">
            <!-- <img src="voyage.jpg" alt="voyage" /> -->
            <h1>Move Guide</h1>
        </div>
        <form action="" class="search">

            <div class="input-field">

                <label for="continent">continent</label>
                <select name="continent" required>
                    <option value="afrique" <?=(isset($_GET['continent']) && $_GET['continent'] == "afrique") ? "selected" : ""?> >
                        afrique
                    </option>
                    <option value="afrique"  <?=(isset($_GET['continent']) && $_GET['continent'] == "australia") ? "selected" : ""?>>
                        australia
                    </option>
                </select>

            </div>

            <div class="input-field">
                <label for="pays">pay</label>
                <input type="text" name="pay" id="pay" value=<?=$_GET['pay']?> required>
            </div>

            <div class="input-field">
                <label for="ville">ville</label>
                <input type="text" name="ville" value=<?=$_GET['ville']?> id="ville" required>
            </div>

            <div class="input-field">
                <label for="site">site</label>
                <input type="text" name="site" value=<?=$_GET['site']?> id="site" required>
            </div>

            <div class="input-field">
                <input type="submit" value="Search" name="search">
            </div>
        </form>
        <!-- search result -->

        <div class="search-result">
            <div class="content">
               <?php
while ($site = $result->fetchObject()) {
    echo "
                     <a href='site-details/$site->idsit' class='site'>

                        <div class='desc'>
                            <h4>$site->nomsit</h4>
                            <label>$site->nomvil</label>
                            <label>$site->nomcon</label>
                        </div>
                    </a>
                    ";
}
?>
            </div>
        </div>
    </main>
</body>

</html>
