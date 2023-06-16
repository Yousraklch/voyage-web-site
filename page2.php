<?php
require_once "config/config.php";
$continents;
$pays;
$villes;

if (isset($_POST['add-pay'])) {
    $pay = $_POST['nompay'];
    $sql = "INSERT INTO pays (nompay) VALUES ('$pay')";
    $result = $conn->query($sql);
    header("location: page2.php");
}

if (isset($_POST['add-ville'])) {
    $continent = $_POST['continent'];
    $ville = $_POST['nomvil'];
    $sql = "INSERT INTO ville (nomvil, idcon) VALUES ('$ville', '$continent')";
    $result = $conn->query($sql);
    header("location: page2.php");
}

if (isset($_POST['add-site'])) {
    $ville = $_POST['ville'];
    $description = $_POST['description'];
    $site = $_POST['site'];
    $necs = $_POST['necs'];

    $sql = "INSERT INTO site (nomsit, idvil) VALUES ('$site', $ville)";
    $result = $conn->query($sql);
    print_r($result);
    $pairs = explode("|", $necs);
    foreach ($pairs as $pair) {

        $values = explode(",", $pair);
        $typeNec = $values[0];
        $nomNec = $values[1];

        $stmt = $conn->prepare("INSERT INTO necessaire (typenec, nomnec, idvil) VALUES (?, ?, ?)");
        $stmt->execute([$typeNec, $nomNec, $ville]);
    }

}

$continents = $conn->query("SELECT * FROM continent");
$pays = $conn->query("SELECT * FROM pays");
$pays2 = $conn->query("SELECT * FROM pays");
$villes = $conn->query("SELECT * FROM ville");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="page2.css">
    <title>Formulaire</title>

</head>

<body>
    <div class="popup ville">
        <div class="popup-content">
            <span class="btn-close">+</span>
            <h3>Add Ville</h3>
            <form action="" method="post">
<div class="input-field">
                <label>pay</label>
                <select name="pay" id="pay" required>
                    <option value="" selected disabled hidden>-- select --</option>
                    <?php
if (isset($pays)) {
    while ($pay = $pays->fetchObject()) {
        echo "
                                    <option value='$pay->idpay'>
                                        $pay->nompay
                                    </option>
                                ";
    }
}
?>
                </select>
            </div>
                <div class="input-field">
                    <label>Ville</label>
                    <input type="text" name="nomvil" required>
                </div>
                <div class="input-field">
                    <label>Description</label>
                    <textarea type="text" name="nomvil" required>

                    </textarea>
                </div>
                <div class="input-field">
                    <input type="submit" name="add-ville" value="add">
                </div>
            </form>
        </div>
    </div>

    <div class="popup pay">
        <div class="popup-content">
            <span class="btn-close">+</span>
            <h3>Add Pay</h3>
            <form action="" method="post">
                <div class="input-field">
                <label>continent</label>
                <select name="continent" id="continent" required>
                    <option value="" selected disabled hidden>-- select --</option>
                    <?php
if (isset($continents)) {
    while ($continent = $continents->fetchObject()) {
        echo "
                                    <option value='$continent->idcon'>
                                        $continent->nomcon
                                    </option>
                                ";
    }
}
?>
                </select>
            </div>
                <div class="input-field">
                    <label>pay</label>
                    <input type="text" name="nompay" required>
                </div>

                <div class="input-field">
                    <input type="submit" name="add-pay" value="add">
                </div>
            </form>
        </div>
    </div>
    <section> <h1>Formulaire</h1>
        <form class="add-site" method="post">


            <div class="input-field">
                <label>pay</label>
                <span class="btn-add pay">+</span>
                <select name="pay" id="pay" required>
                    <option value="" selected disabled hidden>-- select --</option>
                    <?php
if (isset($pays2)) {
    while ($pay = $pays2->fetchObject()) {
        echo "
                                    <option value='$pay->idpay'>
                                        $pay->nompay
                                    </option>
                                ";
    }
}
?>
                </select>
            </div>
            <div class="input-field">
                <label>ville</label>
                <span class="btn-add ville">+</span>
                <select name="ville" id="ville" required>
                    <option value="" selected disabled hidden>-- select --</option>
                    <?php
if (isset($villes)) {
    while ($ville = $villes->fetchObject()) {
        echo "
                                    <option value='$ville->idvil'>
                                        $ville->nomvil
                                    </option>
                                ";
    }
}
?>
                </select>
            </div>
            <div class="input-field">
                <label>site</label>
                <input type="text" name="site" required>
            </div>
            <div class="input-field">
                <label>site description</label>
                <textarea name="description" required></textarea>
            </div>
            <hr>
            <input type="text" name="necs" id="necval" hidden>
            <div class="input-field btn">
                <button type="button" onclick="addNec();">add necessaire</button>
            </div>
            <div class="input-field typenec">
                <label>type necessaire</label>
                <select required onchange="getVal()" required>
                    <option value="" selected disabled hidden>-- select --</option>
                    <option value="hotel">hotel</option>
                    <option value="gare">gare</option>
                    <option value="aeroport">aeroport</option>
                    <option value="restaurant">restaurant</option>
                </select>
            </div>
             <div class="input-field nomnec">
                <label>nom necessaire</label>
                <input type="text" required  onkeyup="getVal()">
            </div>
            <div class="input-field">
                <input type="submit" name="add-site" value="ajouter">
            </div>
        </form>
    </section>

    <!-- <script src="page2.js"></script> -->
    <script>
        const btnAddVille = document.querySelector(".btn-add.ville");
        const btnAddPay = document.querySelector(".btn-add.pay");
        const btnsClose = document.querySelectorAll(".btn-close");

        btnAddVille.addEventListener("click", ()=>{
            document.querySelector(".popup.ville").classList.add("show");
        })

        btnAddPay.addEventListener("click", ()=>{
            document.querySelector(".popup.pay").classList.add("show");
        })

        btnsClose.forEach(btn => {
            btn.addEventListener("click", () => {
                btn.parentNode.parentNode.classList.remove("show");
            })
        })

        const getVal = () => {
            const sel = document.querySelectorAll("form.add-site .input-field.typenec select");
            const inp = document.querySelectorAll("form.add-site .input-field.nomnec input");
            let res = "";
            sel.forEach((s, i)=>{
                if(s.value !== "" && inp[i].value !== "")
                res += `${i != 0 ? "|" : ""}${s.value},${inp[i].value}`;
            })

            console.log(res);
            document.getElementById("necval").value = res;
        }

        const addNec = () => {
            let form = document.querySelector("form.add-site");
            form.children[form.children.length - 1].remove();
            form.innerHTML += `
                <div class="input-field typenec">
                <label>type necessaire</label>
                <select required onchange="getVal()" required>
                    <option value="" selected disabled hidden>-- select --</option>
                    <option value="hotel">hotel</option>
                    <option value="gare">gare</option>
                    <option value="aeroport">aeroport</option>
                    <option value="restaurant">restaurant</option>
                </select>
                </div>
                <div class="input-field nomnec">
                    <label>nom necessaire</label>
                    <input type="text"  required  onkeyup="getVal()">
                </div>
                 <div class="input-field">
                <input type="submit" name="ajouter-site" value="ajouter">
                </div>
            `;

            getVal();
        }

    </script>
</body>

</html>
