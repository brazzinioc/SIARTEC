<?php  

    define('DB_HOSTNAME', 'localhost');
    define('DB_NAME', 'SIARTEC');
    define('DB_USERNAME', 'test');
    define('DB_PASSWORD', 'test');

    $conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

    //Prueba de conexión
    //echo $conn->ping();

    if($conn->connect_error){ //Si existe un error en la conexión.
        echo $conn->connect_error;
    }

    //Los resultados de la BD se vean los ñ y tildes.
    $conn->set_charset("utf8");
?>