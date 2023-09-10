<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        td, th{
            padding-right: 20px;
        }
    </style>
</head>

<body>
    <h1>Registro de solicitudes pendientes</h1>
    <table>
        <tr>
            <td>Filtrar Cod Solicitud</td>
            <td>Filtrar Fecha</td>
        </tr>
        <tr>
            <form method='POST'>
                <td><input type="text" name="inputCodSolicitud" id="" size="15"></td>
                <td><input type="date" name="inputFecha" id="" size="15"></td>
                <td><input type="submit" value="Filtrar" name="filtrar"></td>
                <td><input type="submit" value="Refrescar" name="asd"></td>
            </form>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>Cod Solicitud</th>
                <th>Fecha Solicitud</th>
                <th>Area</th>
                <th>Estado Solicitud</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                include("funciones.php");
                $cnn = Conectar();
                #query por defecto
                $query = "SELECT a.id as 'Id Solicitud', a.fechasolicitud,
                d.nombre as 'departamento',a.estadosolicitud
                FROM departamento d, usuario u, procesoasignacion a
                WHERE (d.id = u.iddepartamento) and (u.rut = a.rutusuario)and
                (a.estadosolicitud = 'pendiente')";
                # en el caso de que presione el boton filtrar modifica la query por defecto
                if(isset($_POST['filtrar'])){
                    $codigo = $_POST['inputCodSolicitud'];
                    $fecha = $_POST['inputFecha'];
                    #condicional que verifica si solamente el campo fecha tiene datos
                    if($codigo == '' && $fecha !== ''){
                        $query = "SELECT a.id as 'Id Solicitud', a.fechasolicitud,
                        d.nombre as 'departamento',a.estadosolicitud
                        FROM departamento d, usuario u, procesoasignacion a
                        WHERE (d.id = u.iddepartamento) and (u.rut = a.rutusuario)and
                        (a.estadosolicitud = 'pendiente') and (a.fechasolicitud = '$fecha')";
                    #condicional que verifica si solamente el campo de codigo contiene datos
                    } elseif($codigo !== '' && $fecha == ''){
                        $query = "SELECT a.id as 'Id Solicitud', a.fechasolicitud,
                        d.nombre as 'departamento',a.estadosolicitud
                        FROM departamento d, usuario u, procesoasignacion a
                        WHERE (d.id = u.iddepartamento) and (u.rut = a.rutusuario)and
                        (a.estadosolicitud = 'pendiente') and (a.id = '$codigo')";
                        #comprueba si los 2 campos estan llenos
                    }elseif($codigo !== '' && $fecha !== ''){
                        $query = "SELECT a.id as 'Id Solicitud', a.fechasolicitud,
                        d.nombre as 'departamento',a.estadosolicitud
                        FROM departamento d, usuario u, procesoasignacion a
                        WHERE (d.id = u.iddepartamento) and (u.rut = a.rutusuario)and
                        (a.estadosolicitud = 'pendiente') and (a.id = '$codigo')and (a.fechasolicitud = '$fecha')";
                    }
                }
                $rs = mysqli_query($cnn,$query);
                #Comprobacion si no existen datos con los filtros
                if(mysqli_num_rows($rs) == "0"){
                    echo "<script>alert('Comprobacion de ')</script>";
                }else{
                    while ($row = mysqli_fetch_array($rs)){
                        echo "<tr>";
                        echo "<td>$row[0]</td>";
                        echo "<td>$row[1]</td>";
                        echo "<td>$row[2]</td>";
                        echo "<td>$row[3]</td>";
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>
</body>
</html>