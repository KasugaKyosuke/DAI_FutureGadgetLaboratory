<?php
    include_once './config.php';
    require_once ROOT_DIR.'/modelo/dao/UsuarioDao.class.php';
    require_once ROOT_DIR.'/modelo/Usuario.class.php';
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $daoUsuario = new UsuarioDao();
        $usuario = $daoUsuario->autenticate($_POST["email"], $_POST["clave"]);
        
        if($usuario!=NULL) {
            //session_register($usuario);
            $_SESSION['loginUser'] = $usuario->getNombre();
            header("location: index.php?menu=inicio");
        }else {
            $loginError = "El email o clave no es v&aacute;lido";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Demo Login PHP</title>        
    </head>
    <body>
        
        <?php
            if(isset($loginError)) {                
        ?>
        <div class="loginError">
            <p><?= $loginError ?></p>
        </div>
        <?php
            }
        ?>            
        <form action="index.php?session=login" method="POST">
            <table>
                <tr>
                    <td>E-Mail: </td>
                    <td>
                        <input type="email" name="email" value="" />
                    </td>
                </tr>
                <tr>
                    <td>Clave:</td>
                    <td>
                        <input type="password" name="clave" value="" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="login" value="Entrar" />
                        <input type="button" name="cancelar" value="Cancelar" />
                    </td>
                </tr>
            </table>            
        </form>
        
    </body>
</html>
