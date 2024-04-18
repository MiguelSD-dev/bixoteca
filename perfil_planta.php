<?php
session_start();

// Si el usuario no está autenticado, redirige a la página de inicio
if (!isset($_SESSION["user"])) {
    header("Location: ./");
    exit();
}
if (!isset($_GET["idplanta"])) {
    header("Location: ./");
    exit();
}

include("conexion.php"); // Incluye el archivo de conexión a la base de datos

$iduser = $_SESSION["iduser"];
$idplanta = $_GET["idplanta"];
$sql = "SELECT * FROM planta WHERE user_iduser = ? AND idplanta = ?";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(1, $iduser);
$stmt->bindParam(2, $idplanta);
$stmt->execute();
$planta = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<span><?php echo $planta["plantaname"]; ?></span>
<span><?php echo $planta["ataque"]; ?></span>
<span><?php echo $planta["defensa"]; ?></span>
<span><?php echo $planta["instinto"]; ?></span>
<span><?php echo $planta["poblacion"]; ?></span>
<span><?php echo $planta["puntosevo"]; ?></span>

<!-- Aquí se mostrarán las habilidades asociadas a la planta -->
<h2>Habilidades de la Planta</h2>
<?php
$sql = "SELECT habilidad.habname, habilidad.habimg, habilidad.habdescrip, habilidad.habpuntos 
        FROM habilidad 
        INNER JOIN planta_habs ON habilidad.idhab = planta_habs.idhab 
        WHERE planta_habs.idplanta = ?";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(1, $idplanta);
$stmt->execute();
$habilidades = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($habilidades as $habilidad) {
    echo "<div class='habilidad'>";
    echo "<img src='" . $habilidad['habimg'] . "' alt='" . $habilidad['habname'] . "' width='50px' height='50px'>";
    echo "<span>" . $habilidad['habname'] . "</span>";
    echo "<span>" . $habilidad['habdescrip'] . "</span>";
    echo "<span>" . $habilidad['habpuntos'] . "</span>";
    echo "</div>";
}
?>
