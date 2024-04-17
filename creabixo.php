<?php
if (isset($_POST["user"])) {
    include("conexion.php");

    $bixoname = $_POST["bixoname"];
    $plantaname = $_POST["plantaname"];

    if (isset($_POST["submit_bixo"])) {
        $sql = "insert into bixo (bixoname) values (?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(1, $bixoname);
    } elseif (isset($_POST["submit_planta"])) {
        $sql = "insert into planta (plantaname) values (?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(1, $plantaname);
    }

    try {
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            header("Location: ./");
            exit();
        } else {
            $error = "No se ha podido realizar el registro";
        }
    } catch (PDOException $e) {
        // En caso de error, mostrar mensaje de error
        echo "No se ha podido crear el bixo";
    }
}

?>

<?php include("./templates/header.php") ?>

<section>
    <h1>CREABIXO</h1>
</section>

<?php include("./templates/footer.php") ?>