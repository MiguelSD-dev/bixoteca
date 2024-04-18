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
    header("Location: ./some_page.php");
    exit();
}
?>

<?php include("./templates/header.php") ?>

<section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">

                                <div class="text-center">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp" style="width: 185px;" alt="logo">
                                    <h4 class="mt-1 mb-5 pb-1">Edit Your Profile</h4>
                                </div>

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
                                        <input type="password" name="repassword" id="repassword" class="form-control password" placeholder="Repeat Password"/>
                                        <label class="form-label" for="repassword">Repeat Password</label>
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" id="btnRegister" disabled>Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                <!-- Aquí puedes mostrar información adicional si lo deseas -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("./templates/footer.php") ?>
