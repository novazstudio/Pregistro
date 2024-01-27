<?php
$host = "buadsk8r1fzl7mhuddzq-mysql.services.clever-cloud.com";
$usuario = "uxhzzongdcnx8frz";
$contrasena = "pcqZ5XgYVnA1gI5Tv4ru";
$base_datos = "buadsk8r1fzl7mhuddzq";

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = validarEntrada($_POST["nombre"]);
    $correo = validarCorreo($_POST["correo"]);
    $mensaje = validarEntrada($_POST["mensaje"]);

    if (empty($errores)) {
        $query = "INSERT INTO usuarios (nombre, correo, mensaje) VALUES ('$nombre', '$correo', '$mensaje')";

        if ($conexion->query($query) === TRUE) {
            echo "Datos insertados correctamente en la base de datos.";

            // Enviar correo de agradecimiento
            enviarCorreoAgradecimiento($correo);

        } else {
            echo "Error al insertar datos: " . $conexion->error;
        }
    } else {
        echo "Errores de validación:<br>";
        foreach ($errores as $error) {
            echo $error . "<br>";
        }
    }
} else {
    header("Location: index.html");
    exit();
}

$conexion->close();

function validarEntrada($dato) {
    $dato = trim(strip_tags($dato));
    return $dato;
}

function validarCorreo($correo) {
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "Formato de correo electrónico no válido";
    }
    return $correo;
}

function enviarCorreoAgradecimiento($destinatario) {
    $para = $destinatario;
    $asunto = 'Gracias por preinscribirte';
    $mensaje = '¡Gracias por preinscribirte en NovaZ Studio! Estamos emocionados de tenerte a bordo.';
    $cabeceras = 'From: soportenovazstudio@gmail.com';

    mail($para, $asunto, $mensaje, $cabeceras);
    echo 'Correo de agradecimiento enviado correctamente.';
}
?>
