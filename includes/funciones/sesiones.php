<?php 

//Funciones para restringir el acceso sin loguearse.
function usuario_autenticado(){
    if(!revisar_usuario()){ // Si no hay un usuario logueado.
        header('Location:../ingresar.php'); //Redireccionamos al index.php
        exit();
    }
}


function revisar_usuario(){
    //Retorna la existencia de una sessión.La sessión está iniciado en Modelo.
    return isset($_SESSION['usuario']);
}

session_start(); //Arranca una sesión.
usuario_autenticado();




?>