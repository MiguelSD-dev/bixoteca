<?php
session_start();

// Si el usuario no está autenticado, redirige a la página de inicio
if (!isset($_SESSION["user"])) {
    header("Location: ./");
    exit();
}

// Obtener los datos del usuario de la base de datos
include("conexion.php");

$user_id = $_SESSION["iduser"];
$sql = "SELECT * FROM user WHERE iduser = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$user_id]);
$user_data = $stmt->fetch(PDO::FETCH_ASSOC);

// Procesar el formulario de edición de datos del usuario
if (isset($_POST["username"], $_POST["email"], $_POST["password"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "UPDATE user SET username = ?, email = ?, password = ? WHERE iduser = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$username, $email, $password, $user_id]);

    // Redirigir a alguna página después de la edición
    header("Location: ./bixoteca.php");
    exit();
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
                    <button class="star-button">&#9733;<span class="info-text"><a href="userdata.php">INFO</a></span></button>

                </div>
            </div>
        </div>
    </header>

    <div class="container mt-5 formulario_login">

        <form action="" method="post">
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?php echo $user_data['username']; ?>" required />
                <label class="form-label" for="username">Username</label>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email address" value="<?php echo $user_data['email']; ?>" required />
                <label class="form-label" for="email">Email</label>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" name="password" id="password" class="form-control password" placeholder="Password" value="<?php echo $user_data['password']; ?>" />
                <label class="form-label" for="password">Password</label>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" name="repassword" id="repassword" class="form-control password" placeholder="Repeat Password" />
                <label class="form-label" for="repassword">Repeat Password</label>
            </div>

            <div class="text-center pt-1 mb-5 pb-1">
                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" id="btnRegister" disabled>Save Changes</button>
            </div>
        </form>
    </div>
    </section>

    <?php include("./templates/footer.php") ?>