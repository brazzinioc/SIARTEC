
eventListeners();

function eventListeners(){

    document.querySelector('#formulario').addEventListener('submit', validaFormulario);

}

function validaFormulario(e){
    e.preventDefault();
    
    //Cuando estemos en el formulario Registrarse
    if(document.querySelector('.form-sing-up')){
        
        var usuario = document.querySelector('#usuario').value,
            contrasenia = document.querySelector('#contrasenia').value,
            contraseniaConfirmacion = document.querySelector('#contrasenia-confirmacion').value,
            accion = document.querySelector('#accion').value;

        if(usuario === '' || contrasenia === '' || contraseniaConfirmacion === ''){

            swal("Error!", "Todos los campos son obligatorios", "error");

        } else {

            //Creamos FormData
            var datos = new FormData();
            datos.append('usuario', usuario);
            datos.append('contrasenia', contrasenia);
            datos.append('accion', accion); 

            //Invocamos la función que ennvia los datos por AJAX
            enviaDataAjax(datos);

        }
    }



    //Cuando estemos en el formulario Ingresar.
    if(document.querySelector('.form-login')){
        
        var usuario = document.querySelector('#usuario').value,
            contrasenia = document.querySelector('#contrasenia').value,
            accion = document.querySelector('#accion').value;

        if(usuario === '' || contrasenia ===''){

            swal("Error!", "Todos los campos son obligatorios", "error");

        } else {
            //Creamos FormData
            var datos = new FormData();
            datos.append('usuario', usuario);
            datos.append('contrasenia', contrasenia);
            datos.append('accion', accion); 

            //Invocamos la función que ennvia los datos por AJAX
            enviaDataAjax(datos);

        }
    }
}

function enviaDataAjax(datos){
    //Llamado a AJAX
    //Crear Objeto.
    var xhr = new XMLHttpRequest();


    //Abrir Conexión.
    xhr.open('POST', 'includes/modelos/modelo-admin.php', true);

    //Leer Respuesta.
    xhr.onload = function(){
        if(this.status === 200){

            var respuesta = JSON.parse(xhr.responseText);
            console.log(respuesta);

            if(respuesta.accion === "registrar"){

                if(respuesta.mensaje === "correcto"){
                
                    //Mandamos mensaje.
                    swal("Correcto!", "Usuario registrado.", "success");

                    //Limpia campos de formulario.
                    document.querySelector('form').reset();

                } else if(respuesta.mensaje === "error"){
                    swal("Error!", "Usuario ya está en uso. Elige otro usuario.", "warning");
                } else {
                    swal("Error!", respuesta.mensaje, "error");
                }
            }

            if(respuesta.accion === "ingresar"){
                
                if(respuesta.mensaje === "correcto"){
                    //Mandamos mensaje.
                    swal("Correcto!", "Login correcto", "success");
                    window.setTimeout(function(){
                        window.location.href = 'admin/admin-area.php';
                    }, 2000); //2 segundos
                    
                } else {
                    swal("Error!", respuesta.mensaje, "error");
                }
            }

        }
    }


    //Enviar petición.
    xhr.send(datos);
}