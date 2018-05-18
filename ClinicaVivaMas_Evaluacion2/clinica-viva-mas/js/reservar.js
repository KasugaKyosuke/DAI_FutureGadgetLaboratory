
$(document).ready(function () {
    
    //-----------------------------------------------------------------
    // CARGA DE DATOS DEL COMBOBOX DE ESPECIALIDADES
    //-----------------------------------------------------------------
    console.log("ejecutando procedimiento para cargar las especialidades");

    // recuperar el combobox para las especialidades al cargar la página
    var $comboboxEspecialidades = $('#especialidad');                

    // hacer visible la imagen del loading ajax.
    $("#ajaxLoading").css("visibility", "visible");

    // ejecutar la consulta Ajax con el método getJSON()
    jqXmlHttpRequest = $.getJSON("controlador/reserva/obtenerEspecialidades.php", function (respuestaJSON) {           

        // eliminar todos los elementos option que tenga el combobox
        $comboboxEspecialidades.find('option').remove();
        $comboboxEspecialidades.append('<option value="" >-- Seleccionar Especialidad --</option>');

        // iterar por cada elemento en el arreglo retornado por el servidor en formato JSON
        $.each(respuestaJSON, function (key, value) {
            // agregar una opcion en el select (combobox)
            $comboboxEspecialidades.append('<option value="' + value.id + '">' + value.nombre + '</option>');
        });
    });    

    // siempre que termine/finalice la petición Ajax realizada por el getJON() de más arriba
    jqXmlHttpRequest.always(function () {

        // volver a ocultar la imagen del ajax loading.
        $("#ajaxLoading").css("visibility", "hidden");
    });
    
    
    //-----------------------------------------------------------------
    // CARGA DE DATOS DEL COMBOBOX DE HORARIOS
    //-----------------------------------------------------------------
    console.log("ejecutando procedimiento para cargar las horas");

    // recuperar el combobox para las especialidades al cargar la página
    var $comboboxHorarios = $('#horario');                

    // hacer visible la imagen del loading ajax.
    $("#ajaxLoading").css("visibility", "visible");

    // ejecutar la consulta Ajax con el método getJSON()
    jqXmlHttpRequest = $.getJSON("controlador/reserva/obtenerHorario.php", function (respuestaJSON) {           

        // eliminar todos los elementos option que tenga el combobox
        $comboboxHorarios.find('option').remove();
        $comboboxHorarios.append('<option value="" >-- Seleccionar Horario --</option>');

        // iterar por cada elemento en el arreglo retornado por el servidor en formato JSON
        $.each(respuestaJSON, function (key, value) {
            // agregar una opcion en el select (combobox)
            $comboboxHorarios.append('<option value="' + value.id + '">' + value.hora+ '</option>');
        });
    });    

    // siempre que termine/finalice la petición Ajax realizada por el getJON() de más arriba
    jqXmlHttpRequest.always(function () {

        // volver a ocultar la imagen del ajax loading.
        $("#ajaxLoading").css("visibility", "hidden");
    });
    

    //-----------------------------------------------------------------
    // INCORPORANDO FUNCIONALIDAD PARA CARGA DE DATOS DEL COMBOBOX DE 
    // CENTROS MÉDICOS CUANDO SE CAMBIE LA SELECCIÓN EN EL COMBOBOX DE
    // ESPECIALIDADES
    //-----------------------------------------------------------------
    $('#especialidad').change(function () {

        console.log("ejecutando procedimiento para actualizar los centros medicos");
        
        // recuperar el combobox para los centros médicos
        var $comboboxDinamico = $('#centroMedico');
        
        var codigoEspecialidad = $(this).val();
        
        //limpiar los combobox que dependen de la especialidad
        var $comboboxProfesionales = $('#profesional');
        $comboboxProfesionales.find('option').remove();
        $comboboxProfesionales.append('<option value="" disabled>-- Seleccionar Profesional --</option>');
        
        // validar que efectivamente se ha seleccionado una opción
        if (codigoEspecialidad === "") {
            $comboboxDinamico.find('option').remove();
            $comboboxDinamico.append('<option value="" disabled>-- Seleccionar Centro M&eacute;dico --</option>');
            return;
        }

        // hacer visible la imagen del loading ajax.
        $("#ajaxLoading").css("visibility", "visible");
        
        // ejecutar la consulta Ajax con el método getJSON()
        jqXmlHttpRequest = $.getJSON("controlador/reserva/obtenerCentrosMedicos.php",{codigoEspecialidad: codigoEspecialidad}, function (respuestaJSON) {           
            
            // eliminar todos los elementos option que tenga el combobox
            $comboboxDinamico.find('option').remove();
            $comboboxDinamico.append('<option value="" disabled>-- Seleccionar Centro M&eacute;dico --</option>');
            
            // iterar por cada elemento en el arreglo retornado por el servidor en formato JSON
            $.each(respuestaJSON, function (key, value) {
                // agregar una opcion en el select (combobox)
                $comboboxDinamico.append('<option value="' + value.id + '">' + value.nombre + '</option>');
            });
        });    

        // siempre que termine/finalice la petición Ajax realizada por el getJON() de más arriba
        jqXmlHttpRequest.always(function () {
            
            // volver a ocultar la imagen del ajax loading.
            $("#ajaxLoading").css("visibility", "hidden");
        });
    });
    
    
     //-----------------------------------------------------------------
    // INCORPORANDO FUNCIONALIDAD PARA CARGA DE DATOS DEL COMBOBOX DE 
    // PROFESIONALES CUANDO SE CAMBIE LA SELECCIÓN EN EL COMBOBOX DE
    // CENTROS MÉDICOS
    //-----------------------------------------------------------------   
    $('#centroMedico').change(function () {

        console.log("ejecutando procedimiento para actualizar los profesionales");
        
        // recuperar el combobox para los profesionales
        var $comboboxDinamico = $('#profesional');
        
        var codigoCentroMedico = $(this).val();
        var codigoEspecialidad = $("#especialidad").val();
        
        // validar que efectivamente se ha seleccionado un centro médico
        if (codigoCentroMedico === "") {
            $comboboxDinamico.find('option').remove();
            $comboboxDinamico.append('<option value="" disabled>-- Seleccionar Profesional --</option>');
            return;
        }

        // hacer visible la imagen del loading ajax.
        $("#ajaxLoading").css("visibility", "visible");
        
        // ejecutar la consulta Ajax con el método getJSON()
        jqXmlHttpRequest = $.getJSON("controlador/reserva/obtenerProfesionales.php", {codigoCentroMedico:codigoCentroMedico, codigoEspecialidad:codigoEspecialidad}, function (respuestaJSON) {           
            
            // eliminar todos los elementos option que tenga el combobox
            $comboboxDinamico.find('option').remove();
            $comboboxDinamico.append('<option value="" disabled>-- Seleccionar Profesional --</option>');
            
            // iterar por cada elemento en el arreglo retornado por el servidor en formato JSON
            $.each(respuestaJSON, function (key, value) {
                // agregar una opcion en el select (combobox)
                $comboboxDinamico.append('<option value="' + value.id + '">' + value.nombre + '</option>');
            });
        });    

        // siempre que termine/finalice la petición Ajax realizada por el getJON() de más arriba
        jqXmlHttpRequest.always(function () {
            
            // volver a ocultar la imagen del ajax loading.
            $("#ajaxLoading").css("visibility", "hidden");
        });
    });
                         
    
    //-----------------------------------------------------------------
    // agregando funcionalidad al boton que registra la reserva
    //-----------------------------------------------------------------  
    $("#reservar").click(function(){
        var idPaciente;
        
        if($("#idPaciente").val() == "") {
            alert("Debe ingresar el rut del paciente!");
            return false;
        }  
        
        idPaciente = $("#idPaciente").val();
        
        if($("#especialidad").val() == "") {
            alert("Debe seleccionar una especialidad");
            return false;
        }     
        
        if($("#centroMedico").val() == "" || $("#centroMedico").val() == undefined) {
            alert("Debe seleccionar un centro m\u00E9dico!");
            return false;
        }
        
        if($("#profesional").val() == "" || $("#profesional").val() == undefined) {
            alert("Debe seleccionar un profesional!");
            return false;
        }
        
        if($("#fecha").val() == "" || $("#fecha").val() == undefined) {
            alert("Debe seleccionar una fecha!");
            return false;
        }
        
        if($("#horario").val() == "" || $("#horario").val() == undefined) {
            alert("Debe seleccionar un horario!");
            return false;
        }
        
         console.log("ejecutando procedimiento para ingresar la reserva");
         
        $("#ajaxLoading").css("visibility", "visible");
         
         jqXmlHttpRequest = $.post("controlador/reserva/ingresarReserva.php", {idPaciente:idPaciente, idProfesional:$("#profesional").val(), fecha: $("#fecha").val() , hora: $("#horario").val()}, function (respuesta) { 
             alert(respuesta);
         });
         
         jqXmlHttpRequest.always(function () {           
            $("#ajaxLoading").css("visibility", "hidden");
        });
    });
})

