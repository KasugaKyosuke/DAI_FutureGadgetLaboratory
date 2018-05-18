
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

$(document).ready(function () {       
    
    $("#consultar").click(function(){
        var idPaciente = $("#idPaciente").val();
        
        if(idPaciente == "") {
            alert("debe ingresar el RUT del cliente");
            return;
        }
        
        console.log("ejecutando procedimiento para obtener el listado de reservas");
        
        var $grillaResultados = $('#grilla');

        $("#ajaxLoading").css("visibility", "visible");
        
        jqXmlHttpRequest = $.getJSON("controlador/consulta/obtenerReservas.php",{idPaciente: idPaciente}, function (respuestaJSON) {
            
            $grillaResultados.find('tr').remove();            
            
            $.each(respuestaJSON, function (key, value) {            
                $grillaResultados.append('<tr><td>' + value.paciente + '</td><td>' + value.especialidad + '</td><td>' + value.centromedico + '</td><td>' + value.profesional + '</td><td>' + value.fecha+" "+ value.hora + '</td><td><input type="button" name="anular" value="Anular" onclick="javascript:anularReserva('+value.paciente+','+value.id_profesional+',\''+value.fecha+'\');"/></td></tr>');
            });
        });    

        jqXmlHttpRequest.always(function () {
            $("#ajaxLoading").css("visibility", "hidden");
        });
    });
})

