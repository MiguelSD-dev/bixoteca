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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/bixoteca.css" />
</head>

<body>
    <header>
        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-md-6 logo d-flex align-items-center">
                <a href="bixoteca.php">
                        <img src="assets/img/logo.png" class="img-fluid rounded-start" alt="logo">
                    </a>
                </div>
                <div class="col-md-6 titulo d-flex align-items-center">
                    <div class="ms-md-auto">
                        <h5 class="card-title">EVOLUCIONA!!</h5>
                        <p class="card-text">El juego más adictivo que hayas conocido</p>
                    </div>
                    <button class="star-button">&#9733;<span class="info-text"><a href="userdata.php">INFO</a></span></button>

                </div>
            </div>
        </div>
    </header>

    <div class="container text-center mt-5">

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
    </div>

    <?php include("./templates/footer.php") ?>