<?php 

    require_once 'dbConexion.php';

    ###          FUNCIÓN PARA EXTRAEL TIPOS DE USUARIO: Alumno, docente, administrativo          ###
    ################################################################################################
    function extraeTipoUsuario(){
        global $conn;

        try {

            $sql = " SELECT `id`, `tipo` FROM `TIPO_USUARIO` WHERE `estado` = 1 ";
            //$resultado = $conn->query($sql);
            
            return $conn -> query($sql);

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
            $sql = " SELECT A.dni, A.nombres, A.apellidos, B.tipo, A.estado FROM ALUMNO A ";
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










    
    ###                       FUNCIONES PARA EXTRAER REGISTROS PARA EDICIÓN                      ###
    ################################################################################################
    function extraeAlumno(&$dni) {
        global $conn;

        try {
            $sql = "SELECT C.dni, C.nombres, C.apellidos, D.id, C.estado  FROM ALUMNO C ";
            $sql .= " INNER JOIN TIPO_USUARIO D ";
            $sql .= " ON C.tipoUsuario = D.id ";
            $sql .= " WHERE C.dni = '{$dni}' AND C.estado = 1 ";

            $respuesta = $conn->query($sql);

            return $respuesta;
            
            $conn->close();
        } catch (Exception $e){
            echo "Error!: " . $e->getMessage();
            return false;
        }
    }



?>