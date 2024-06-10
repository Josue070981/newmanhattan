<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Pedido</title>
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

        <h2>Realizar Pedido</h2>
        <form action="order.php" method="post">
            <label for="plato_id">Seleccionar Plato:</label>
            <select id="plato_id" name="plato_id" required>
                <?php
                $sql = "SELECT * FROM platos";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay platos disponibles</option>";
                }
                ?>
            </select><br>
            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" required><br>
            <input type="submit" name="submit" value="Realizar Pedido">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $plato_id = $_POST["plato_id"];
            $cantidad = $_POST["cantidad"];

            $sql = "INSERT INTO pedidos (plato_id, cantidad, estado) VALUES ('$plato_id', '$cantidad', 'Pendiente')";

            if ($conn->query($sql) === TRUE) {
                echo "<p class='success-message'>Pedido realizado exitosamente.</p>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        ?>

        <h2>Pedidos Recientes</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Plato</th>
                <th>Cantidad</th>
                <th>Estado</th>
                <th>Hora</th>
            </tr>
            <?php
            $sql = "SELECT pedidos.id, platos.nombre, pedidos.cantidad, pedidos.estado, pedidos.created_at 
                    FROM pedidos 
                    JOIN platos ON pedidos.plato_id = platos.id 
                    ORDER BY pedidos.created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"]. "</td>
                            <td>" . $row["nombre"]. "</td>
                            <td>" . $row["cantidad"]. "</td>
                            <td>" . $row["estado"]. "</td>
                            <td>" . $row["created_at"]. "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay pedidos recientes</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
