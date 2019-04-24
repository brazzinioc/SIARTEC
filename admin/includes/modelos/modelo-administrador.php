<?php 
    
require_once '../../../includes/funciones/dbConexion.php';


$accion = filter_var($_POST['accion'], FILTER_SANITIZE_STRING);

$usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
$nombre = filter_var($_POST['nombres'], FILTER_SANITIZE_STRING);
$contrasenia = $_POST['contrasenia'];
$estado = filter_var($_POST['estado'], FILTER_VALIDATE_INT);

$id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

session_start();
$usuarioSesion = $_SESSION['usuario'];


if($accion === "crear"){

    $directorio = "../../img/administradores/"; //Ruta donde se guardarán las imágenes

    //Validamos la existencia de la carpeta.Sino existe la crea y da los permisos.
    if( !is_dir($directorio) ){
        mkdir($directorio, 0755, true); //crea carpeta , da permiso 0755:permiso para ser vistos por visitantes pero no manipulados. True: es recursivo, hace que todos los archivos tengan los mismos permisos.
    }

    //Mueve el archivo subido, de la ubicación temp a la carpeta que final que deseamos.
    if( move_uploaded_file ($_FILES['imagenAdministrador']['tmp_name'] , $directorio . $_FILES['imagenAdministrador']['name'] ) ) {
        
        $urlImagen = $_FILES['imagenAdministrador']['name'];
        $resultadoSubida = "El archivo SE GUARDO correctamente";

    } else {
        $resultadoSubida = "El archivo NO SE GUARDÓ.";
    }


    try {

        //Hasheo de password
        $opciones = array(
            'cost' => 12
        );

        $hash_contrasenia = password_hash($contrasenia, PASSWORD_BCRYPT, $opciones);

        $stmt = $conn -> prepare(" INSERT INTO ADMINISTRADORES (usuario, nombre, contrasenia, urlImagen, estado, usuarioCreacion, horaCreacion, 
                                fechaCreacion, usuarioModificacion, horaModificacion, fechaModificacion) 
                                VALUES ( ?, ?, ?, ?, ?, ?, CURRENT_TIME(), CURRENT_DATE(), ?, CURRENT_TIME(), CURRENT_DATE() ) "); 

        $stmt -> bind_param('ssssiss', $usuario, $nombre, $hash_contrasenia, $urlImagen, $estado, $usuarioSesion, $usuarioSesion);
        $stmt -> execute();

        if( $stmt -> affected_rows > 0){
            $respuesta = array(
                'mensaje' => 'correcto',
                'accion' => $accion,
                'estadoImagen' => $resultadoSubida
            );

        } else if( $stmt -> error){
            $respuesta = array(
                'mensaje' => "Elija otro usuario"
            );

        } else {
            $respuesta = array(
                'mensaje' => $stmt -> error
            );
        }


        $stmt -> close();
        $conn -> close();


    } catch( Exception $e){
        $respuesta = array(
            'mensaje' => $e -> getMessage()
        );
    }

    
    die(json_encode($respuesta));


}





