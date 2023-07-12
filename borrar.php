<?php
include "config.php";
include "utils.php";

$dbConn = connect($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    // Verificar si el ID existe antes de eliminar
    $statement = $dbConn->prepare("SELECT id FROM posts WHERE id=:id");
    $statement->bindValue(':id', $id);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        // El ID existe, realizar la eliminación
        $deleteStatement = $dbConn->prepare("DELETE FROM posts WHERE id=:id");
        $deleteStatement->bindValue(':id', $id);
        $deleteStatement->execute();

        header('Location: registrado.php');
        exit;
    } else {
        // El ID no existe, redirigir a la misma página
        header('Location: borrado.php');
        exit;
    }
}
?>
