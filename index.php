<!DOCTYPE html>
<html>
<head>
    <title>Crear nuevo post</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Crear nuevo post</h2>
        <form action="post.php" method="POST">
            <div class="mb-4">
                <label class="block" for="title">Título:</label>
                <input type="text" id="title" name="title" class="w-full border border-gray-300 rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block" for="status">Estado:</label>
                <select id="status" name="status" class="w-full border border-gray-300 rounded p-2" required>
                    <option value="published">Publicado</option>
                    <option value="draft">Borrador</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block" for="content">Contenido:</label>
                <textarea id="content" name="content" rows="4" cols="50" class="w-full border border-gray-300 rounded p-2" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block" for="user_id">ID de usuario:</label>
                <input type="number" id="user_id" name="user_id" class="w-full border border-gray-300 rounded p-2" required>
            </div>

            <input type="submit" value="Crear post" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
        </form>
        <a href="borrado.php">Borrar</a>
        <a href="update.php">Actualizar</a>
        <a href="consultar.php">Consultar</a>
    </div>
</body>
</html>
