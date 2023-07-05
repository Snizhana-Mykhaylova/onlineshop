<!DOCTYPE html>
<html lang="en">
    <?php
        function navbar(){
            echo '
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <!-- BOOTSTRAP CSS einbinden -->
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
                    <!-- BOOTSTRAP JavaScript einbinden -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"> </script>
                    <link rel="stylesheet" href="adminpanel.css">
        
                    
                    <div id="container-nav"> 
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <a style="padding-left: 10px;" class="navbar-brand" href="admin_panel.php">Admin Panel</a>
                            
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            
                            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                
                                <div class="navbar-nav">
                                    <a class="nav-item nav-link active" href="admin_add.php">Artikel hinzufügen<span class="sr-only"></span></a>
                                    <a class="nav-item nav-link active" href="admin_change.php">Artikel ändern<span class="sr-only"></span></a>
                                </div>
                                
                            </div>
                        </nav>
                    </div>
                </head>
            ';
        }
    ?>
</html>