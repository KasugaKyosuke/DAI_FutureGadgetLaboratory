  
    <div id="loginBar">
<?php if(isset($_SESSION['loginUser'])) { ?>
        Bienvenido <b><?= $_SESSION['loginUser'] ?></b>
        [<a href="index.php?session=logout">Salir</a>]
<?php } else { ?>
        [<a href="index.php?session=login">Acceder</a>]
<?php } ?>
    </div>
