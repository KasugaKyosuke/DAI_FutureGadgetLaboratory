
/*
function anularReserva(idPaciente, idProfesional, fecha) {
    if(!confirm("¿Esta seguro de anular la reserva?")) {
        return false;
    }
    
    console.log("ejecutando procedimiento para anular la reserva");
        
    jqXmlHttpRequest = $.post("controlador/reserva/anularReserva.php",{idPaciente: idPaciente,idProfesional:idProfesional,fecha:fecha }, function (respuesta) {
        alert(respuesta);
        $("#consultar").click();
    });    

    // siempre que termine/finalice la petición Ajax realizada por el getJON() de más arriba
    jqXmlHttpRequest.always(function () {

        // volver a ocultar la imagen del ajax loading.
        $("#ajaxLoading").css("visibility", "hidden");
    });
} 
*/


$(document).ready(function () {       
    /*
    $("#consultar").click(function(){
        var idPaciente = $("#idPaciente").val();
        
        if(idPaciente == "") {
            alert("debe ingresar el RUT del cliente");
            return;
        }
       */
      
      // Validating Empty Field
        /*
          
         $("#submit").click(function(){
        if ($("nuevo_email").val() == "" || $("nuevo_nombre").val() == "" || $("nuevo_pass").val() == "") {
        alert("Complete todos los campos !");
        return false;
        }
        }
        */
        //Function To Display Popup
        $('#btn_agregar_usuario').click(function() {
            if($('#nuevo_usuario').css('visibility') == 'hidden') {
                $('#nuevo_usuario').css('visibility','visible');
            }
        });
        
        $('#btn_cerrar_div').click(function() {
            if($('#nuevo_usuario').css('visibility') == 'visible') {
                $('#nuevo_usuario').css('visibility','hidden');
            }
        });
      
        console.log("ejecutando procedimiento para obtener el listado de usuarios");
        
        var $grillaResultados = $('#grilla');

        $("#ajaxLoading").css("visibility", "visible");
        
        jqXmlHttpRequest = $.getJSON("controlador/mantenedor/obtenerUsuarios.php", function (respuestaJSON) {
            
            $grillaResultados.find('tr').remove();            
            
            $.each(respuestaJSON, function (key, value) {            
                //$grillaResultados.append('<tr><td>' + value.email + '</td><td>' + value.nombre + '</td><td>' + value.tipousuario + '</td><td>' + value.profesional + '</td><td>' + value.fecha+" "+ value.hora + '</td><td><input type="button" name="anular" value="Anular" onclick="javascript:anularReserva('+value.paciente+','+value.id_profesional+',\''+value.fecha+'\');"/></td></tr>');
                $grillaResultados.append('<tr><td>' + value.email + '</td><td>' + value.nombre + '</td><td>' + value.tipousuario + '</td><td></td></tr>');
            });
        });    

        jqXmlHttpRequest.always(function () {
            $("#ajaxLoading").css("visibility", "hidden");
        });
})
