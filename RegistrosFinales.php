<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Registros Totales</title>
</head>
<body>
    <div class="container">
        <h2>Registros Totales</h2>
        <table>
            <tr>
                <th>Indice</th>
                <th>Nombre</th>
                <th>Animal</th>
                <th>Cargo</th>
                <th>Detalles</th>
                <th>Precio</th>
            </tr>
            <?php
            // Conexión a la base de datos
            $servername = "localhost";
            $username = "root";
            $password = "123";
            $dbname = "db_familia_mallma";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM Cargos";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['Id_Cargo'] . "</td>";
                    // Aquí necesitas obtener el nombre del animal y del participante
                    echo "<td>" . obtenerNombreParticipante($conn, $row['Id_Participante']) . "</td>";
                    echo "<td>" . obtenerNombreAnimal($conn, $row['Id_Producto']) . "</td>";
                    echo "<td>" . $row['Descripcion'] . "</td>";
                    echo "<td>" . $row['Detalle'] . "</td>";
                    echo "<td>" . $row['Precio'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "0 resultados";
            }

            // Nombre del animal según su Id_Producto
            function obtenerNombreAnimal($conn, $idProducto) {
                $sql = "SELECT Nombre_Producto FROM Producto_Donacion WHERE Id_Producto = $idProducto";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    return $row['Nombre_Producto'];
                } else {
                    return "Nombre del animal no encontrado";
                }
            }

            // Nombre del participante según su Id_Participante
            function obtenerNombreParticipante($conn, $idParticipante) {
                $sql = "SELECT Nombre FROM Participantes WHERE Id_Participante = $idParticipante";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    return $row['Nombre'];
                } else {
                    return "Nombre del participante no encontrado";
                }
            }

            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
