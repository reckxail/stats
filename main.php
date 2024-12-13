<?php
include('conexion.php');

// Verificar si se ha enviado el formulario de búsqueda
$perfil_buscar = isset($_GET['perfil']) ? $_GET['perfil'] : '';

// Consultar los datos de la tabla, aplicando el filtro si se proporciona un perfil
$sql = "SELECT id, Link, Perfil, Perk1, Fuerza, Perk2, Educacion, Perk3, Aguante, Nivel, Total FROM stats";
if ($perfil_buscar != '') {
    $sql .= " WHERE Perfil LIKE '%" . $conexion->real_escape_string($perfil_buscar) . "%'"; // Filtrar por perfil
}
$sql .= " ORDER BY Total DESC"; // Ordenar de mayor a menor por Total
$resultado = $conexion->query($sql);

// Mostrar el formulario de búsqueda
echo "<form method='get' action=''>
        <input type='text' name='perfil' placeholder='Buscar perfil...' value='" . htmlspecialchars($perfil_buscar) . "'>
        <input type='submit' value='Buscar'>
      </form>";

// Mostrar los datos en una tabla HTML
echo "<table border='1'>
        <tr>
            <th>Top</th>
            <th>Link</th>
            <th>Perfil</th>
            <th>Perk1</th>

            <th>Perk2</th>

            <th>Perk3</th>

            <th>Nivel</th>
            <th>Total</th>
        </tr>";

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
    // Contador para la columna "Top"
    $top = 1;

    // Mostrar cada fila de datos
    while($row = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td><a href='" . $row["Link"] . "' target='_blank'>" . $row["Link"] . "</a></td>
                <td>" . $row["Perfil"] . "</td>
                <td>" . $row["Perk1"] . "</td>

                <td>" . $row["Perk2"] . "</td>

                <td>" . $row["Perk3"] . "</td>

                <td>" . $row["Nivel"] . "</td>
                <td>" . $row["Total"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hay resultados.";
}

// Cerrar la conexión
$conexion->close();
?>
