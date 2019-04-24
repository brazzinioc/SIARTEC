<?php 

    /*  Servicio para extraer la cantidad de préstamos por día, de los últimos 7 días.  */
    
    require_once ('../../../includes/funciones/dbConexion.php');

    try {

        $sql  = " SELECT fecha, COUNT(*) AS resultado ";
        $sql .= " FROM PRESTAMO  ";
        $sql .= " GROUP BY fecha ";
        $sql .= " ORDER BY fecha DESC ";
        $sql .= " LIMIT 7 ";

        $resultado = $conn -> query( $sql );

        $arreglo_registros = array();

        while ( $registro_dia = $resultado -> fetch_assoc() ){
            
            $fecha = $registro_dia['fecha'];
            $registro['fecha'] = $fecha;
            $registro['cantidad'] = $registro_dia['resultado'];

            $arreglo_registros[] = $registro; //Añadimos el arreglo creado al arreglo padre.
        }

        die (json_encode( $arreglo_registros));

    } catch(Exception $e){
        
        die (json_encode( $e -> getMessage()));
    }

?>

