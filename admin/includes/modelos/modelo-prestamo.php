<?php
    
    require_once '../../../includes/funciones/dbConexion.php';

    $accion = filter_var( $_POST['accion'], FILTER_SANITIZE_STRING);
    $tipoUsuario = filter_var( $_POST['tipoUsuario'], FILTER_VALIDATE_INT);
    $dniUsuario = filter_var( $_POST['dniUsuario'], FILTER_SANITIZE_STRING); //Enviado desde admin-ajax para búsqueda


    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $dni = filter_var($_POST['dni'], FILTER_SANITIZE_STRING);
    $grado = filter_var( $_POST['grado'], FILTER_VALIDATE_INT);
    $seccion = filter_var( $_POST['seccion'], FILTER_SANITIZE_STRING);
    $listaEquipos= filter_var( $_POST['listaEquipos'], FILTER_SANITIZE_STRING);
    $observacion  = filter_var( $_POST['observacion'], FILTER_SANITIZE_STRING);
    $estado = filter_var( $_POST['estado'], FILTER_VALIDATE_INT);

    $id = filter_var( $_POST['id'], FILTER_VALIDATE_INT); //Id préstamo

    //Observación enviado desde admin-ajax
    $observacion_devolucion = filter_var( $_POST['observacion_devolucion'], FILTER_SANITIZE_STRING);

    session_start();
    $usuarioSesion = $_SESSION['usuario'];


    if( $accion === "buscar_dni"){

        switch( $tipoUsuario ){
    
            //Cuando el tipo de usuario sea Alumno
            case $tipoUsuario === 1:
                $sql = " SELECT COUNT(*) FROM ALUMNO WHERE dni = ? ";
                break;

            //Cuando el tipo de usuario sea Docente.
            case $tipoUsuario === 2:
                $sql = " SELECT COUNT(*) FROM DOCENTE WHERE dni = ? ";
                break;
                
            //Cuando el tipo de usuario sea Administrativo
            case $tipoUsuario === 3;
                $sql = " SELECT COUNT(*) FROM ADMINISTRATIVO WHERE dni = ? ";
                break;

        }

        try {

            $stmt = $conn -> prepare( $sql );
            $stmt -> bind_param('s', $dniUsuario);
            $stmt -> execute();

            $stmt -> store_result();

            $stmt -> bind_result($cantidad);
            $stmt -> fetch();


            if( $cantidad == 1){
                
                $respuesta = array(
                    'resultadoBusqueda' => TRUE,
                    'accion' => $accion
                );

            } else {
                                
                $respuesta = array(
                    'resultadoBusqueda' => FALSE,
                    'accion' => $accion
                );
            }

            $stmt -> close();
            $conn -> close();

        } catch( Exception $e){

            $respuesta = array(
                'mensaje' => $e -> getMessage()
            );

        }


        die (json_encode($respuesta));
    }






    if($accion === "crear"){

        $sql = " INSERT INTO PRESTAMO (fecha, hora, dniUsuario, idTipoUsuario, idGrado, idSeccion, listaEquipos, observacion, estadoDevolucion, estado, usuarioCreacion, horaCreacion, "; 
        $sql .= " fechaCreacion, usuarioModificacion, horaModificacion, fechaModificacion) ";
        $sql .= " VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, ?, ?, CURRENT_TIME(), CURRENT_DATE(), ?, CURRENT_TIME(), CURRENT_DATE() ) ";


        try {

            $stmt = $conn -> prepare($sql);
            $stmt -> bind_param('sssiiississ', $fecha, $hora, $dni, $tipoUsuario, $grado, $seccion, $listaEquipos, $observacion, $estado, $usuarioSesion, $usuarioSesion);
            $stmt -> execute();

            if($stmt -> affected_rows > 0) {
                
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


        } catch (Exception $e){

            $respuesta =  array(
                'mensaje' => $e -> getMessage()
            );

        }

        die(json_encode($respuesta));

    }






    if( $accion === "actualizar"){

        try {
            $stmt = $conn -> prepare(" UPDATE PRESTAMO SET fecha = ?, hora = ?, dniUsuario = ?, idTipoUsuario = ?, idGrado = ?, idSeccion = ?, listaEquipos = ?, observacion = ?, 
                                    estado = ?, usuarioModificacion = ?, horaModificacion = CURRENT_TIME(), fechaCreacion = CURRENT_DATE() WHERE id = ?");
            $stmt -> bind_param('sssiiissisi', $fecha, $hora, $dni, $tipoUsuario, $grado, $seccion, $listaEquipos, $observacion, $estado, $usuarioSesion, $id);
            
            $stmt -> execute();

            if( $stmt -> affected_rows > 0){
                
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

        } catch (Exception $e){
            $respuesta = array(
                'mensaje' => $e -> getMessage()
            );
        }


        die (json_encode($respuesta));

    }





    if( $accion === "eliminar"){

        try {

            $stmt = $conn -> prepare(" DELETE FROM PRESTAMO WHERE id = ? ");
            
            $stmt -> bind_param('i', $id);
            $stmt -> execute();

            if($stmt -> affected_rows > 0){
            
                $respuesta = array(
                    'mensaje' => 'correcto',
                    'accion' => $accion,
                    'id_eliminado' => $id
                );
    
            } else {
                $repuesta = array(
                    'mensaje' => $stmt -> error
                );
            }
    
            $stmt -> close();
            $conn -> close();

        } catch (Exception $e){
            $respuesta = array(
                'mensaje' => $e -> getMessage()
            );
        }

        die(json_encode($respuesta));

    }




    if( $accion === "devolver"){


        try {

            // Inserciión a la la tabla DEVOLUCION.
            $stmt = $conn -> prepare(" INSERT INTO DEVOLUCION ( idPrestamo, fecha, hora, observacion, estado, usuarioCreacion,
                                    horaCreacion, fechaCreacion, usuarioModificacion, horaModificacion, fechaModificacion) 
                                    VALUES ( ?, CURRENT_DATE(), CURRENT_TIME(), ?, 1, ?, CURRENT_TIME(), CURRENT_DATE(), ?, CURRENT_TIME(), CURRENT_DATE() )");

            $stmt -> bind_param('isss', $id, $observacion_devolucion, $usuarioSesion, $usuarioSesion );
            $stmt -> execute();


            if($stmt -> affected_rows > 0){
            
                $respuesta = array(
                    'mensaje' => 'correcto',
                    'accion' => $accion,
                    'id_eliminado' => $id
                );
    
            } else {
                $repuesta = array(
                    'mensaje' => $stmt -> error
                );
            }
    
            $stmt -> close();
            //$conn -> close();


            // Actualización del campo EstadoDevolucion del préstamo al registro en la tabla PRESTAMO.
            $stmt_update = $conn -> prepare(" UPDATE PRESTAMO SET estadoDevolucion = 1, usuarioModificacion = ?, horaModificacion = CURRENT_TIME(), fechaModificacion = CURRENT_DATE() WHERE id = ? ");
            $stmt_update -> bind_param('si', $usuarioSesion, $id);
            $stmt_update -> execute();
                                        

            $stmt_update -> close();
            $conn -> close();

        } catch( Exception $e){

            $respuesta = array(
                'mensaje' => $e -> getMessage()
            );
        }

        die( json_encode($respuesta));
    }


















?>