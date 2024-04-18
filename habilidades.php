<?php
session_start();

// Si el usuario no está autenticado, redirige a la página de inicio
if (!isset($_SESSION["user"])) {
    header("Location: ./");
    exit();
}

    include("conexion.php"); // Incluye el archivo de conexión a la base de datos

    $sql = "SELECT * FROM habilidad WHERE habtipo = 1";
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
            
            <img src="assets/img/pescar.png" alt="Pescar" width="50px" height="50px">
            
            <span><?php echo $habilidad['habdescrip']; ?></span>

            <span><?php echo $habilidad['habcoste']; ?></span>
        </div>
    <?php endforeach; ?>
</div>