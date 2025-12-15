<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Libro</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<header>
    <h1>Biblioteca Virtual</h1>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="acerca.php">Acerca de</a>
        <a href="mostrar.php">Mostrar Libros por Tema</a>
        <a href="agregar.php">Agregar Libro</a>
    </nav>
</header>

<main>
    <h2>Agregar Libro</h2>

    <form method="POST" action="procesar_agregar.php">
        <input type="text" name="nombre_libro" placeholder="Nombre del libro" required><br><br>

        <label>Tema:</label><br>
        <select name="tema" required>
            <option value="Social">Social</option>
            <option value="Ciencia">Ciencia</option>
            <option value="Otro">Otro</option>
        </select><br><br>

        <input type="number" name="cantidad" placeholder="Cantidad" min="1" required><br><br>

        <input type="text" name="autores" placeholder="Autores (separados por coma)" required><br><br>

        <button type="submit">Agregar Libro</button>
    </form>
</main>

<footer>
    <p>&copy; 2025 Biblioteca Virtual | Diseñado por Alejandro Santos y Nicole Valdes</p>
    <p>
        <a href="index.php">Inicio</a> | 
        <a href="acerca.php">Acerca de</a> | 
        <a href="mostrar.php">Mostrar Libros</a> | 
        <a href="agregar.php">Agregar Libro</a>
    </p>
</footer>
</body>
</html>
