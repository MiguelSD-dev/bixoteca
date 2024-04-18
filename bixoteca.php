<?php
session_start();

// Si el usuario no está autenticado, redirige a la página de inicio
if (!isset($_SESSION["user"])) {
    header("Location: ./");
    exit();
}

// Lógica para obtener y mostrar los bixos y plantas del usuario
$user_bixos = obtener_bixos_del_usuario($_SESSION["iduser"]);
$user_plantas = obtener_plantas_del_usuario($_SESSION["iduser"]);

// Función para obtener los bixos del usuario
function obtener_bixos_del_usuario($usuario_id)
{

    include("conexion.php"); // Incluye el archivo de conexión a la base de datos

    $sql = "SELECT * FROM bixo WHERE user_iduser = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$usuario_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener las plantas del usuario
function obtener_plantas_del_usuario($usuario_id)
{

    include("conexion.php"); // Incluye el archivo de conexión a la base de datos

    $sql = "SELECT * FROM planta WHERE user_iduser = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$usuario_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


?>

<?php include("./templates/header.php") ?>

<h2>Tus Bixos</h2>
<div class="bixos">
    <?php foreach ($user_bixos as $bixo) : ?>
        <div class="bixo">
            <span><?php echo $bixo['bixoname']; ?></span>
            <a href="perfil_bixo.php">
                <img src="assets/img/bixo.png" alt="Bixo" width="50px" height="50px">
            </a>
            <span><?php echo $bixo['puntosevo']; ?></span>
        </div>
    <?php endforeach; ?>
</div>

<h2>Tus Plantas</h2>
<div class="plantas">
    <?php foreach ($user_plantas as $planta) : ?>
        <div class="planta">
            <span><?php echo $planta['plantaname']; ?></span>
            <a href="perfil_planta.php">
                <img src="assets/img/planta.png" alt="Planta" width="50px" height="50px">
            </a>
            <span><?php echo $planta['puntosevo']; ?></span>
        </div>
    <?php endforeach; ?>
</div>

<form action="creabixo.php" method="post">
    <button type="submit">Crea nuevo bixo</button>
</form>

<?php include("./templates/footer.php") ?>