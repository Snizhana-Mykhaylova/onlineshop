<?php
    function databaseReadKategorie($sql){
        try{
            $dbh = new PDO(
                "mysql:dbname=onlineshop; host=localhost",
                "root",
                ""
            );
            $rueckgabe = $dbh->query($sql);
        
            $ergebnis = $rueckgabe->fetchAll(PDO::FETCH_ASSOC);
        
            foreach($ergebnis as $inhalt){
                $kategorieId = $inhalt["KategorieID"];
                $kategoriename = $inhalt['Kategoriename'];
                echo "<option value='$kategorieId'> $kategoriename</option>";
            }
            $dbh = NULL;
        }
        catch(PDOException $r){
            echo $r->getMessage();
        }
    }


    function databaseWrite($sql){
        try{
            $dbh = new PDO(
                "mysql:dbname=onlineshop; host=localhost",
                "root",
                ""
            );

            $dbh->query($sql);
            $dbh = NULL;
        }
        catch(PDOException $a){
            echo $a->getMessage();
        }
    }


    function databaseReadArtikelTabelle($sql){
        try{
            $dbh = new PDO(
                "mysql:dbname=onlineshop; host=localhost",
                "root",
                ""
            );
            $rueckgabe = $dbh->query($sql);

            $ergebnis = $rueckgabe->fetchAll(PDO::FETCH_ASSOC);

            foreach($ergebnis as $inhalt){
                echo "<tr id='inhalt'>";
                echo "<td>" . $inhalt['ArtikelID'] . "</td>";
                echo "<td>" . $inhalt['Artikelname'] . "</td>";
                echo "<td>" . $inhalt['Beschreibung'] . "</td>";
                echo "<td>" . $inhalt['Einzelpreis'] . "</td>";
                echo "<td>" . $inhalt['Bild'] . "</td>";
                echo "<td>" . $inhalt['Lagerbestand'] . "</td>";
                echo "<td>" . $inhalt['KategorieNR'] . "</td>";
                echo '
                    <td>
                        <form action="admin_artikel_bearbteiten.php", method="post">
                            <input type="hidden" name="artikel-id" value="'.$inhalt['ArtikelID'].'">
                            <input type="hidden" name="kategorie-nr" value="'.$inhalt['KategorieNR'].'">
                            <input id="btn-change" type="submit" value="Bearbeiten">
                        </form> 
                    </td>
                ';
                echo '
                    <td>
                        <form action="admin_delete_confirm.php", method="post">
                            <input type="hidden" name="artikel-id" value="'.$inhalt['ArtikelID'].'">
                            <input id="btn-delete" type="submit" value="Löschen">
                        </form> 
                    </td>
                ';
                echo "</tr>";
            }

            
            $dbh = NULL;
        }
        catch(PDOException $r){
            echo $r->getMessage();
        }
    }

?>