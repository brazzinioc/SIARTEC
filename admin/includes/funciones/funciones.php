<?php 

    require_once 'dbConexion.php';


    
    ###          FUNCIÓN PARA EXTRAEL LA IMAGEN DEL USUARIO QUE ESE ENCUENTRA EN SESIÓN          ###
    ################################################################################################
    function extraeImagenUsuario( $usuario ){
        global $conn;

        try {

            $sql = " SELECT urlImagen FROM ADMINISTRADORES WHERE usuario = '$usuario' ";

            $resultado = $conn -> query( $sql );

            return $resultado;

            $conn -> close();

        } catch (Exception $e){
            echo "Error: " . $e -> getMessage();
            return false;
        }
    }


    ###                         FUNCIÓN PARA EXTRAEL LOS GRADOS                                  ###
    ################################################################################################
    function extraeGrados(){
        global $conn;

        try {

            $sql = " SELECT id AS idGrado, grado FROM GRADO WHERE estado = 1 ";
            
            $resultado = $conn->query($sql);
            
            return $resultado;

            $conn->close();

        } catch(Exception $e){
            echo "Error!: " . $e->getMessage();
            return false;
        }
      
    }



    ###                         FUNCIÓN PARA EXTRAEL LOS SECCIÓN                                 ###
    ################################################################################################
    function extraeSecciones(){
        global $conn;

        try {

            $sql = " SELECT id AS idSeccion, seccion FROM SECCION WHERE estado = 1 ";
            
            $resultado = $conn->query($sql);
            
            return $resultado;

            $conn->close();
            
        } catch(Exception $e){
            echo "Error!: " . $e->getMessage();
            return false;
        }
      
    }


    ###          FUNCIÓN PARA EXTRAEL TIPOS DE USUARIO: Alumno, docente, administrativo          ###
    ################################################################################################
    function extraeTipoUsuario(){
        global $conn;

        try {

            $sql = " SELECT id, tipo FROM TIPO_USUARIO WHERE estado = 1 ";
            
            $resultado = $conn->query($sql);
            
            return $resultado;

            $conn->close();
        } catch(Exception $e){
            echo "Error!: " . $e->getMessage();
            return false;
        }
      
    }


    ###                              FUNCIÓN PARA OFUSCAR DATOS EN URL                           ###
    ################################################################################################
    //Crea una llave. Se genera una cadena de bytes pseudo-aleatoria, el cual es codificada en base64.
    //$key = base64_encode(openssl_random_pseudo_bytes(32));


    function encriptaDato($data) {
         $key = "MKgmos8fAEhqBBPUS0+IX/sDAcL2tPl76N+WLN+DitM=";

        $encryption_key = base64_decode($key);  // Remueve la codificación de base 64 de la llave.
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc')); #Genera un vector de inicialización.
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv); //Encripta la data usando AES 256 en el modo CBC, usando la llave generada y vector de inicialización.
        return base64_encode($encrypted . '::' . $iv); // El $iv es tan importante como la clave para descifrar, así que se guarda con nuestros datos cifrados usando un separador único (::)
    }

    function desencriptaDato($data) {
         $key = "MKgmos8fAEhqBBPUS0+IX/sDAcL2tPl76N+WLN+DitM=";

        $encryption_key = base64_decode($key);  // Remueve la codificación de base 64 de la llave.
        list($encrypted_data, $iv) = explode('::', base64_decode($data), 2); //Para descifrar, se divide los datos cifrados  
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
    }









    ###                              FUNCIONES PARA LISTAR REGISTROS                             ###
    ################################################################################################
    
    function extraeListaAlumnos(){
        global $conn;

        try {
            $sql = " SELECT A.id, A.dni, A.nombres, A.apellidos, B.tipo, A.estado FROM ALUMNO A ";
            $sql .= " INNER JOIN TIPO_USUARIO B ";
            $sql .= " ON A.tipoUsuario = B.id AND A.estado = 1 ";
            $sql .= " ORDER BY A.fechaCreacion ASC";

            $resultado = $conn->query($sql);

            return $resultado;

            $conn->close();
        } catch(Exception $e){
            echo "Error!: " . $e->getMessage();
            return false;
        }
    }



    function extraeListaDocentes(){
        global $conn;

        try {
            $sql = "SELECT A.id, A.dni, A.nombres, A.apellidos, B.tipo, A.especialidad, A.estado ";
            $sql .= " FROM DOCENTE A INNER JOIN TIPO_USUARIO B ";
            $sql .= " ON A.tipoUsuario = B.id ";
            $sql .= " WHERE A.estado = 1 ";
            $sql .= " ORDER BY A.fechaCreacion ASC";

            $resultado = $conn -> query( $sql );

            return $resultado;

            $conn -> close();

        } catch (Exception $e){
            echo "Error: " . $e -> getMessage();
            return false;
        }
    }



    function extraeListaAdministrativo(){
        global $conn;

        try {
            $sql = "SELECT A.id, A.dni, A.nombres, A.apellidos, B.tipo, A.cargo, A.profesion, A.estado ";
            $sql .= " FROM ADMINISTRATIVO A INNER JOIN TIPO_USUARIO B ";
            $sql .= " ON A.tipoUsuario = B.id ";
            $sql .= " WHERE A.estado = 1 ";
            $sql .= " ORDER BY A.fechaCreacion ASC ";

            $resultado = $conn -> query( $sql ); 
            
            return $resultado;

            $conn -> close();

        } catch ( Exception $e ){
            echo "Error: " . $e -> getMessage();
            return false;
        }


    }




    function extraeListaAdministrador(){
        global $conn;

        try {

            $sql = " SELECT id, usuario, nombre, urlImagen, estado ";
            $sql .= " FROM ADMINISTRADORES ";
            $sql .= " WHERE estado = 1 ";
            $sql .= " ORDER BY fechaCreacion ASC ";

            $resultado = $conn -> query( $sql );

            return $resultado;

            $conn -> close();
            
        } catch( Exception $e){
            echo "Error: " . $e -> getMessage();
            return false;
        }

    }



    function extreaListaPrestamo(){
        global $conn;

        try {

            $sql .= " SELECT A.id, A.fecha, A.hora, A.dniUsuario, B.tipo, C.grado,  D.seccion, A.listaEquipos, A.observacion, A.estado, A.estadoDevolucion ";
            $sql .= " FROM PRESTAMO A ";
            $sql .= " INNER JOIN TIPO_USUARIO B ON ";
            $sql .= " A.idTipoUsuario = B.id "; 
            $sql .= " INNER JOIN GRADO C ON ";
            $sql .= " A.idGrado = C.id "; 
            $sql .= " INNER JOIN SECCION D ON  ";
            $sql .= " A.idSeccion = D.id ";
            $sql .= " WHERE A.estadoDevolucion = 0 AND A.estado = 1  ";
            $sql .= " ORDER BY A.fechaCreacion ASC ";


            $resultado = $conn -> query( $sql );

            return $resultado;

            $conn -> close();

        } catch( Exception $e){
            echo "Error: " . $e -> getMessage();
            return false;
        }
    }


    function extraeListaDevolucion(){
        global $conn;

        try {

            $sql = " SELECT A.fecha, A.hora, A.observacion AS obsDevolucion, B.dniUsuario, B.listaEquipos,  ";
            $sql .= " B.observacion AS obsPrestamo, C.grado, D.seccion, E.tipo ";
            $sql .= " FROM DEVOLUCION A ";
            $sql .= " INNER JOIN PRESTAMO B  ";
            $sql .= " ON A.idPrestamo = B.id AND B.estadoDevolucion = 1 ";
            $sql .= " INNER JOIN GRADO C ";
            $sql .= " ON B.idGrado = C.id ";
            $sql .= " INNER JOIN SECCION D ";
            $sql .= " ON B.idSeccion = D.id ";
            $sql .= " INNER JOIN TIPO_USUARIO E ";
            $sql .= " ON B.idTipoUsuario = E.id ";
            $sql .= " ORDER BY A.fechaCreacion DESC ";

            $resultado = $conn -> query( $sql );

            return $resultado;

            $conn -> close();

        } catch(Exception $e) {
            echo "Error: " . $e -> getMessage();
            return false;
        }
    }


    
    ###                       FUNCIONES PARA EXTRAER REGISTROS PARA EDICIÓN                      ###
    ################################################################################################
    function extraeAlumno($id) {
        global $conn;

        try {
            $sql = "SELECT C.id, C.dni, C.nombres, C.apellidos, D.id AS idTipoUsuario, C.estado  FROM ALUMNO C ";
            $sql .= " INNER JOIN TIPO_USUARIO D ";
            $sql .= " ON C.tipoUsuario = D.id ";
            $sql .= " WHERE C.id = {$id} AND C.estado = 1 ";

            $respuesta = $conn->query($sql);

            return $respuesta;
            
            $conn->close();
        } catch (Exception $e){
            echo "Error!: " . $e->getMessage();
            return false;
        }
    }


    function extraeDocente($id){
        global $conn;

        try {

            $sql = " SELECT A.id, A.dni, A.nombres, A.apellidos, B.id AS idTipoUsuario, A.especialidad, A.estado ";
            $sql .= " FROM DOCENTE A INNER JOIN TIPO_USUARIO B ";
            $sql .= " ON A.tipoUsuario = B.id ";
            $sql .= " WHERE A.id = {$id} AND A.estado = 1 ";

            $respuesta = $conn -> query($sql);

            return $respuesta;

            $conn -> close();

        } catch( Exception $e){
            echo "Error: " . $e -> getMessage();
            return false;
        }

    }



    function extraeAdministrativo($id){
        global $conn;

        try {

            $sql = " SELECT A.id, A.dni, A.nombres, A.apellidos, B.id as idTipoUsuario,  A.cargo, A.profesion, A.estado ";
            $sql .= " FROM ADMINISTRATIVO A INNER JOIN TIPO_USUARIO B ";
            $sql .= " ON A.tipoUsuario = B.id ";
            $sql .= " WHERE A.id = {$id} AND A.estado = 1 ";

            $respuesta = $conn -> query($sql);

            return $respuesta;

            $conn -> close();
            
        } catch (Exception $e) {   
            echo "Error: " . $e -> getMessage();
            return false;
        }
    }


    function extraeAdministrador( $id ){
        global $conn;

        try {
            $sql = "SELECT id, usuario, nombre, urlImagen, estado ";
            $sql .= " FROM ADMINISTRADORES ";
            $sql .= " WHERE id= {$id} and estado = 1 ";

            $respuesta = $conn -> query( $sql );

            return $respuesta;

            $conn -> close();
            
        } catch( Exception $e){
            echo "Error: " . $e -> getMessage();
            return false;

        }
    }



    function extraePrestamo( $id ) {
        global $conn;

        try {
            $sql = " SELECT id, fecha, hora, idTipoUsuario, dniUsuario, idGrado, idSeccion, listaEquipos, observacion ";
            $sql .= " FROM PRESTAMO ";
            $sql .= " WHERE id = {$id}  and estado = 1";

            $respuesta = $conn -> query( $sql );

            return $respuesta;

            $conn -> close();

        } catch(Exception $e){
            echo "Error: " . $e -> getMessage();
            return false;
        }
    }






        
    ###                 FUNCIONES PARA EXTRAER CANTIDAD DE REGISTROS PARA EL DASHBOARD           ###
    ################################################################################################
    function cantidadPrestamosDelDia(){
        global $conn;

        try {
            $sql = " SELECT COUNT(*) AS cantidad FROM PRESTAMO WHERE fecha = CURRENT_DATE() ";

            $respuesta = $conn -> query( $sql );

            return $respuesta;

            $conn -> close();

        } catch(Exception $e){
            echo "Error: " . $e -> getMessage();
            return false;
        }   

    }

    function cantidadPrestamosTotal(){
        global $conn;

        try {
            $sql = " SELECT COUNT(*) AS cantidad FROM PRESTAMO ";

            $respuesta = $conn -> query( $sql );

            return $respuesta;

            $conn -> close();

        } catch(Exception $e){
            echo "Error: " . $e -> getMessage();
            return false;
        }   

    }

    function cantidadDevolucionesDelDia(){
        global $conn;

        try {
            $sql = " SELECT COUNT(*) AS cantidad FROM DEVOLUCION WHERE fecha = CURRENT_DATE() ";

            $respuesta = $conn -> query( $sql );

            return $respuesta;

            $conn -> close();

        } catch(Exception $e){
            echo "Error: " . $e -> getMessage();
            return false;
        }   

    }

    function cantidadDevolucionesTotal(){
        global $conn;

        try {
            $sql = " SELECT COUNT(*) AS cantidad FROM DEVOLUCION ";

            $respuesta = $conn -> query( $sql );

            return $respuesta;

            $conn -> close();

        } catch(Exception $e){
            echo "Error: " . $e -> getMessage();
            return false;
        }   

    }

    

    function cantidadAlumnosTotal(){
        global $conn;

        try {

            $sql = " SELECT COUNT(*) AS cantidad FROM ALUMNO ";
            $respuesta = $conn -> query( $sql );

            return $respuesta;

            $conn -> close();

        } catch(Exception $e){
            echo "Error: " . $e -> getMessage();
            return false;
        }
    }



    function cantidadDocentesTotal(){
        global $conn;

        try {

            $sql = " SELECT COUNT(*) AS cantidad FROM DOCENTE ";
            $respuesta = $conn -> query( $sql );

            return $respuesta;

            $conn -> close();

        } catch(Exception $e){
            echo "Error: " . $e -> getMessage();
            return false;
        }
    }


    function cantidadAdministrativosTotal(){
        global $conn;

        try {

            $sql = " SELECT COUNT(*) AS cantidad FROM ADMINISTRATIVO ";
            $respuesta = $conn -> query( $sql );

            return $respuesta;

            $conn -> close();

        } catch(Exception $e){
            echo "Error: " . $e -> getMessage();
            return false;
        }
    }


?>