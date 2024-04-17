<?php
// Información de conexión
$host = 'localhost'; // o la dirección IP del servidor de la base de datos
$dbname = 'bixoteca'; // nombre de la base de datos
$username = 'root'; // nombre de usuario de la base de datos
$password = '1234'; // contraseña de la base de datos

try {
    // Conexión a la base de datos usando PDO
    $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Configurar PDO para que lance excepciones en caso de errores
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // En caso de error, mostrar mensaje de error
    echo "Error de conexión: " . $e->getMessage();
}
?>
