<!DOCTYPE html>
<html>

<head>
    <title>Borrar usuario por ID</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Borrar usuario por ID</h2>
        <form action="borrar.php" method="POST">
            <div class="mb-4">
                <label class="block" for="id">ID del usuario:</label>
                <input type="number" id="id" name="id" class="w-full border border-gray-300 rounded p-2" required>
            </div>

            <input type="submit" value="Borrar usuario"
                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">
        </form>
    </div>
</body>

</html>