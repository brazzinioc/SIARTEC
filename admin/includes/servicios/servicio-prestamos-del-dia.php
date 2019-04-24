<?php 

    /* Servicio para extrear la cantidad de pŕestamos del día, por cada tipo de Usuario */

    require_once ('../../../includes/funciones/dbConexion.php');

    try {

        $sql = " SELECT idTipoUsuario, TIPO_USUARIO.tipo AS tipoUsuario, COUNT(*) AS cantidad FROM PRESTAMO ";
        $sql .= " INNER JOIN TIPO_USUARIO ";
        $sql .= " ON PRESTAMO.idTipoUsuario = TIPO_USUARIO.id ";
        $sql .= " WHERE PRESTAMO.fecha = CURRENT_DATE() ";
        $sql .= " GROUP BY idTipoUsuario ";
        $sql .= " ORDER BY idTipoUsuario ASC ";

        $resultado = $conn -> query( $sql );

        $arreglo_registros = array();

        while( $prestamos = $resultado -> fetch_assoc()){
            
            $tipoUsuario = $prestamos['tipoUsuario'];
            $cantidad = $prestamos['cantidad'];

            $registro['tipoUsuario'] = $tipoUsuario;
            $registro['cantidad'] = $cantidad;

            $arreglo_registros[] = $registro;

        }

        if( count($arreglo_registros) > 0){

            die ( json_encode( $arreglo_registros));

        } else {
            $respuesta = array(
                'datos' => '0'
            );

            die (json_encode( $respuesta ));
        }

    } catch( Exception $e){

        die (json_encode( $e -> getMessage()));
    }


?>