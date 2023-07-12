<?php
include "config.php";
include "utils.php";

$dbConn = connect($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $status = $_POST['status'];
    $content = $_POST['content'];
    $user_id = $_POST['user_id'];

    // Verificar si el ID del post existe antes de la actualización
    $statement = $dbConn->prepare("SELECT id FROM posts WHERE id = :post_id");
    $statement->bindValue(':post_id', $post_id);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        // El ID del post existe, realizar la actualización
        $sql = "UPDATE posts
                SET title = :title,
                    status = :status,
                    content = :content,
                    user_id = :user_id
                WHERE id = :post_id";

        $updateStatement = $dbConn->prepare($sql);
        $updateStatement->bindValue(':post_id', $post_id);
        $updateStatement->bindValue(':title', $title);
        $updateStatement->bindValue(':status', $status);
        $updateStatement->bindValue(':content', $content);
        $updateStatement->bindValue(':user_id', $user_id);
        $updateStatement->execute();

        header('Location: registrado.php');
        exit;
    } else {
        // El ID del post no existe, redirigir a la misma página
        header('Location: update.php');
        exit;
    }
}
?>
