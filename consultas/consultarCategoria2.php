<?php
    //Consulta para mostrar y recargar con AJAX la categoria Actitudes
    require "../conexion/Conexion.php";
    $objetoBBDD = new Conexion();

    $tipo = $objetoBBDD->realEscapeString($_POST["dato"]);

    $sql = "SELECT DISTINCT categoria FROM formacion WHERE tipo='".$tipo."' AND categoria<>'Actitudes'";
    $objetoBBDD->consultarBD($sql);

    echo '<option selected value="Opcion">Seleccione una opcion</option>';
    while($fila = $objetoBBDD->devolverFilas())
    {
        echo '<option value="'.$fila["categoria"].'">'.$fila["categoria"].'</option>';
    }
