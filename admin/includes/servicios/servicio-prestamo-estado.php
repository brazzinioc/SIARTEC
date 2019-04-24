<?php 

    /* Servicio para extrear la cantidad de pŕestamos por estado del día */

    require_once ('../../../includes/funciones/dbConexion.php');

    try {

        $sql = "SELECT COUNT(*) AS cantidadNoDevueltos FROM PRESTAMO ";
        $sql .= " WHERE estadoDevolucion = 0  ";
        $sql .= " AND fecha = CURRENT_DATE(); ";
        $sql .= "SELECT COUNT(*) AS cantidadDevueltos FROM PRESTAMO ";
        $sql .= " WHERE estadoDevolucion = 1 ";
        $sql .= " AND fecha = CURRENT_DATE(); ";

        $conn -> multi_query( $sql );

        $prestamos = array();
   
        do {
            $resultado = $conn -> store_result();
            //$row = $resultado -> fetch_all(MYSQLI_ASSOC);
            $row = $resultado -> fetch_assoc();

            array_push( $prestamos, $row);

        } while($conn -> more_results() && $conn -> next_result());

        if( $prestamos[0]['cantidadNoDevueltos'] > 0  ||  $prestamos[1]['cantidadDevueltos'] > 0){

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