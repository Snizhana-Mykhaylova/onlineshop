<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            include "admin_navbar.php";
            navbar(); 
        ?>
    </head>
    <body style="background-color: #DCDCDC;">

        <?php 
            $ergebnis = NULL;

            @$artikel_bearbeitungs_id = $_POST["artikel-id"];
            @$artikel_kategorie_nr = $_POST["kategorie-nr"];

            $sql_r = "SELECT * FROM artikel WHERE ArtikelID = $artikel_bearbeitungs_id;";

            $sql_r_name = "SELECT *
                           FROM artikelkategorien
                           INNER JOIN artikel ON artikelkategorien.KategorieID = $artikel_kategorie_nr;";

            try{
                $dbh_r = new PDO(
                    "mysql:dbname=onlineshop; host=localhost",
                    "root",
                    ""
                );
                $rueckgabe = $dbh_r->query($sql_r);

                $rueckgabe_name = $dbh_r->query($sql_r_name);
                

                $ergebnis = $rueckgabe->fetchAll(PDO::FETCH_ASSOC);

                $ergebnis_name = $rueckgabe_name->fetchAll(PDO::FETCH_ASSOC);

                $dbh_r = NULL;
            }
            catch(PDOException $r){
                echo $r->getMessage();
            }
        ?>


        <form action="admin_artikel_change_confirm.php" method="post" autocomplete="off" >
            <br>
            <p>Ändere die unten angegebenen Werte:</p>
            
            <p> <input name="id" type="hidden"value='<?php echo $ergebnis[0]['ArtikelID']?>'> </p>

            <p> <input name="artikel-name" type="text" size="50px" value="<?php echo $ergebnis[0]['Artikelname']?>"> Artikelname </p>
            <p> <input name="beschreibung" type="text" size="50px" value="<?php echo $ergebnis[0]['Beschreibung']?>"> Beschreibung </p>
            <p> <input name="einzelpreis" type="text" size="50px" value="<?php echo $ergebnis[0]['Einzelpreis']?>"> Einzelpreis </p>
            <p> <input name="bild" type="text" size="50px" value="<?php echo $ergebnis[0]['Bild']?>"> Bild </p>
            <p> <input name="lagerbestand" type="text" size="50px" value="<?php echo $ergebnis[0]['Lagerbestand']?>"> Lagerbestand </p>
            

            <p> Aktuelle Kategorie Nummer: <?php echo $ergebnis[0]['KategorieNR'] . " " . $ergebnis_name[0]['Kategoriename']; ?>
            <br> Wähle eine neue Kategorie Nummer vom Dropdown Menü aus.</p>
            
            <select name="kategorie-nr">

            <?php
                $sql_r2 = "SELECT * FROM artikelkategorien;";

                try{
                    $dbh_r2 = new PDO(
                        "mysql:dbname=onlineshop; host=localhost",
                        "root",
                        ""
                    );
                    $rueckgabe2 = $dbh_r2->query($sql_r2);

                    $ergebnis2 = $rueckgabe2->fetchAll(PDO::FETCH_ASSOC);

                    foreach($ergebnis2 as $inhalt){
                        $kategorieId = $inhalt["KategorieID"];
                        $kategorieName = $inhalt['Kategoriename'];
                        echo "<option value='$kategorieId'> $kategorieName</option>";
                    }
                    
                    $dbh_r2 = NULL; 
                }
                catch(PDOException $r2){
                    echo $r2->getMessage();
                }
                ?>

            </select>
        
            <p> <input style="margin-top: 10px;" type="submit" value="Update"> </p>
        
        </form>
    </body>
</html>