

$(document).ready(function(){

    //Script para crear y actualizar registros.
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
                        window.setTimeout(function(){
                            $(window).attr('location','lista-alumno.php');   
                        }, 2000); //2 segundos
                       
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
                    url: 'includes/modelos/modelo-'+ tipo + '.php', //Llamado el modelo-alumno.php 

                    success: function(data){
                      
                        var resultado = JSON.parse(data); //Convierte el String enviado por el modelo a JSON.
            
                        console.log(resultado);
                        
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


});