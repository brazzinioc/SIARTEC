<?php 


$accion = $_POST['accion'];
$usuario = $_POST['usuario'];
$contrasenia = $_POST['contrasenia'];


if($accion === "registrar"){

    //Hasheo de password
    $opciones = array(
        'cost' => 12
    );

    $hash_contrasenia = password_hash($contrasenia, PASSWORD_BCRYPT, $opciones);//Crea el password hash

    include '../funciones/dbConexion.php';
        //Insertamos a la BD.
        try {
    
            $usuarioCreacion = "system";

            $statement = $conn->prepare("INSERT INTO ADMINISTRADORES(usuario, contrasenia, estado, usuarioCreacion, horaCreacion, fechaCreacion, usuarioModificacion,
                                                            horaModificacion, fechaModificacion) 
                                                            VALUES (?,?,1,?, CURRENT_TIME(), CURRENT_DATE(), ? , CURRENT_TIME(), CURRENT_DATE())");

            $statement->bind_param('ssss',$usuario, $hash_contrasenia, $usuarioCreacion, $usuarioCreacion);
            $statement->execute();

            if($statement->affected_rows > 0){
                $respuesta = array(
                    'mensaje' => 'correcto',
                    'accion' => $accion
                );
            } else {
                $respuesta = array(
                    'mensaje' => 'error',
                    'accion' => $accion
                );
            }
        
            //Cierre de conexión.
            $statement->close();
            $conn->close();

        } catch (Exception $e){
            $respuesta = array(
                'mensaje' => $e->getMessage()
            );
        }

    //Envío en json del array respuesta.
    echo json_encode($respuesta);
}

if($accion === 'ingresar'){

    include '../funciones/dbConexion.php';

    try {
        $statement = $conn->prepare("SELECT usuario, id, nombre, contrasenia, fechaCreacion FROM ADMINISTRADORES WHERE usuario = ?");
        $statement->bind_param('s', $usuario);
        $statement->execute();
        
        $statement->bind_result($nombre_usuario, $id_usuario, $nombreApellido_usuario, $contrasenia_usuario, $fecha_creacion); //Captura y almacena los datos consultados en el SELECT
        $statement->fetch();
        
        //Valida si existe el usuario.
        if($nombre_usuario){

            //Verifica la contraseña.
            if(password_verify($contrasenia, $contrasenia_usuario)){ //Verifica la contraseña escrita en el formulario con el de la BD.
                //Si es correcto.
                //Inicia una sesión.
                session_start();
                $_SESSION['usuario'] = $nombre_usuario;
                $_SESSION['id'] = $id_usuario;
                $_SESSION['nombreApellido'] = $nombreApellido_usuario;
                $_SESSION['login'] = true;
                $_SESSION['fechaCreacion'] = $fecha_creacion;

                $respuesta = array(
                    'mensaje' => 'correcto',
                    'accion' => $accion
                );

            } else {
                //Sino coincide.
                $respuesta = array(
                    'mensaje'=>'Contraseña incorrecto',
                    'accion' => $accion
                );
            }

        } else {
            $respuesta = array(
                'mensaje'=>'Usuario no existe',
                'accion' => $accion
            );
        }

    }catch(Exception $e){
        $respuesta = array(
            'mensaje' => $e->getMessage()
        );
    }


    echo json_encode($respuesta);
}
?>