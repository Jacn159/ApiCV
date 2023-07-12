<?php
include "config.php";
include "utils.php";


$dbConn = connect($db);

/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (isset($_GET['id'])) {
    //Mostrar un post
    $sql = $dbConn->prepare("SELECT * FROM posts where id=:id");
    $sql->bindValue(':id', $_GET['id']);
    $sql->execute();
    header("HTTP/1.1 200 OK");
    echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
    exit();
  } else {
    //Mostrar lista de post
    $sql = $dbConn->prepare("SELECT * FROM posts");
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    header("HTTP/1.1 200 OK");
    echo json_encode($sql->fetchAll());
    exit();
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
    // Resto del código para manejar la solicitud PUT
    // ...
    // Obtener los datos del cuerpo de la solicitud en formato JSON
    $content = file_get_contents('php://input');
    parse_str($content, $array);

    // Obtener el ID de la publicación para actualizar
    // NECESITO OBTENER EL ID
    $postId = $_GET["id"];

    // Obtener los valores para actualizar
    $title = $array['title'];
    $status = $array['status'];
    $content = $array['content'];
    $user_id = $array['user_id'];

    // Construir la consulta SQL de actualización
    $sql = "UPDATE posts SET title = :title, status = :status, content = :content, user_id = :user_id WHERE id = :id";

    // Preparar la consulta SQL
    $statement = $dbConn->prepare($sql);

    // Vincular los valores
    $statement->bindParam(':id', $postId);
    $statement->bindParam(':title', $title);
    $statement->bindParam(':status', $status);
    $statement->bindParam(':content', $content);
    $statement->bindParam(':user_id', $user_id);

    // Ejecutar la consulta SQL
    $statement->execute();

    // Enviar respuesta exitosa
    header("HTTP/1.1 200 OK");

    exit();
  } else {
    // Resto del código para manejar otras solicitudes POST
    // ...
    $input = $_POST;
    var_dump($input);
    $sql = "INSERT INTO posts
            (title, status, content, user_id)
            VALUES
            (:title, :status, :content, :user_id)";

    $statement = $dbConn->prepare($sql);
    var_dump($statement);
    bindAllValues($statement, $input);
    $statement->execute();
    $postId = $dbConn->lastInsertId();

    if ($postId) {
      $input['id'] = $postId;
      header("HTTP/1.1 200 OK");
      echo json_encode($input);
      header("location: registrado.php ");
      exit();
    }
  }
}

// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $input = $_POST;
  var_dump($input);
  $sql = "INSERT INTO posts
          (title, status, content, user_id)
          VALUES
          (:title, :status, :content, :user_id)";

  $statement = $dbConn->prepare($sql);
  var_dump($statement);
  bindAllValues($statement, $input);
  $statement->execute();
  $postId = $dbConn->lastInsertId();

  if ($postId) {
    $input['id'] = $postId;
    header("HTTP/1.1 200 OK");
    echo json_encode($input);

    exit();
  }
}


//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
  $id = $_GET['id'];
  $statement = $dbConn->prepare("DELETE FROM posts where id=:id");
  $statement->bindValue(':id', $id);
  $statement->execute();
  header("HTTP/1.1 200 OK");
  exit();
}

//Actualizar
// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
  // Obtener los datos del cuerpo de la solicitud en formato JSON
  $contenido = file_get_contents('php://input');
  parse_str($contenido, $array);

  // Obtener el ID de la publicación para actualizar
  // NECESITO OBTENER EL ID
  $postId = $_GET["id"];

  // Obtener los valores para actualizar
  $title = $array['title'];
  $status = $array['status'];
  $content = $array['content'];
  $user_id = $array['user_id'];

  // Construir la consulta SQL de actualización
  $sql = "UPDATE posts SET title = :title, status = :status, content = :content, user_id = :user_id WHERE id = :id";

  // Preparar la consulta SQL
  $statement = $dbConn->prepare($sql);

  // Vincular los valores
  $statement->bindParam(':id', $postId);
  $statement->bindParam(':title', $title);
  $statement->bindParam(':status', $status);
  $statement->bindParam(':content', $content);
  $statement->bindParam(':user_id', $user_id);

  // Ejecutar la consulta SQL
  $statement->execute();

  // Enviar respuesta exitosa
  header("HTTP/1.1 200 OK");
  echo json_encode($array);
  exit();
}



//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>