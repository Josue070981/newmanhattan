<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Plato</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="container">
                <h1>NewManhattan</h1>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="add_plato.php">Añadir Plato</a></li>
                    <li><a href="order.php">Realizar Pedido</a></li>
                </ul>
            </div>
        </header>

        <h2>Añadir Nuevo Plato</h2>
        <form action="add_plato.php" method="post">
            <label for="nombre">Nombre del Plato:</label>
            <input type="text" id="nombre" name="nombre" required><br>
            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio" required><br>
            <label for="contenido">Contenido:</label>
            <textarea id="contenido" name="contenido" required></textarea><br>
            <input type="submit" name="submit" value="Añadir Plato">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST["nombre"];
            $precio = $_POST["precio"];
            $contenido = $_POST["contenido"];

            $sql = "INSERT INTO platos (nombre, precio, contenido) VALUES ('$nombre', '$precio', '$contenido')";

            if ($conn->query($sql) === TRUE) {
                echo "<p class='success-message'>Plato añadido exitosamente.</p>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        ?>

    </div>
</body>
</html>
