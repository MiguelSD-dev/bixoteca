<?php
if (isset($_POST["username"], $_POST["email"], $_POST["password"])) {
    include("conexion.php");

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, $password);

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
        echo "No se ha podido crear el usuario";
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
                                    <p>Create your account</p>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="text" name="username" id="username" class="form-control" placeholder="username" required />
                                        <label class="form-label" for="username">Username</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required />
                                        <label class="form-label" for="email">Email</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="password" name="password" id="password" class="form-control password" placeholder="password"/>
                                        <label class="form-label" for="password">Password</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="password" name="" id="repassword" class="form-control password" placeholder="repeat password" />
                                        <label class="form-label" for="repassword">Repeat password</label>
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" id="btnRegister">Register</button>
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("./templates/footer.php") ?>
