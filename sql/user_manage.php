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

            body{
                background-color: #DCDCDC;
            }
            
        </style>
    </head>

    <body>

        <table>
            <tr align="left">
                <th>ID</th>
                <th>User</th>
                <th>Erstellungsdatum</th>
                <th>Löschen</th>
            </tr>

            <?php
                $sql_r = "SELECT * FROM users WHERE NOT id = 1;";

                try{
                    $dbh = new PDO(
                        "mysql:dbname=onlineshop; host=localhost",
                        "root",
                        ""
                    );
                    $rueckgabe = $dbh->query($sql_r);
        
                    $ergebnis = $rueckgabe->fetchAll(PDO::FETCH_ASSOC);
        
                    foreach($ergebnis as $inhalt){

                        if($inhalt["id"] != 1){

                            echo '
                                <tr id="inhalt">
                                <td>' . $inhalt["id"] . '</td>
                                <td>' . $inhalt["username"] . '</td>
                                <td>' . $inhalt["username"] . '</td>
                            ';
    
                            echo '
                                <td>
                                    <form action="admin_users_delete_confirm.php", method="post">
                                        <input type="hidden" name="user-id" value="'.$inhalt['id'].'">
                                        <input id="btn-delete" type="submit" value="Löschen">
                                    </form> 
                                </td>
                            ';
                            echo "</tr>";
                        }
                    }
        
                    
                    $dbh = NULL;
                }
                catch(PDOException $r){
                    echo $r->getMessage();
                }
            ?>
        </table>
    </body>
</html>