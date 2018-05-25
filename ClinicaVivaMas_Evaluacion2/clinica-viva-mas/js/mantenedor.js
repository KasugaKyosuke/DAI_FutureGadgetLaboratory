

function eliminarUsuario(email) {
    if(!confirm("¿Esta seguro de eliminar el usuario?")) {
        return false;
    }
    
    console.log("ejecutando procedimiento para eliminar usuario");
        
    jqXmlHttpRequest = $.post("controlador/mantenedor/eliminarUsuario.php",{email: email}, function (respuesta) {
        alert(respuesta);
        location.reload();
    });    

    // siempre que termine/finalice la petición Ajax realizada por el getJON() de más arriba
    jqXmlHttpRequest.always(function () {

        // volver a ocultar la imagen del ajax loading.
        $("#ajaxLoading").css("visibility", "hidden");
    });
} 

$(document).ready(function () {       

        $('#btn_agregar').click(function() {
            if($('#nuevo_usuario').css('visibility') == 'hidden') {
                $('#nuevo_usuario').css('visibility','visible');
            }
            $('#nuevo_email').val("");
            $('#nuevo_nombre').val("");
            $('#nuevo_pass').val("");
        });
        
        $('#btn_cerrar').click(function() {
            if($('#nuevo_usuario').css('visibility') == 'visible') {
                $('#nuevo_usuario').css('visibility','hidden');
            }
        });
        
        $('#btn_guardar').click(function() {
           if($("#nuevo_email").val() == "") {
                alert("Debe ingresar email del usuario");
                $("#nuevo_email").focus();
                return false;
            }
            
            if($("#nuevo_nombre").val() == "") {
                alert("Debe ingresar nombre del usuario");
                $("#nuevo_nombre").focus();
                return false;
            }
            
            if($("#nuevo_pass").val() == "") {
                alert("Debe ingresar password del usuario");
                $("#nuevo_pass").focus();
                return false;
            }
            
            if($("#tipo_usuario").val() == "" || $("#tipo_usuario").val() == undefined) {
                alert("Debe seleccionar un tipo de usuario del listado");
                return false;
            }
            
            console.log("ejecutando procedimiento para ingresar el nuevo usuario");
            
            $("#ajaxLoading").css("visibility", "visible");
         
            jqXmlHttpRequest = $.post("controlador/mantenedor/ingresarUsuario.php", {email:$("#nuevo_email").val(), nombre:$("#nuevo_nombre").val(), pass: $("#nuevo_pass").val() , idtipousuario: $("#tipo_usuario").val()}, function (respuesta) { 
                alert(respuesta);
                location.reload();
            });

            jqXmlHttpRequest.always(function () {           
               $("#ajaxLoading").css("visibility", "hidden");
           });
            
        });
        
        //-----------------------------------------------------------------
        // CARGA DE DATOS DEL COMBOBOX DE TIPOS DE USUARIO
        //-----------------------------------------------------------------
        console.log("ejecutando procedimiento para cargar los tipos de usuario");

        // recuperar el combobox para las especialidades al cargar la página
        var $comboboxTipoUsario = $('#tipo_usuario');                

        // hacer visible la imagen del loading ajax.
        $("#ajaxLoading").css("visibility", "visible");

        // ejecutar la consulta Ajax con el método getJSON()
        jqXmlHttpRequest = $.getJSON("controlador/mantenedor/obtenerTipoUsuarios.php", function (respuestaJSON) {           

            // eliminar todos los elementos option que tenga el combobox
            $comboboxTipoUsario.find('option').remove();
            $comboboxTipoUsario.append('<option value="" >-- Seleccionar Tipo Usuario --</option>');

            // iterar por cada elemento en el arreglo retornado por el servidor en formato JSON
            $.each(respuestaJSON, function (key, value) {
                // agregar una opcion en el select (combobox)
                $comboboxTipoUsario.append('<option value="' + value.id + '">' + value.tipousuario + '</option>');
            });
        });    

        // siempre que termine/finalice la petición Ajax realizada por el getJON() de más arriba
        jqXmlHttpRequest.always(function () {

            // volver a ocultar la imagen del ajax loading.
            $("#ajaxLoading").css("visibility", "hidden");
        });
      
        console.log("ejecutando procedimiento para obtener el listado de usuarios");
        
        var $grillaResultados = $('#grilla');

        $("#ajaxLoading").css("visibility", "visible");
        
        jqXmlHttpRequest = $.getJSON("controlador/mantenedor/obtenerUsuarios.php", function (respuestaJSON) {
            
            $grillaResultados.find('tr').remove();            
            
            $.each(respuestaJSON, function (key, value) {            
                $grillaResultados.append('<tr><td>' + value.email + '</td><td>' + value.nombre + '</td><td>' + value.tipousuario + '</td><td><input type="button" name="eliminar" value="Eliminar" onclick="javascript:eliminarUsuario(\''+value.email+'\');"/></td></tr>');
            });
        });    

        jqXmlHttpRequest.always(function () {
            $("#ajaxLoading").css("visibility", "hidden");
        });
})
