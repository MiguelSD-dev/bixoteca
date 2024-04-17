<?php
if (isset($_POST["dato"])) {
    include("conexion.php");

    $email = $_POST["dato"];

    $sql = "select * from user where username=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(1, $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "hola todo bien";
        exit();
    } else {
        echo json_encode(['error' => '']);
        exit();
    }
}
