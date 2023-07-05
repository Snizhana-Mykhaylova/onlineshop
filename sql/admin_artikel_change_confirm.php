
<?php
    include "sql_functions.php";

    @$artikel_id = (int)$_POST["id"];
    @$neu_artikelName = $_POST["artikel-name"];
    @$neu_beschreibung = $_POST["beschreibung"];
    @$neu_artikelEinzelpreis = floatval($_POST["einzelpreis"]);
    @$neu_artikelBild = $_POST["bild"];
    @$neu_artikelLagerbestand = (int)$_POST["lagerbestand"];
    @$neu_kategorieNR = (int)$_POST["kategorie-nr"];

    if(isset($_POST["id"])){

        $sql_u = "UPDATE artikel 
                    SET Artikelname = '$neu_artikelName',
                        Beschreibung = '$neu_beschreibung',
                        Einzelpreis = $neu_artikelEinzelpreis,
                        Bild = '$neu_artikelBild',
                        Lagerbestand = $neu_artikelLagerbestand,
                        KategorieNR = $neu_kategorieNR
                    WHERE ArtikelID = $artikel_id;";
    
        databaseWrite($sql_u);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php header("location: ./admin_change.php")?>
    </body>
</html>