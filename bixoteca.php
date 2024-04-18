<?php
session_start();

if (isset($_SESSION["user"])) {
    $email = $_SESSION["user"];
    echo $email;
} else {
    header("Location: ./");
}



?>

<?php include("./templates/header.php") ?>


    

<form action="creabixo.php" method="post">
    <button type="submit">Crea nuevo bixo</button>
</form>


<?php include("./templates/footer.php") ?>
