<?php include_once 'session.php' ?>
<script src="js/mantenedor.js"></script>

<section class="mantenedor">
    <b>Mantenedor de Usuarios</b>
    <p>
        Aquí podrá modificar, eliminar o crear nuevos usuarios dentro del sistema.
    </p>
    
    <div id="ajaxLoading">
        <img src="img/ajax-loader.gif" alt="cargando..."/>
    </div>
    
    <div class="areaMantencion"> 
        <table>
            <thead>
                <tr>
                    <th colspan="4">Usuario</th>
                </tr>
                <tr>
                    <th>Email</th>
                    <th>Nombre Usuario</th>
                    <th>Tipo de Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="4">
                        
                    </td>
                </tr>
            </tfoot>
            <tbody id="grilla">
                <tr><td class="vacia" colspan="4">no hay registros</td></tr>
            </tbody>
        </table>
        <p><button id="btn_agregar_usuario" >Agregar Usuario</button></p>
    </div>
    
    <div id="nuevo_usuario">    
        <button id="btn_cerrar_div" >Cerrar</button>
        <h2>Nuevo Usuario</h2>
        <hr>
        <input id="nuevo_email" name="nuevo_email" placeholder="Email" type="text">
        <input id="nuevo_nombre" name="nuevo_nombre" placeholder="Name" type="text">
        <input id="nuevo_pass" name="nuevo_pass" placeholder="Contraseña" type="password">
        <a href="javascript:verificar()" id="submit">Guardar</a>
    </div>

</section>
