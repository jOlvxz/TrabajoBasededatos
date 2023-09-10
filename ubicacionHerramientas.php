<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        th, td{
            padding-right: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php error_reporting(0);?>
    <?php include("funciones.php"); $cnn = Conectar(); ?>
    <h1>Asignacion y modificacion de ubicacion</h1>
    <table>
        <form method="POST">
        <thead>
            <tr>
                <th>
                    Codigo H
                </th>
                <th>
                    Estado
                </th>
                <th>
                    categoria
                </th>
                <th>
                    Descripcion
                </th>
                <th>
                    Almacen
                </th>
                <th>
                    Estante
                </th>
                <th>
                    Altura
                </th>
                <th>
                    Pasillo
                </th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $queryHerramientas = "SELECT h.id,h.estado,c.nombre,h.descripcion,u.almacen,u.estante,u.altura,u.pasillo
            FROM ubicacion u, herramienta h, categoria c
            WHERE (h.idubicacion = u.id) and (c.id = h.idcategoria) and
            (h.disponibilidad = 'Disponible')";
            $rs = mysqli_query($cnn, $queryHerramientas);
            while($row = mysqli_fetch_array($rs)){
                echo "<tr>";
                echo "<td>$row[0]</td>";
                echo "<td>$row[1]</td>";
                echo "<td>$row[2]</td>";
                echo "<td>$row[3]</td>";
                echo "<td><input type='text' name='almacen$row[0]' value='$row[4]' size='10'></td>";
                echo "<td><input type='text' name='estante$row[0]' value='$row[5]' size='10'></td>";
                echo "<td><input type='text' name='altura$row[0]' value='$row[6]' size='10'></td>";
                echo "<td><input type='text' name='pasillo$row[0]' value='$row[7]' size='10'></td>";
                echo "<td><input type='submit' name='modificar$row[0]' value='Modificar'></td>";
                echo "</tr>";
            }

            ?>
        </tbody>
    </form>
    </table>

</body>
</html>