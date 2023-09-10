<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        th, td{
            padding-right: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Busqueda de herramientas</h1>
    <!-- tabla inicial donde podra elegir las categorias de la herramientas-->
    <table>
        <thead>
            <tr>
                <th>
                    Categoria Herramienta
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <form method="POST">
                        <select name="select">
                            <!-- realiza los options de todas las categorias de herramientas de la base de datos -->
                            <?php 
                            include("funciones.php");
                            $cnn = Conectar();
                            $query = "select id, nombre from categoria";
                            $rs = mysqli_query($cnn, $query);
                            while($row = mysqli_fetch_array($rs)){
                                #almacena la id en el valor, y muestra el nombre la ventana option
                                echo "<option value='$row[0]'>$row[1]</option>";
                            }
                            ?>
                        </select>

                </td>
                <td>
                    <input type="submit" value="Buscar" name="buscar">
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- tabla donde se mostrará la informacion de todas las herramientas de la base de datos -->
    <table>
        <thead>
            <tr>
                <th>ID Herramienta</th>
                <th>Descripcion</th>
                <th>Almacen</th>
                <th>Estante</th>
                <th>Altura</th>
                <th>Pasillo</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(isset($_POST['buscar'])){
                $idCategoria = $_POST['select'];
                $query = "SELECT h.id,h.descripcion,u.almacen,u.estante,u.altura,u.pasillo
                FROM ubicacion u, herramienta h, categoria c
                WHERE (h.idubicacion = u.id) and (c.id = h.idcategoria) and
                (h.disponibilidad = 'Disponible') and (u.almacen = 'Pañol 1') and
                (c.id = '$idCategoria')";
                $rs = mysqli_query($cnn, $query);
                # Realiza la comprobacion de que si existen resultados para mostrar
                if(mysqli_num_rows($rs) == "0"){
                    echo "<script>alert('No hay herramientas de esa categoria con una ubicación asignada')</script>";
                }else{
                    while($row = mysqli_fetch_array($rs)){
                        echo "<tr>";
                        echo "<td>$row[0]</td>";
                        echo "<td>$row[1]</td>";
                        echo "<td>$row[2]</td>";
                        echo "<td>$row[3]</td>";
                        echo "<td>$row[4]</td>";
                        echo "<td>$row[5]</td>";
                        echo "</tr>";
                    }
                }
            }

            ?>

        </tbody>
    </table>
</body>
</html>