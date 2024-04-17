<?php
// Información de conexión
$host = 'localhost'; // o la dirección IP del servidor de la base de datos
$dbname = 'task'; // nombre de la base de datos
$username = 'root'; // nombre de usuario de la base de datos
$password = '1234'; // contraseña de la base de datos

try {
    // Conexión a la base de datos usando PDO
    $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Configurar PDO para que lance excepciones en caso de errores
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /*
    echo "Conexión exitosa a la base de datos";

    // Aquí puedes ejecutar consultas y otras operaciones en la base de datos
    $user = "admin@admin.es";
    $pass = "1234";
    $sql = "select * from user where username=? and password=?";
    $stmt = $conexion->prepare($sql);

    // Vincular parámetros
    $stmt->bindParam(1,$user);
    $stmt->bindParam(2,$pass);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener resultados
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($result);
    exit();
    */

} catch (PDOException $e) {
    // En caso de error, mostrar mensaje de error
    echo "Error de conexión: " . $e->getMessage();
}
?>
