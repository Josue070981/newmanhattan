<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewManhattan</title>
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

        <h2>Platos Disponibles</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Contenido</th>
            </tr>
            <?php
            $sql = "SELECT * FROM platos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"]. "</td>
                            <td>" . $row["nombre"]. "</td>
                            <td>" . $row["precio"]. "</td>
                            <td>" . $row["contenido"]. "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No se encontraron platos</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
