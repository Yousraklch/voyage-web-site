<?php
require_once "config/config.php";
$result;
if (isset($_GET['search'])) {
    $continent = $_GET['continent'];
    $pay = $_GET['pay'];
    $ville = $_GET['ville'];
    // $site = $_GET['site'];

    $stmt = $conn->prepare("SELECT ville.*, pays.nompay, continent.nomcon from ville
    JOIN pays ON ville.idpay = pays.idpay
    JOIN continent ON pays.idcon = continent.idcon
    WHERE(
        continent.nomcon LIKE '%$continent%' AND
        pays.nompay LIKE '%$pay%' AND
        ville.nomvil LIKE '%$ville%'
    )
   ");
    $stmt->execute();
    echo "<pre>";
    // echo "row count " . $stmt->rowCount() . "<br>";
    // while ($ob = $stmt->fetchObject()) {
    //     print_r($ob);
    // }
    echo "</pre>";

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
        <form action="" class="search" method="get">

            <div class="input-field">

                <label for="continent">continent</label>
                <select name="continent" required>
                    <option value="asia" <?=(isset($_GET['continent']) && $_GET['continent'] == "asia") ? "selected" : ""?> >
                        asia
                    </option>
                    <option value="africa" <?=(isset($_GET['continent']) && $_GET['continent'] == "africa") ? "selected" : ""?> >
                        africa
                    </option>
                    <option value="europe" <?=(isset($_GET['continent']) && $_GET['continent'] == "europe") ? "selected" : ""?> >
                        europe
                    </option>
                    <option value="north america" <?=(isset($_GET['continent']) && $_GET['continent'] == "north america") ? "selected" : ""?> >
                        north america
                    </option>
                    <option value="south america" <?=(isset($_GET['continent']) && $_GET['continent'] == "south america") ? "selected" : ""?> >
                        south america
                    </option>
                    <option value="australia"  <?=(isset($_GET['continent']) && $_GET['continent'] == "australia") ? "selected" : ""?>>
                        australia
                    </option>
                    <option value="antarctica"  <?=(isset($_GET['continent']) && $_GET['continent'] == "antarctica") ? "selected" : ""?>>
                        antarctica
                    </option>
                </select>

            </div>

            <div class="input-field">
                <label for="pays">pay</label>
                <input type="text" name="pay" id="pay" value="<?=(isset($_GET['pay']) ? $_GET['pay'] : '')?>" required >
            </div>

            <div class="input-field">
                <label for="ville">ville</label>
                <input type="text" name="ville" value="<?=(isset($_GET['ville']) ? $_GET['ville'] : '')?>" id="ville" required>
            </div>

            <!-- <div class="input-field">
                <label for="site">site</label>
                <input type="text" name="site" value="<?=(isset($_GET['site']) ? $_GET['site'] : '')?>" id="site" required>
            </div> -->

            <div class="input-field">
                <input type="submit" value="Search" name="search">
            </div>
        </form>
        <!-- search result -->

        <div class="search-result">
            <div class="content">
               <?php
if (!empty($result)) {

    if ($result->rowCount() != 0) {
        while ($ville = $result->fetchObject()) {
            echo "
                     <a href='page3.php?idvil=$ville->idvil' class='site'>

                        <div class='desc'>
                            <h4>$ville->nomvil</h4>
                            <p>$ville->descvil</p>
                            <label>$ville->nompay</label>
                            <label>$ville->nomcon</label>
                        </div>
                    </a>
                    ";
        }

    } else {
        echo "<p>Not found</p>";
    }

}
?>
            </div>
        </div>
    </main>
</body>

</html>