if($accion === "actualizar"){

    $directorio = "../../img/administradores/"; //Ruta donde se guardarán las imágenes

    //Validamos la existencia de la carpeta.Sino existe la crea y da los permisos.
    if( !is_dir($directorio) ){
        mkdir($directorio, 0755, true); //crea carpeta , da permiso 0755:permiso para ser vistos por visitantes pero no manipulados. True: es recursivo, hace que todos los archivos tengan los mismos permisos.
    }

    /*
    $pesoImagen = $_FILES['imagenAdministrador']['size'];
    
    $respuesta = array(
        'mensaje'  => $pesoImagen
    );

    die( json_encode($respuesta) );
    exit;*/

    if( (int) $_FILES['imagenAdministrador']['size'] > 0 ) {

        if( move_uploaded_file ($_FILES['imagenAdministrador']['tmp_name'], $directorio . $_FILES['imagenAdministrador']['name']) ){
            
            $urlImagen = $_FILES['imagenAdministrador']['name'];
            $resultadoSubida = "El archivo SE GUARDO correctamente";
    
        } else {
            $resultadoSubida = "El archivo NO SE GUARDÓ.";
        }

    }


    try {

        // Opciones para el hasheo de password
        $opciones = array(
            'cost' => 12
        );

        if( empty($contrasenia) ){ //Validamos sí el campo contraseña esté vacío.

            //NO SE ACTUALIZA LA CONTRASEÑA
            if( empty($urlImagen) ){
                //No insertaremos URL de la img.

                $stmt = $conn -> prepare("UPDATE ADMINISTRADORES SET usuario = ?, nombre = ?, estado = ?, usuarioModificacion = ?, horaModificacion = CURRENT_TIME(), fechaModificacion = CURRENT_DATE() WHERE id = ?");
                $stmt -> bind_param('ssisi', $usuario, $nombre, $estado, $usuarioSesion, $id);
                
            } else {
                //Insertaremos URL de la imagen.
                $stmt = $conn -> prepare("UPDATE ADMINISTRADORES SET usuario = ?, nombre = ?, urlImagen = ?, estado = ?, usuarioModificacion = ?, horaModificacion = CURRENT_TIME(), fechaModificacion = CURRENT_DATE() WHERE id = ?");
                $stmt -> bind_param('sssisi', $usuario, $nombre, $urlImagen, $estado, $usuarioSesion, $id );
                
            }

        } else {

            $hash_contrasenia = password_hash($contrasenia, PASSWORD_BCRYPT, $opciones);

            //SI SE ACTUALIZA LA CONTRASEÑA
            if( empty($urlImagen) ){
                //No insertaremos  URL de la img

                $stmt = $conn -> prepare("UPDATE ADMINISTRADORES SET usuario = ?, nombre = ?, contrasenia = ?, estado = ?, usuarioModificacion = ?, horaModificacion = CURRENT_TIME(), fechaModificacion = CURRENT_DATE() WHERE id = ?");
                $stmt -> bind_param('sssisi', $usuario, $nombre, $hash_contrasenia, $estado, $usuarioSesion, $id );

            } else {
                //Insertaremos la URL de la img.

                $stmt = $conn -> prepare("UPDATE ADMINISTRADORES SET usuario = ?, nombre = ?, contrasenia = ?, urlImagen = ?, estado = ?, usuarioModificacion = ?, horaModificacion = CURRENT_TIME(), fechaModificacion = CURRENT_DATE() WHERE id = ?");
                $stmt -> bind_param('ssssisi', $usuario, $nombre, $hash_contrasenia, $urlImagen, $estado, $usuarioSesion, $id);

            }

        }


        $stmt -> execute();

        if($stmt -> affected_rows > 0){
            
            $respuesta = array(
                'mensaje' => 'correcto',
                'accion' => $accion,
                'estadoImagen' => $resultadoSubida
            );

        } else {

            $respuesta = array(
                'mensaje' => $stmt -> error
            );
        }

        $stmt -> close();
        $conn -> close();


    } catch( Exception $e){
       
        $respuesta = array(
            'mensaje' => $e -> getMessage()
        );


    }

    die( json_encode($respuesta) );


}





if ( $accion === "eliminar") {

    try {

        $stmt = $conn -> prepare(" DELETE FROM ADMINISTRADORES WHERE id = ?");
        $stmt -> bind_param("i", $id);
        $stmt -> execute();

        if( $stmt -> affected_rows > 0 ){
            $respuesta = array(
                'mensaje' => 'correcto',
                'accion' => $accion, 
                'id_eliminado' => $id
            );
            
        } else {

            $respuesta = array(
                'mensaje' => $stmt->error
            );
        }

        $stmt -> close();
        $conn -> close();    


    } catch(Exception $e) {
        $respuesta = array(
            'mensaje' => $e -> getMessage()
        );
    }


    die (json_encode($respuesta));
}


?>