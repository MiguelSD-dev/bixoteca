<?php
session_start();
if (isset($_POST["bixoname"])) {
    include("conexion.php");

    $bixoname = $_POST["bixoname"];
    $iduser=$_SESSION["iduser"];

    if (isset($_POST["submit_bixo"])) {
        $sql = "insert into bixo (bixoname,user_iduser) values (?,?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(1, $bixoname);
        $stmt->bindParam(2, $iduser);
    } elseif (isset($_POST["submit_planta"])) {
        $sql = "insert into planta (plantaname,user_iduser) values (?,?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(1, $bixoname);
        $stmt->bindParam(2, $iduser);
    }


    try {
       
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            header("Location: ./bixoteca.php");
            exit();
        } else {
            $error = "No se ha podido realizar el registro";
        }
    } catch (PDOException $e) {
        echo "No se ha podido crear el bixo" .$e;
    }
}

?>

<?php include("./templates/header.php") ?>

<form action="" method="post">
    <p>Create your bixo</p>

    <div class="text-center pt-1 mb-5 pb-1">
        <input data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="checkbox" name="submit_bixo">Bixo</input>
    </div>

    <div class="text-center pt-1 mb-5 pb-1">
        <input data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="checkbox" name="submit_planta">Planta</input>
    </div>

    <div data-mdb-input-init class="form-outline mb-4">
        <input type="text" name="bixoname" id="bixoname" class="form-control" placeholder="Nombre" required />
        <label class="form-label" for="bixoname">Nombre</label>
    </div>

    <div class="text-center pt-1 mb-5 pb-1">
        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" id="btnRegister">Register</button>
    </div>

</form>

<?php include("./templates/footer.php") ?>