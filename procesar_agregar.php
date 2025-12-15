<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("conexion.php"); // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_libro = $_POST['nombre_libro'];
    $tema = $_POST['tema'];
    $cantidad = $_POST['cantidad'];
    $autores_input = $_POST['autores'];

    // Separar autores por coma y limpiar espacios
    $autores = array_map('trim', explode(',', $autores_input));

    // Insertar libro
    $stmt = $conn->prepare("INSERT INTO libro(nombre_libro, tema, cantidad) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $nombre_libro, $tema, $cantidad);

    if (!$stmt->execute()) {
        die("Error al insertar libro: " . $stmt->error);
    }

    $id_libro = $stmt->insert_id;
    $autores_insertados = [];

    foreach ($autores as $autor_nombre) {
        if (empty($autor_nombre)) continue;

        // Verificar si el autor ya existe
        $stmt_autor = $conn->prepare("SELECT id_autor FROM autor WHERE nombre_autor = ?");
        $stmt_autor->bind_param("s", $autor_nombre);
        $stmt_autor->execute();
        $res = $stmt_autor->get_result();

        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $id_autor = $row['id_autor'];
        } else {
            // Insertar nuevo autor
            $stmt_insert = $conn->prepare("INSERT INTO autor(nombre_autor) VALUES (?)");
            $stmt_insert->bind_param("s", $autor_nombre);
            if (!$stmt_insert->execute()) {
                die("Error al insertar autor: " . $stmt_insert->error);
            }
            $id_autor = $stmt_insert->insert_id;
        }

        // Evitar duplicar la relación libro-autor
        $stmt_rel_check = $conn->prepare("SELECT * FROM libro_autor WHERE id_libro = ? AND id_autor = ?");
        $stmt_rel_check->bind_param("ii", $id_libro, $id_autor);
        $stmt_rel_check->execute();
        $res_check = $stmt_rel_check->get_result();

        if ($res_check->num_rows == 0) {
            $stmt_rel = $conn->prepare("INSERT INTO libro_autor(id_libro, id_autor) VALUES (?, ?)");
            $stmt_rel->bind_param("ii", $id_libro, $id_autor);
            if (!$stmt_rel->execute()) {
                die("Error al relacionar libro y autor: " . $stmt_rel->error);
            }
        }

        $autores_insertados[] = $autor_nombre;
    }

    // Mostrar los datos agregados
    echo "<h2>Libro agregado correctamente</h2>";
    echo "<p><strong>Nombre:</strong> $nombre_libro</p>";
    echo "<p><strong>Tema:</strong> $tema</p>";
    echo "<p><strong>Cantidad:</strong> $cantidad</p>";
    echo "<p><strong>Autores:</strong> " . implode(", ", $autores_insertados) . "</p>";
    echo "<br><a href='agregar.php'>Agregar otro libro</a> | <a href='mostrar.php'>Ver todos los libros</a>";
}
?>
