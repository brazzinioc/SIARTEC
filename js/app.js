
document.addEventListener('DOMContentLoaded', function(){

    //Invocación de función.
    activaPaginaActual();


    comparaContrasenias();
    
});


function activaPaginaActual(){
    /* Script para mostrar en qué página se encuentra el usuario
    ************************************************************/
    if(document.querySelector('body').classList.contains('index')){
     document.querySelector('#inicio').classList.add('active');
    }

    if(document.querySelector('body').classList.contains('soporte')){
        document.querySelector('#soporte').classList.add('active');
    }
  
    if(document.querySelector('body').classList.contains('ingresar')){
        document.querySelector('#ingresar').classList.add('active');
    }

    if(document.querySelector('body').classList.contains('crear-cuenta')){
        document.querySelector('#registrarse').classList.add('active');
    }
}



/*Función para validar la SIMILITUD de contraseñas al registrarse */
function comparaContrasenias(){
    if(document.querySelector('.form-sing-up')){

        document.querySelector('#btn-crear').setAttribute('disabled', true);

        var lbl_help = document.querySelectorAll('#passwHelp');
        var txt_contrasenia = document.querySelector('#contrasenia');
        var txt_contrasenia_confirmacion = document.querySelector("#contrasenia-confirmacion");

        txt_contrasenia_confirmacion.addEventListener("keyup", function(){
            if(txt_contrasenia.value === txt_contrasenia_confirmacion.value){
                lbl_help[0].innerHTML = 'Contraseñas iguales  <i class="fas fa-check"></i>';
                lbl_help[1].innerHTML = 'Contraseñas iguales <i class="fas fa-check"></i>';
                lbl_help[0].classList.remove('text-warning');
                lbl_help[1].classList.remove('text-warning');

                //Activa el botón de crear
                document.querySelector('#btn-crear').removeAttribute('disabled'); 

            } else {
                lbl_help[0].innerHTML = 'Contraseñas distintos  <i class="fas fa-times"></i>';
                lbl_help[1].innerHTML = 'Contraseñas distintos <i class="fas fa-times"></i>';
                lbl_help[0].classList.add('text-warning');
                lbl_help[1].classList.add('text-warning');

                //Desactiva el botón de crear
                document.querySelector('#btn-crear').setAttribute('disabled', true);
            }
        });
    }
}
