<?php
session_start();

// Si el usuario no está autenticado, redirige a la página de inicio
if (!isset($_SESSION["user"])) {
    header("Location: ./");
    exit();
}

if (isset($_GET["idbixo"])) {

    $bixo = $_GET["idbixo"];

    $sql = "SELECT h.*
    FROM habilidad h
    LEFT JOIN bixo_habs bh ON h.idhab = bh.idhab
    LEFT JOIN bixo b ON bh.idbixo = b.idbixo
    WHERE (b.idbixo IS NULL OR b.idbixo != $bixo) AND h.habtipo = 1";

} elseif (isset($_GET["idplanta"])) {

    $planta = $_GET["idplanta"];

    $sql = "SELECT h.*
    FROM habilidad h
    LEFT JOIN planta_habs ph ON h.idhab = ph.idhab
    LEFT JOIN planta p ON ph.idplanta = p.idplanta
    WHERE (p.idplanta IS NULL OR p.idplanta != $planta) AND h.habtipo = 0";
    
} else {
    header("Location: ./");
    exit();
}


include("conexion.php"); // Incluye el archivo de conexión a la base de datos

$stmt = $conexion->prepare($sql);
$stmt->execute();
$habilidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("./templates/header.php") ?>

<h2>Habilidades</h2>

<div>
    <?php foreach ($habilidades as $habilidad) : ?>
        <div class="bixo">
            <span><?php echo $habilidad['habname']; ?></span>

            <img src="assets/img/<?php echo $habilidad['habimg']; ?>.png" alt="Pescar" width="50px" height="50px">

            <span><?php echo $habilidad['habdescrip']; ?></span>

            <span><?php echo $habilidad['habcoste']; ?></span>
        </div>
    <?php endforeach; ?>
</div>