<?php 

    /* Servicio para extrear la cantidad TOTAL de pŕestamos por cada TIPO USUARIO  */

    require_once ('../../../includes/funciones/dbConexion.php');

    try {

        $sql .= "SELECT COUNT(*) AS cantidadPrestamoAlumno FROM PRESTAMO  ";
        $sql .= "WHERE idTipoUsuario = 1; ";
        $sql .= "SELECT COUNT(*) AS cantidadPrestamoDocente FROM PRESTAMO  ";
        $sql .= "WHERE idTipoUsuario = 2; ";
        $sql .= "SELECT COUNT(*) AS cantidadPrestamoAdministrativo FROM PRESTAMO  ";
        $sql .= "WHERE idTipoUsuario = 3; ";

        $conn -> multi_query( $sql );

        $prestamos = array();

        do {
            $resultado = $conn -> store_result();
            $row = $resultado -> fetch_assoc();

            array_push( $prestamos, $row);

        } while( $conn -> more_results() && $conn -> next_result() );


        if( $prestamos[0]['cantidadPrestamoAlumno'] > 0 ||  $prestamos[1]['cantidadPrestamoDocente'] || $prestamos[2]['cantidadPrestamoAdministrativo'] ){

            die (json_encode( $prestamos));

        } else {
            $respuesta = array(
                'datos' => '0'
            );

            die (json_encode( $respuesta ));
        }
        
    } catch( Exception $e){

        die (json_encode( $es -> getMessage()));
    }


?>