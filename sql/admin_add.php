<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="navbar.css">
        <?php 
        include "admin_navbar.php";
        include "sql_functions.php";
        navbar();
        ?>
    </head>
    <body style="background-color: #DCDCDC;">
        <div class="formdiv">
            <form action="" method="post" autocomplete="off" >
                <br> 
                <p> Gib an was hinzugefügt werden soll </p>
                <p> <input type="text" name="artikel-name" id=""> Name</p>
                <p> <input type="text" name="artikel-beschreibung" id=""> Beschreibung</p>
                <p> <input type="text" name="artikel-einzelpreis" id=""> Einzelpreis</p>
                <p> <input type="text" name="artikel-bild" id=""> Bild-link</p>
                <p> <input type="text" name="artikel-lagerbestand" id=""> Lagerbestand</p>
                <select name="kategorie-nr" id="">
                    <?php

                        $sql_r = "SELECT * FROM artikelkategorien;";
                        databaseReadKategorie($sql_r);

                    ?>
                </select>

                <p> <input type="submit" value="Hinzufügen" class="submit-btn"> </p>

                <?php
                    @$artikel_name = $_POST["artikel-name"];
                    @$artikel_beschreibung = $_POST["artikel-beschreibung"];
                    @$artikel_einzelpreis = floatval($_POST["artikel-einzelpreis"]);
                    @$artikel_bild = $_POST["artikel-bild"];
                    @$artikel_lagerbestand = $_POST["artikel-lagerbestand"];
                    @$kategorie_nr = $_POST["kategorie-nr"];

                    $sql_a = "INSERT INTO artikel(Artikelname, Beschreibung, Einzelpreis, Bild, Lagerbestand, KategorieNR)
                              VALUES('$artikel_name', '$artikel_beschreibung', $artikel_einzelpreis, 
                                '$artikel_bild', $artikel_lagerbestand, $kategorie_nr);";

                    if($_SERVER["REQUEST_METHOD"] == "POST"){

                        databaseWrite($sql_a);
                    }
                    
                ?>
            </form>
        </div>
    </body>
</html>