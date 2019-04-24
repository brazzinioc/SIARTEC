<?php 

    require_once '../../../includes/funciones/dbConexion.php';

    $accion = filter_var($_POST['accion'], FILTER_SANITIZE_STRING);

    $dni = filter_var($_POST['dni'], FILTER_SANITIZE_STRING);
    $nombres = filter_var($_POST['nombres'], FILTER_SANITIZE_STRING);
    $apellidos = filter_var($_POST['apellidos'], FILTER_SANITIZE_STRING);
    $tipoUsuario = filter_var($_POST['tipoUsuario'], FILTER_VALIDATE_INT);
    $cargo = filter_var($_POST['cargo'], FILTER_SANITIZE_STRING);
    $profesion = filter_var($_POST['profesion'], FILTER_SANITIZE_STRING);
    $estado = filter_var($_POST['estado'], FILTER_VALIDATE_INT);
    
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    
    
    session_start();
    $usuarioSesion = $_SESSION['usuario'];


    if($accion === "crear"){

        $stmt = $conn -> prepare(" INSERT INTO ADMINISTRATIVO (dni, nombres, apellidos, tipoUsuario, cargo, profesion, estado, usuarioCreacion,
                                horaCreacion, fechaCreacion, usuarioModificacion, horaModificacion, fechaModificacion )
                                VALUES (? , ?, ?, ?, ?, ?, ?, ?, CURRENT_TIME(), CURRENT_DATE(), ?, CURRENT_TIME(), CURRENT_DATE() )");
        $stmt -> bind_param("sssississ", $dni, $nombres, $apellidos, $tipoUsuario, $cargo, $profesion, $estado, $usuarioSesion, $usuarioSesion);
        $stmt -> execute();

        if($stmt -> affected_rows > 0){
            $respuesta = array(
                'mensaje' => 'correcto',
                'accion' => $accion
            );

        } else if( $stmt -> error){
            $respuesta = array(
                'mensaje' => 'El DNI ingresado ya ha sido registrado'
            );

        } else {
            $respuesta = array(
                'mensaje' => $stmt -> error
            );
        }

        $stmt -> close();
        $conn -> close();

        echo (json_encode($respuesta));

    }




    if($accion === "actualizar"){
        
        try {

            $stmt = $conn -> prepare(" UPDATE ADMINISTRATIVO SET dni = ?, nombres = ?, apellidos = ?, tipoUsuario = ?, cargo = ?,
                                    profesion = ?, estado = ?, usuarioModificacion = ?, horaModificacion = CURRENT_TIME(), fechaModificacion = CURRENT_DATE() 
                                    WHERE id = ?");

            $stmt -> bind_param("sssissisi", $dni, $nombres, $apellidos, $tipoUsuario, $cargo, $profesion, $estado, $usuarioSesion, $id);
            $stmt -> execute();

            if($stmt -> affected_rows > 0){
                $respuesta = array(
                    'mensaje' => 'correcto',
                    'accion' => $accion
                );

            } else {
                $respuesta = array(
                    'mensaje' => $stmt -> error
                );
            }

            $stmt -> close();
            $conn -> close();

        } catch( Exception $e ) {
            $respuesta = array(
                'mensaje' => $e -> getMessage()
            );

        }
        
        
        die(json_encode($respuesta));
        
    }




    if($accion === "eliminar"){

        try {

            $stmt = $conn -> prepare(" DELETE FROM ADMINISTRATIVO WHERE id = ?");
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

        die(json_encode($respuesta));
    }




?>