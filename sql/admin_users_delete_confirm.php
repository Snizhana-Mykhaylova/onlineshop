<?php
    include "sql_functions.php";
    
    if(isset($_POST["user-id"])){
        $user_delete_id = floatval($_POST["user-id"]);

        $sql_d = "DELETE FROM users
                  WHERE id = $user_delete_id";

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
        <?php header("location: ./user_manage.php")?>
    </body>
</html>