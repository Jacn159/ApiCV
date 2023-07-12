<?php
include "config.php";

try {
    $dbConn = new PDO("mysql:host={$db['host']};dbname={$db['db']}", $db['username'], $db['password']);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}

$sql = "SELECT * FROM posts";

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql .= " WHERE title LIKE '%$search%' OR content LIKE '%$search%'";
}

$statement = $dbConn->prepare($sql);
$statement->execute();
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Lista de posts</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Lista de posts</h2>

        <table class="w-full border border-gray-300">
            <thead>
                <tr>
                    <th class="border-b border-gray-300 px-4 py-2">ID</th>
                    <th class="border-b border-gray-300 px-4 py-2">Título</th>
                    <th class="border-b border-gray-300 px-4 py-2">Estado</th>
                    <th class="border-b border-gray-300 px-4 py-2">Contenido</th>
                    <th class="border-b border-gray-300 px-4 py-2">ID de usuario</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($posts as $post) {
                    echo '<tr>';
                    echo '<td class="border-b border-gray-300 px-4 py-2">' . $post['id'] . '</td>';
                    echo '<td class="border-b border-gray-300 px-4 py-2">' . $post['title'] . '</td>';
                    echo '<td class="border-b border-gray-300 px-4 py-2">' . $post['status'] . '</td>';
                    echo '<td class="border-b border-gray-300 px-4 py-2">' . $post['content'] . '</td>';
                    echo '<td class="border-b border-gray-300 px-4 py-2">' . $post['user_id'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>