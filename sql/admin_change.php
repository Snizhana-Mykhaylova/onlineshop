<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php 
            include "admin_navbar.php";
            include "sql_functions.php";

            navbar();
        ?>


        <style>
            table{
                border: 1px solid;
                margin-left: 10px;
            }
            
            tr{
                border: 1px solid;
                height: 50px;
            }

            #inhalt:hover{
                background-color: darkgray;
            }

            th{
                border: 1px solid;
                padding: 0px 20px 0px 3px;
            }

            td{
                border: 1px solid;
                padding-left: 3px;
            }
            
        </style>
    </head>

    <body style="background-color: #DCDCDC;">

        <table>
            <tr align="left">
                <th>ID</th>
                <th>Artikelname</th>
                <th>Beschreibung</th>
                <th>Preis</th>
                <th>Bild Url</th>
                <th>Bestand</th>
                <th>K.NR</th>
                <th>Bearbeiten</th>
                <th>Löschen</th>
            </tr>

            <?php
                $sql_r = "SELECT * FROM artikel;";
                databaseReadArtikelTabelle($sql_r);
            ?>
        </table>
    </body>
</html>