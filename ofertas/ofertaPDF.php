<?php
    //Creaccion del PDF de la oferta
    session_start();
    require('../fpdf181/fpdf.php');
    require('../conexion/Conexion.php');
    $objetoBBDD = new Conexion();
    header("Content-Type: text/html;charset=utf-8");

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',24);
    $pdf->Cell(10,10,'Oferta de Empleo',0,1);
    $pdf->Cell(0,10,'',0,1);

    $idOferta = $_GET["idOferta"];

    $sql = "SELECT * FROM ofertas WHERE idOferta=".$idOferta;
    $objetoBBDD->consultarBD($sql);
    while($fila = $objetoBBDD->devolverFilas())
    {
        if($fila["duracion"]=="tiempoCompleto")
        {
            $fila["duracion"] = "Tiempo completo";
        }
        else
        {
            $fila["duracion"] = "Tiempo parcial";
        }

        if($fila["horario"]=="indefinido")
        {
            $fila["horario"] = "Indefinido";
        }
        else
        {
            $fila["horario"] = "Temporal";
        }

        $salario = str_replace('€','',$fila["salario"]);

        $pdf->SetFont('Arial','b',20);
        $pdf->Cell(50,15,"Datos de la empresa",0,1);

        $pdf->SetFont('Arial','b',14);
        $pdf->Cell(25,15,"Empresa: ");
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(30,15,$fila["empresa"],0,1);

        $pdf->SetFont('Arial','b',20);
        $pdf->Cell(50,15,"Datos de la oferta",0,1);

        $pdf->SetFont('Arial','b',14);
        $pdf->Cell(50,15,"Nombre de la oferta: ");
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(60,15,$fila["nombre"],0,1);
        $pdf->SetFont('Arial','b',14);
        $pdf->Cell(32,1,"Descripcion: ");
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(30,1,$fila["descripcion"],0,1);
        $pdf->SetFont('Arial','b',14);
        $pdf->Cell(25,15,"Duracion: ");
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(30,15,$fila["duracion"],0,1);
        $pdf->SetFont('Arial','b',14);
        $pdf->Cell(22,1,"Horario: ");
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(30,1,$fila["horario"],0,1);
        $pdf->SetFont('Arial','b',14);
        $pdf->Cell(22,15,"Salario: ");
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(30,15,$salario.' euros',0,1);
        $pdf->SetFont('Arial','b',14);
        $pdf->Cell(25,1,"Vacantes: ");
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(40,1,$fila["numeroVacantes"].' vacante(s)',0,1);

        $pdf->Cell(50,15,"",0,1);

        $pdf->SetFont('Arial','b',20);
        $pdf->Cell(50,5,"Conocimientos",0,1);

        $sql = "SELECT * FROM formacion WHERE idFormacion=".$fila["requisito1"];
        $objetoBBDD->consultarBD($sql);
        $fila2 = $objetoBBDD->devolverFilas();
        $pdf->SetFont('Arial','b',14);
        $pdf->Cell(30,15,"Requisito 1: ");
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(30,15,$fila2["subcategoria"],0,1);

        $sql = "SELECT * FROM formacion WHERE idFormacion=".$fila["requisito2"];
        $objetoBBDD->consultarBD($sql);
        $fila2 = $objetoBBDD->devolverFilas();
        $pdf->SetFont('Arial','b',14);
        $pdf->Cell(30,5,"Requisito 2: ");
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(30,5,$fila2["subcategoria"],0,1);

        if(isset($fila["requisito3"]))
        {
            $sql = "SELECT * FROM formacion WHERE idFormacion=" . $fila["requisito3"];
            $objetoBBDD->consultarBD($sql);
            $fila2 = $objetoBBDD->devolverFilas();
            $pdf->SetFont('Arial','b',14);
            $pdf->Cell(30,15,"Requisito 3: ");
            $pdf->SetFont('Arial','',14);
            $pdf->Cell(30,15,$fila2["subcategoria"],0,1);
        }

        if(isset($fila["requisito4"]))
        {
            $sql = "SELECT * FROM formacion WHERE idFormacion=" . $fila["requisito4"];
            $objetoBBDD->consultarBD($sql);
            $fila2 = $objetoBBDD->devolverFilas();
            $pdf->SetFont('Arial','b',14);
            $pdf->Cell(30,5,"Requisito 4: ");
            $pdf->SetFont('Arial','',14);
            $pdf->Cell(30,5,$fila2["subcategoria"],0,1);
        }

        if(isset($fila["requisito5"]))
        {
            $sql = "SELECT * FROM formacion WHERE idFormacion=" . $fila["requisito5"];
            $objetoBBDD->consultarBD($sql);
            $fila2 = $objetoBBDD->devolverFilas();
            $pdf->SetFont('Arial','b',14);
            $pdf->Cell(30,15,"Requisito 5: ");
            $pdf->SetFont('Arial','',14);
            $pdf->Cell(30,15,$fila2["subcategoria"],0,1);
        }

        $pdf->SetFont('Arial','b',20);
        $pdf->Cell(50,15,"Actitudes",0,1);

        $sql = "SELECT * FROM formacion WHERE idFormacion=".$fila["actitud1"];
        $objetoBBDD->consultarBD($sql);
        $fila2 = $objetoBBDD->devolverFilas();
        $pdf->SetFont('Arial','b',14);
        $pdf->Cell(25,10,"Actitud 1: ");
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(30,10,$fila2["subcategoria"],0,1);

        $sql = "SELECT * FROM formacion WHERE idFormacion=".$fila["actitud2"];
        $objetoBBDD->consultarBD($sql);
        $fila2 = $objetoBBDD->devolverFilas();
        $pdf->SetFont('Arial','b',14);
        $pdf->Cell(25,10,"Actitud 2: ");
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(30,10,$fila2["subcategoria"],0,1);

        if(isset($fila["actitud3"]))
        {
            $sql = "SELECT * FROM formacion WHERE idFormacion=".$fila["actitud3"];
            $objetoBBDD->consultarBD($sql);
            $fila2 = $objetoBBDD->devolverFilas();
            $pdf->SetFont('Arial','b',14);
            $pdf->Cell(25,10,"Actitud 3: ");
            $pdf->SetFont('Arial','',14);
            $pdf->Cell(30,10,$fila2["subcategoria"],0,1);
        }
    }

    $pdf->Output();


