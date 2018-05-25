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
        <p><button id="btn_agregar" >Agregar Usuario</button></p>
    </div>
    
    <div id="nuevo_usuario">    
        <h3>Nuevo Usuario</h3>
        <hr>
        <input id="nuevo_email" name="nuevo_email" placeholder="Email" type="text">
        <input id="nuevo_nombre" name="nuevo_nombre" placeholder="Name" type="text">
        <input id="nuevo_pass" name="nuevo_pass" placeholder="Contraseña" type="password">
        <select id="tipo_usuario" name="tipo_usuario">
            <option value="" disabled="">-- Seleccionar Tipo Usuario --</option>
        </select>
        <div class="areaBotones">
            <input id="btn_cerrar" type="button" value="Cerrar" name="btn_cerrar" />
            <input id="btn_guardar" type="button" value="Guardar" name="btn_guardar" />
        </div>
    </div>

</section>
