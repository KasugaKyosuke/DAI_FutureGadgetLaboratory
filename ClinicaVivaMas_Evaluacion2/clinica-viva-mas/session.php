<?php
    
    include_once './config.php';
    
    if(!isset($_SESSION['loginUser'])) {
        header("Location: index.php?session=login");
    }

?>

