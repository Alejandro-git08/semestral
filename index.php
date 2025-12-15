<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual</title>
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
        <div class="bienvenida">
            <h2>Bienvenido a la Biblioteca Virtual</h2>
            <p>Tu espacio para explorar, organizar y descubrir libros de diferentes temáticas.</p>

            <div class="categorias">
                <div class="categoria social">
                    <div class="icono">👥</div>
                    <h3>Social</h3>
                    <p>Sociología, psicología, historia y más.</p>
                </div>

                <div class="categoria ciencia">
                    <div class="icono">🔬</div>
                    <h3>Ciencia</h3>
                    <p>Física, química, biología y matemáticas.</p>
                </div>

                <div class="categoria otro">
                    <div class="icono">📚</div>
                    <h3>Otro</h3>
                    <p>Arte, literatura, filosofía y más.</p>
                </div>
            </div>

            <div class="acciones">
                <a href="mostrar.php" class="btn btn-primary">Ver Libros</a>
                <a href="agregar.php" class="btn btn-secondary">Agregar Libro</a>
            </div>
        </div>
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