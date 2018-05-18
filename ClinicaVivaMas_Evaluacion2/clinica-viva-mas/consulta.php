<?php include_once 'session.php' ?>
<script src="js/consultar.js"></script>

<section class="consulta">
    <b>Consulta</b>
    <p>
        Ingresa el RUT del paciente para consultar por las reservas registradas
    </p>
    
    <div id="ajaxLoading">
        <img src="img/ajax-loader.gif" alt="cargando..."/>
    </div>
    
    <div class="areaPaciente">
        <label>RUT del Paciente: </label>
        <input id="idPaciente" type="text" name="rut" value="" />
        <input id="consultar" type="button" name="consultar" value="Buscar" />
    </div>
    
    <div class="areaConsulta"> 
        <table>
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th colspan="5">Reserva</th>
                </tr>
                <tr>
                    <th>RUT</th>
                    <th>Especialidad</th>
                    <th>Centro M&eacute;dico</th>
                    <th>Profesional</th>
                    <th>Horario</th>
                    <th>Acci&oacute;n</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="6">
                        
                    </td>
                </tr>
            </tfoot>
            <tbody id="grilla">
                <tr><td class="vacia" colspan="6">no hay registros</td></tr>
            </tbody>
        </table>            
    </div>
</section>
