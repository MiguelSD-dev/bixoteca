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
            header("Location: ./creabixo.php");
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

<?php include("templates/header.php"); ?>

<div class="container mt-5 formulario_login">

    <form action="" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp" placeholder="Username" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Email" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control password" name="password" id="password" placeholder="Password" required>
        </div>

        <div class="form-group">
            <label for="repassword">Repeat password</label>
            <input type="password" class="form-control password" name="" id="repassword" placeholder="Repeat password" required>
        </div>

        <button type="submit" class="btn btn-primary" id="btnRegister" disabled>Registrate</button>

    </form>

    <?php
    if (isset($error)) {
        echo "<p>" . $error . "</p>";
    }
    ?>

</div>

<?php include("templates/footer.php"); ?>