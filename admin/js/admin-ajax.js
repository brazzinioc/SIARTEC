

$(document).ready(function(){

    //Script para crear y editar registros.
    /*****************************************/
    $('#guardar-registro').on('submit', function(e){
        
        e.preventDefault(); //Previene la ejecución del action
               
        var datos = $(this).serializeArray();  //obtiene los datos del formulario. SerializeArray itera todos los campos del formulario, luego crea un objeto.

        //Llamado a AJAX con JQUERY.
        $.ajax({
            type: $(this).attr('method'), //Método del form
            data: datos, //Datos del form
            url: $(this).attr('action'), //Action del form
            dataType: 'json',
            success: function(data){

                var respuesta = data;
                console.log(respuesta);

                if(respuesta['mensaje'] === 'correcto'){

                    if(respuesta['accion'] === 'crear'){ 
                        swal("Correcto!", "Se guardó correctamente.", "success");
                        $('#guardar-registro')[0].reset(); //limpia los campos del formulario.
                    }

                    if(respuesta['accion'] === 'actualizar'){ 
                        swal("Correcto!", "Datos actualizados correctamente.", "success");
                    }


                } else {
                    swal("Error!", respuesta['mensaje'], "error");
                }
            }
        });

    });


    //Script para eliminar registros.
    /*****************************************/
    $('.borrar_registro ').on('click', function(e){
        e.preventDefault();
        
        var id = $(this).attr('data-id');
        var tipo = $(this).attr('data-tipo');
        var accion = "eliminar";

        swal({
            title: "¿Estas seguro (a)?",
            text: "Esta acción no se puede deshacer !",
            icon: "warning",
            buttons: true,
            dangerMode: true
          })
          .then((willDelete) => {
            if (willDelete) {
                //Cuando se hace click en OK.

                //Llamado a AJAX con JQUERY.
                $.ajax({
                    type: 'post',
                    data: { //Hacemo un objeto de todos los datos que deseamos enviar.
                        'id': id,
                        'accion': accion
                    },
                    url: 'includes/modelos/modelo-' + tipo + '.php', //Llamado el modelo-alumno.php 

                    success: function(data){
                      
                        var resultado = JSON.parse(data); //Convierte el String enviado por el modelo a JSON.
                        
                        if(resultado.mensaje === 'correcto'){
                            
                            swal("Eliminado", "Registro eliminado", "success");
                            jQuery('[data-id="'+ resultado.id_eliminado +'"]').parents('tr').remove(); //Seleciona el registro del data table luego va al padre y lo elimina del DOM

                        } else {
                            swal("Error!", resultado['mensaje'], "error");
                        }
                       
                    }

                }); //Fin AJAX

            } else {
              swal('Cancelado', 'No se eliminó el registro', 'error');
            }
          });
    });





    //Codigo que se ejecuta cuando en el form tenemos un campo de archivo
    //Por ejemplo en el form de crear un administrador.
    $('#guardar-registro-archivo').on('submit', function(e){
        e.preventDefault(); 

        //obtener datos, this se refiere a la ejecución del submit. 
        var datos = new FormData(this); //Creamos una instancia de FormData.

        //Llamado a AJAX con JQUERY
        $.ajax({
            type: $(this).attr('method'), //Type: POST o GET. Extrae el método del form.
            data: datos, //datos de los campos del form
            url: $(this).attr('action'), //Los datos se envian al valor de action. Al archivo PHP
            dataType: 'json', //Tipo de datos
            //campos extras siempre y cuando se use campos archivos en el FORM
            contentType: false,
            processData: false, //Imágenes procesadas
            async: true,
            cache: false, //para que no cacheé la URL al que se envia la img
            success: function(data){ //Cuando la llamada sea exitoso.
                
                var respuesta = data;

                if(respuesta['mensaje'] === 'correcto'){
                    
                    if(respuesta['accion'] === 'crear'){ 
                        swal("Correcto!", "Los datos se guardaron correctamente." + "\n" + "Imagen: " + respuesta['estadoImagen'] , "success");
                        $('#guardar-registro-archivo')[0].reset(); //limpia los campos del formulario.
                    }

                    if(respuesta['accion'] === 'actualizar'){ 
                        swal("Correcto!", "Los datos se guardaron correctamente." + "\n" + "Imagen: " + respuesta['estadoImagen'] , "success");
                       
                    }

                } else {
                    swal("Error!", respuesta['mensaje'], "error");
                
                }
                

            }
        
        });
    });




    /*******************************************************************************************************************************************/
    /* SCRIPT PARA MÓDULO PRÉSTAMO */

    // Oculta el ingreso de datos en el formulario NUEVO PRÉSTAMO
    $('#ingreso-datos').hide();

    $('#dni').keypress(
        function(){
           $('#ingreso-datos').hide();
    } );    

    //Código para BUSCAR DNI en el formulario de  NUEVO PRÉSTAMO.
    $('#buscar_dni').on('click', function(e){
        
        e.preventDefault();

        var tipoUsuario = $('#tipoUsuario').val();
        var dniUsuario = $('#dni').val();
        var accion = "buscar_dni";

        if(tipoUsuario === '' || dniUsuario === ''){
            swal("Error!", 'Los campos Tipo de Usuario y DNI son obligatorios', "error");

        } else {
                //Llamado a AJAX con JQUERY.
                $.ajax({
                    type: 'post',
                    data: { //Hacemo un objeto de todos los datos que deseamos enviar.
                        'tipoUsuario': tipoUsuario,
                        'dniUsuario': dniUsuario,
                        'accion': accion
                    },
                    url: 'includes/modelos/modelo-prestamo.php', //Llamado el modelo-alumno.php 

                    success: function(data){
                      
                        var resultado = JSON.parse(data); //Convierte el String enviado por el modelo a JSON.
                        
                        if(resultado.accion === 'buscar_dni'){
                            
                            if(resultado.resultadoBusqueda){
                                swal("Correcto", "El DNI está registrado en el sistema.", "success");
                                $('#ingreso-datos').show();

                            } else {
                                swal("Error", "El DNI NO está registrado en el sistema." + "\n" + "Por favor registrel el usuario e intente nuevamente.", "error");
                                $('#ingreso-datos').hide();
                            }
                            
                           
                        } else {
                            swal("Error!", resultado['mensaje'], "error");
                        }
                       
                    }

                }); //Fin AJAX



        }

    });


});

    /*******************************************************************************************************************************************/
    /* SCRIPT PARA MÓDULO DEVOLUCIÓN */

    $('.devolver_prestamo').on('click', function(e){
        e.preventDefault();

        var id = $(this).attr('data-id');
        var tipo = $(this).attr('data-tipo');
        var accion = "devolver";

        
        swal({
            title: "¿Estas seguro (a)?",
            text: "Esta acción no se puede deshacer !",
            icon: "warning",
            buttons: true,
            dangerMode: true
          })
          .then((willDelete) => {
            if (willDelete) {
                //Cuando se hace click en OK.

                //Manda un popup para escribir una observación de la devolución.
                swal("Escriba una observación de la devolución", {
                    content: "input",
                  })
                  .then((value) => {
                    //Guarda la observación escrita en la variable observacion.
                    var observacion = value;
                    

                    //Llamado a AJAX con JQUERY.
                    $.ajax({
                        type: 'post',
                        data: {
                            'id' : id,
                            'accion': accion,
                            'observacion_devolucion': observacion
                        },
                        url: 'includes/modelos/modelo-' + tipo + '.php',
                        success: function(data){

                            var resultado = JSON.parse(data);

                            if(resultado.mensaje === 'correcto'){
                            
                                swal("Correcto", "Préstamo devuelto", "success");
                                jQuery('[data-id="'+ resultado.id_eliminado +'"]').parents('tr').remove(); //Seleciona el registro del data table luego va al padre y lo elimina del DOM
    
                            } else {
                                swal("Error!", resultado['mensaje'], "error");
                            }

                        }
                    });
                  });

            } else {
              swal('Cancelado', 'No se realizó la devolución del préstamo.', 'error');
            }
          });

    });



    $('#descargar_reporte').on('click', function(e){

        e.preventDefault();

        var fechaInicio = $('#fechaInicio').val();
        var fechaFin = $('#fechaFin').val();
        var filtro = $('#filtro').val();
        var formulario = $('#form-reporte');

        if( fechaInicio === '' || fechaFin === '' || filtro === ''){
            //validamos los campos.
            swal("Error", "Llene o seleccione todos los campos.", "error");
        } else{ 
          formulario.attr('method', 'POST');
          formulario.attr('action', 'includes/modelos/modelo-reporte.php');
          formulario.submit();

          formulario.removeAttr('method');
          formulario.removeAttr('action');


        }


    });