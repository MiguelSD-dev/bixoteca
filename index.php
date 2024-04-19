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
        $iduser = $result[0]["iduser"];
        $_SESSION["user"] = $username;
        $_SESSION["iduser"] = $iduser;
        header("Location: bixoteca.php");
        exit();
    } else {
        $error = "Username or password incorrect";
    }
}
?>

<?php include("templates/header.php"); ?>

<div class="container mt-5 formulario_login">

    <form action="" method="post">
        
        <div class="form-group">
            <label for="exampleInputEmail1" for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp" placeholder="Enter username">
            <small id="userHelp" class="form-text text-muted">We'll never share your username with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1" for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" id="pass" placeholder="Password">
        </div>

        <button type="submit" class="btn btn-primary">Login</button>

        <button type="submit" class="btn btn-primary"><a href="register.php">Create new</a></button>
    </form>

    <?php
    if (isset($error)) {
        echo "<p>" . $error . "</p>";
    }
    ?>

</div>
<?php include("templates/footer.php"); ?>