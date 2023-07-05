<?php
    //index.php — This file will contain the master template (header, footer, etc) and basic routing so we can include the pages below.
    session_start();
    // Include functions and connect to the database using PDO MySQL


    // Page is set to home (home.php) by default
    $page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';
    // Include and show the requested page
    include $page . '.php';
?>