<?php
session_start();

// Si el usuario no está autenticado, redirige a la página de inicio
if (!isset($_SESSION["user"])) {
    header("Location: ./");
    exit();
}
if(!isset($_GET["idbixo"])){
    header("Location: ./");
    exit();
}

include("conexion.php"); // Incluye el archivo de conexión a la base de datos

$iduser = $_SESSION["iduser"];
$idbixo = $_GET["idbixo"];
$sql = "SELECT * FROM bixo WHERE user_iduser = ? AND idbixo = ?";
//SELECT b.*,h.* 
//FROM bixo as b
//left join bixo_habs as bh on b.idbixo=bh.idbixo
//left join habilidad as h on h.idhab=bh.idhab
//WHERE b.idbixo = 1 and b.user_iduser=1

$stmt = $conexion->prepare($sql);
$stmt->bindParam(1, $iduser);
$stmt->bindParam(2, $idbixo);
$stmt->execute();
$bixo=$stmt->fetchAll(PDO::FETCH_ASSOC)[0];
?>




<span><?php echo $bixo["bixoname"]; ?></span>



<span><?php echo $bixo["ataque"] + $bixo["habataque"]; ?></span>

<span><?php echo $bixo["defensa"]; ?></span>

<span><?php echo $bixo["instinto"]; ?></span>

<span><?php echo $bixo["poblacion"]; ?></span>

<span><?php echo $bixo["puntosevo"]; ?></span>


<!-- Aqui tabla combinada de habilidades con un for each y dibujitos -->





