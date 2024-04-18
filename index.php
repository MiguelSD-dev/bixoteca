<?php
session_start();

if (isset($_SESSION["username"])) {
    header("Location: user.php");
    exit();
}


if (isset($_POST["username"])) {

    include("conexion.php");

    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "select * from user where username=? and password=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $password);
    $stmt->execute();


    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetchAll();
        $iduser=$result[0]["iduser"];
        $_SESSION["user"] = $username;
        $_SESSION["iduser"]=$iduser;
        header("Location: bixoteca.php");
        exit();
    } else {
        $error = "Username or password incorrect";
    }
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
                                    <h4 class="mt-1 mb-5 pb-1">We are The Lotus Team</h4>
                                </div>

                                <form action="" method="post">
                                    <p>Please login to your account</p>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" name="username" id="username" class="form-control" placeholder="Username" />
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Log in</button>
                                        <a class="text-muted" href="#!">Forgot password?</a> <!-- ESTA LINEA POR AHORA NO FUNCIONA -->
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <p class="mb-0 me-2">Don't have an account?</p>
                                        <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-danger"><a href="register.php">Create new</a></button>
                                    </div>
                                </form>

                                <?php
                                if (isset($error)) {
                                    echo "<p>" . $error . "</p>";
                                }
                                ?>

                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                <h4 class="mb-4">We are more than just a company</h4>
                                <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("./templates/footer.php") ?>