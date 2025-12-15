<?php
include("conexion.php");

// Filtrado por tema
$tema_filtro = isset($_GET['tema']) ? $_GET['tema'] : '';

// Construir consulta
if ($tema_filtro && in_array($tema_filtro, ['Social','Ciencia','Otro'])) {
    $sql = "SELECT libro.id_libro, libro.nombre_libro, libro.tema, libro.cantidad,
                   GROUP_CONCAT(autor.nombre_autor SEPARATOR ', ') AS autores
            FROM libro
            LEFT JOIN libro_autor ON libro.id_libro = libro_autor.id_libro
            LEFT JOIN autor ON libro_autor.id_autor = autor.id_autor
            WHERE libro.tema = ?
            GROUP BY libro.id_libro
            ORDER BY libro.id_libro";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tema_filtro);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Sin filtro
    $sql = "SELECT libro.id_libro, libro.nombre_libro, libro.tema, libro.cantidad,
                   GROUP_CONCAT(autor.nombre_autor SEPARATOR ', ') AS autores
            FROM libro
            LEFT JOIN libro_autor ON libro.id_libro = libro_autor.id_libro
            LEFT JOIN autor ON libro_autor.id_autor = autor.id_autor
            GROUP BY libro.id_libro
            ORDER BY libro.id_libro";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Libros</title>
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
    <h2>Lista de Libros</h2>

    <form method="GET" action="mostrar.php">
        <label>Filtrar por tema:</label>
        <select name="tema">
            <option value="">Todos</option>
            <option value="Social" <?= $tema_filtro=='Social' ? 'selected' : '' ?>>Social</option>
            <option value="Ciencia" <?= $tema_filtro=='Ciencia' ? 'selected' : '' ?>>Ciencia</option>
            <option value="Otro" <?= $tema_filtro=='Otro' ? 'selected' : '' ?>>Otro</option>
        </select>
        <button type="submit">Filtrar</button>
    </form>

    <br>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tema</th>
                <th>Cantidad</th>
                <th>Autores</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id_libro'] . "</td>";
                    echo "<td>" . $row['nombre_libro'] . "</td>";
                    echo "<td>" . $row['tema'] . "</td>";
                    echo "<td>" . $row['cantidad'] . "</td>";
                    echo "<td>" . $row['autores'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay libros para mostrar.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</main>

<footer>
    <p>&copy; 2025 Biblioteca Virtual | Diseñado por Tu Nombre</p>
    <p>
        <a href="index.php">Inicio</a> | 
        <a href="acerca.php">Acerca de</a> | 
        <a href="mostrar.php">Mostrar Libros</a> | 
        <a href="agregar.php">Agregar Libro</a>
    </p>
</footer>
</body>
</html>
