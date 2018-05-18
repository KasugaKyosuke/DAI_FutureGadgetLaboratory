<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Clinica Viva M&aacute;s</title>
        <style>
            @import url(css/masterpage.css);
            @import url(css/contenido.css);
        </style>
        <script src="js/jquery-2.1.3.min.js"></script>
    </head>
    <body>
        <div id="masterpage">
            <header>
                <?php include_once 'base/header.php'; ?>
            </header>
            
            <menu>
                <?php include_once 'base/menu.php'; ?>
            </menu>
            
            <div id="contenido">
                <?php 
                    $menuActual = "inicio";
                    
                    if(isset($_GET['menu'])) {
                        $menuActual = $_GET['menu'];
                    } else if(isset($_GET['session'])) {                    
                        $menuActual = $_GET['session'];
                    }
                    
                    $pagina = $menuActual.'.php';
                    
                    include_once 'base/sessionbar.php';
                    
                    if(file_exists($pagina)) {
                        include_once($pagina);
                    } else {
                        include_once('base/error404.php');
                    }
                ?>                
            </div>
            
            <footer>
                <?php include_once 'base/footer.php'; ?>
            </footer>
        </div>
    </body>
</html>
