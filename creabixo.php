<?php
session_start(); //Tenemos que iniciar sesion en todas las paginas menos en login y en register

if (!isset($_SESSION["user"])) {
    header("Location: ./");
}

if (isset($_POST["bixoname"])) {
    include("conexion.php");

    $bixoname = $_POST["bixoname"];
    $iduser = $_SESSION["iduser"];

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
        echo "No se ha podido crear el bixo" . $e;
    }
}

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
                    <button class="star-button">&#9733;<span class="info-text">INFO</span></button>

                </div>
            </div>
        </div>
    </header>

    <div class="container text-center mt-5">

        <form action="" method="post">
            <p>Create your bixo</p>

            <div class="container">
                <div class="checkbox-container">
                    <input type="checkbox" id="checkbox1" name="submit_bixo">
                    <label for="checkbox1">
                        <img src="assets/img/bixo.png" alt="Imagen 1" width="150px" height="150px">
                    </label>

                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="checkbox2" name="submit_planta">
                    <label for="checkbox2">
                        <img src="assets/img/planta.png" alt="Imagen 2" width="150px" height="150px">
                    </label>
                </div>
            </div>    

            

            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" name="bixoname" id="bixoname" class="form-control" placeholder="Nombre" required />
                <label class="form-label" for="bixoname">Nombre</label>
            </div>

            <div class="text-center pt-1 mb-5 pb-1">
                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" id="btnRegister">Crear</button>
            </div>

        </form>
    </div>

    <script>
      document.getElementById("btnRegister").addEventListener("click", function() {
        var checkbox1 = document.getElementById("checkbox1").checked;
        var checkbox2 = document.getElementById("checkbox2").checked;

        if (checkbox1 && !checkbox2) {
          window.location.href = "selectbixo.php";
        } else if (!checkbox1 && checkbox2) {
          window.location.href = "selectplanta.php";
        } else {
          alert("Por favor, seleccione solo una casilla de verificación.");
        }
      });
    </script>


    <?php include("./templates/footer.php") ?>