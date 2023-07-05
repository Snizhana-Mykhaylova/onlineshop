<?php
    include "sql_functions.php";
    
    if(isset($_POST["artikel-id"])){
        $artikel_delete_id = floatval($_POST["artikel-id"]);

        $sql_d = "DELETE FROM artikel
                WHERE ArtikelID = $artikel_delete_id";

        databaseWrite($sql_d);
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