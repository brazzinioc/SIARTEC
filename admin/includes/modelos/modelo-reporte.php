<?php

    
    require_once '../../../includes/funciones/dbConexion.php';


    $fechaInicio = filter_var( $_POST['fechaInicio'], FILTER_SANITIZE_STRING);
    $fechaFin = filter_var( $_POST['fechaFin'], FILTER_SANITIZE_STRING);
    $filtro = filter_var( $_POST['filtro'], FILTER_VALIDATE_INT);

    $fecha = date('Y-m-d');

    switch( $filtro ){

        case 1:
            /* Préstamos devueltos de Alumnos. TipoUsuario: 1.*/
            $sql = "
                    SELECT A.fecha AS fechaPrestamo, A.hora AS horaPrestamo, D.dni, D.nombres, D.apellidos, 
                    B.grado, C.seccion,
                    A.listaEquipos, A.observacion AS observacionPrestamo,
                    E.fecha AS fechaDevolucion, E.hora AS horaDevolucion, E.observacion AS observacionDevolucion
                    FROM PRESTAMO A
                    INNER JOIN GRADO B ON A.idGrado = B.id
                    INNER JOIN SECCION C ON A.idSeccion = C.id
                    INNER JOIN ALUMNO D ON D.dni = A.dniUsuario
                    INNER JOIN DEVOLUCION E ON E.idPrestamo = A.id
                    WHERE A.idTipoUsuario = 1 AND A.fecha BETWEEN '$fechaInicio' AND '$fechaFin' AND A.estadoDevolucion = 1 AND A.estado = 1 ";
            $nombreReporte = "Prestamos_Devueltos_Alumnos_$fecha"; 
        break;


        case 2:
            /* Préstamo y devolucion de Docentes. Tipo Usuario: 2 */
            $sql = " 
                    SELECT A.fecha AS fechaPrestamo, A.hora AS horaPrestamo, D.dni, D.nombres, D.apellidos, 
                    B.grado, C.seccion,
                    A.listaEquipos, A.observacion AS observacionPrestamo,
                    E.fecha AS fechaDevolucion, E.hora AS horaDevolucion, E.observacion AS observacionDevolucion
                    FROM PRESTAMO A
                    INNER JOIN GRADO B ON A.idGrado = B.id
                    INNER JOIN SECCION C ON A.idSeccion = C.id
                    INNER JOIN DOCENTE D ON D.dni = A.dniUsuario
                    INNER JOIN DEVOLUCION E ON E.idPrestamo = A.id
                    WHERE A.idTipoUsuario = 2 AND A.fecha BETWEEN '$fechaInicio' AND '$fechaFin' AND A.estadoDevolucion = 1 AND A.estado = 1 ";
            $nombreReporte = "Prestamos_Devueltos_Docentes_$fecha";
        break;


        case 3:
            /* Préstamo y devolucion de Administrativos. Tipo Usuario: 3 */
            $sql = " 
                    SELECT A.fecha AS fechaPrestamo, A.hora AS horaPrestamo, D.dni, D.nombres, D.apellidos, 
                    B.grado, C.seccion,
                    A.listaEquipos, A.observacion AS observacionPrestamo,
                    E.fecha AS fechaDevolucion, E.hora AS horaDevolucion, E.observacion AS observacionDevolucion
                    FROM PRESTAMO A
                    INNER JOIN GRADO B ON A.idGrado = B.id
                    INNER JOIN SECCION C ON A.idSeccion = C.id
                    INNER JOIN ADMINISTRATIVO D ON D.dni = A.dniUsuario
                    INNER JOIN DEVOLUCION E ON E.idPrestamo = A.id
                    WHERE A.idTipoUsuario = 3 AND A.fecha BETWEEN '$fechaInicio' AND '$fechaFin' AND A.estadoDevolucion = 1 AND A.estado = 1 ";
            $nombreReporte = "Prestamos_Devueltos_Administrativos_$fecha";
        break;


        case 4:
            /* Consulta de prestamos no devueltos. */
            $sql = "
                    SELECT A.fecha AS fechaPrestamo, A.hora AS horaPrestamo, A.dniUsuario,
                    CASE  
                        WHEN A.idTipoUsuario = 1 THEN 'Alumno'
                        WHEN A.idTipoUsuario = 2 THEN 'Docente'
                    ELSE 'Administrativo'
                    END AS 'tipoUsuario',
                    B.grado, C.seccion,
                    A.listaEquipos, A.observacion AS observacionPrestamo
                    FROM PRESTAMO A
                    INNER JOIN GRADO B ON A.idGrado = B.id
                    INNER JOIN SECCION C ON A.idSeccion = C.id
                    WHERE A.estadoDevolucion = 0 AND A.fecha BETWEEN '$fechaInicio' AND '$fechaFin' AND A.estado = 1 ";
            $nombreReporte = "Prestamos_No_Devueltos_$fecha";

        break;

    } //Fin de Switch


    try {

        $stmt = $conn -> prepare( $sql );
        $stmt -> bind_param();
        $stmt -> execute();

        $resultado = $stmt -> get_result(); //Obtenemos los resultados.

        if( $resultado->num_rows > 0 ){

            $respuesta = array(
                'mensaje' => "correcto"
            );

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="Reporte_' . $nombreReporte . '.xls"');
            header('Pragma: no-cache');
            header('Expires: 0');

            if( $filtro === 1 || $filtro === 2 || $filtro === 3 ){
                generaReporteAlumnoDocenteAdministrativo($resultado, $nombreReporte);
            }
           
            if( $filtro === 4){
                generaReportePrestamosPorDevolver($resultado, $nombreReporte);
            }


        } else {
            $respuesta = array(
                'mensaje' => "error"
            );

            header("Location: ../../reporte-excel.php?respuesta={$respuesta['mensaje']}");
          
        }



        $stmt -> close();
        $conn -> close();


    } catch (Exception $e){

        $respuesta = array(
            'mensaje' => $e -> getMessage()
        );

    }





    function generaReporteAlumnoDocenteAdministrativo( $resultado, $nombreReporte){

        $salida = '';

        $salida .= "
        <html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns=\"http://www.w3.org/TR/REC-html40\">
        <html>
            <head><meta http-equiv=\"Content-type\" content=\"text/html;charset=utf-8\" /></head>
            <body>
        ";

        $salida .= '
            <table>
                <thead>
                    <th>N°</th>
                    <th>Fecha Préstamo</th>
                    <th>Hora Préstamo</th>
                    <th>DNI</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Grado</th>
                    <th>Sección</th>
                    <th>Lista de Equipos</th>
                    <th>Observación de Préstamos</th>
                    <th>Fecha Devolución</th>
                    <th>Hora Devolución</th>
                    <th>Observación de Devolución</th>
                </thead>
                <tbody>';
                
                $numero = 1;
    
                while($registro = $resultado -> fetch_assoc()){

                    $salida .= '
                    <tr>
                        <td> ' . $numero . ' </td>
                        <td> ' . $registro["fechaPrestamo"] . ' </td>
                        <td> ' . $registro["horaPrestamo"] . ' </td>
                        <td> ' . $registro["dni"] . ' </td>
                        <td> ' . $registro["nombres"] . ' </td>
                        <td> ' . $registro["apellidos"] . ' </td>
                        <td> ' . $registro["grado"] . ' </td>
                        <td> ' . $registro["seccion"] . ' </td>
                        <td> ' . $registro["listaEquipos"] . ' </td>
                        <td> ' . $registro["observacionPrestamo"] . ' </td>
                        <td> ' . $registro["fechaDevolucion"] . ' </td>
                        <td> ' . $registro["horaDevolucion"] . ' </td>
                        <td> ' . $registro["observacionDevolucion"].' </td>   
                    </tr> ';

                    $numero++; 

                }

        $salida .= '
                </tbody>
            </table> ';

            echo $salida;

    } //Fin función.





    function generaReportePrestamosPorDevolver( $resultado, $nombreReporte){

        $salida = '';

        $salida .= "
        <html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns=\"http://www.w3.org/TR/REC-html40\">
        <html>
            <head><meta http-equiv=\"Content-type\" content=\"text/html;charset=utf-8\" /></head>
            <body>
        ";

        $salida .= '
            <table>
                <thead>
                    <th>N°</th>
                    <th>Fecha Préstamo</th>
                    <th>Hora Préstamo</th>
                    <th>DNI</th>
                    <th>Tipo Usuario</th>
                    <th>Grado</th>
                    <th>Sección</th>
                    <th>Lista de Equipos</th>
                    <th>Observación de Préstamos</th>
                </thead>
                <tbody>';
                
                $numero = 1;
    
                while($registro = $resultado -> fetch_assoc()){

                    $salida .= '
                    <tr>
                        <td> ' . $numero . ' </td>
                        <td> ' . $registro["fechaPrestamo"] . ' </td>
                        <td> ' . $registro["horaPrestamo"] . ' </td>
                        <td> ' . $registro["dniUsuario"] . ' </td>
                        <td> ' . $registro["tipoUsuario"] . ' </td>
                        <td> ' . $registro["grado"] . ' </td>
                        <td> ' . $registro["seccion"] . ' </td>
                        <td> ' . $registro["listaEquipos"] . ' </td>
                        <td> ' . $registro["observacionPrestamo"] . ' </td>
                    </tr> ';

                    $numero++; 

                }

        $salida .= '
                </tbody>
            </table> ';

            echo $salida;

    }



        
    
?>