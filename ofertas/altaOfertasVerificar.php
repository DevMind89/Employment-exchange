<?php
    session_start();
    require('../conexion/Conexion.php');
    $objetoBBDD = new Conexion();
    header("Content-Type: text/html;charset=utf-8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../images/favicon.ico">
	<title>Bolsa de empleo</title>

	<!-- Bootstrap core CSS -->
	<link href="../dist/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Icons -->
	<link href="../css/font-awesome.css" rel="stylesheet">
	
	<!-- Custom styles for this template -->
	<link href="../css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>
<body onload="bloquearBoton();">
	<div class="container-fluid" id="wrapper">
		<div class="row">
			<nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2">
				<h1 class="site-title"><a href="../inicio.php"><em class="fa fa-rocket"></em> Bolsa<br> de Empleo</a></h1>

				<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><em class="fa fa-bars"></em></a>
				<ul class="nav nav-pills flex-column sidebar-nav">
					<li class="nav-item"><a class="nav-link" href="../inicio.php"><em class="fa fa-home"></em> Inicio <span class="sr-only">(current)</span></a></li>
                    <li class="parent nav-item"><a class="nav-link" data-toggle="collapse" href="#sub-item-1">
                            <em class="fa fa-clipboard">&nbsp;</em> Ofertas <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><i class="fa fa-plus"></i></span>
                        </a>
                        <ul class="children collapse" id="sub-item-1">
                            <li class="nav-item"><a class="nav-link" href="buscarEmpresa.php">Alta Oferta</a></li>
                            <li class="nav-item"><a class="nav-link" href="listarOfertas.php">Listar Ofertas</a></li>
                        </ul>
                    </li>
                    <li class="parent nav-item"><a class="nav-link" data-toggle="collapse" href="#sub-item-2">
                            <em class="fa fa-briefcase">&nbsp;</em> Empresas <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><i class="fa fa-plus"></i></span>
                        </a>
                        <ul class="children collapse" id="sub-item-2">
                            <li class="nav-item"><a class="nav-link" href="../empresa/altaEmpresa.php">Alta Empresa</a></li>
                            <li class="nav-item"><a class="nav-link" href="../empresa/listarEmpresas.php">Listar Empresas</a></li>
                        </ul>
                    </li>
                    <li class="parent nav-item"><a class="nav-link" data-toggle="collapse" href="#sub-item-3">
                            <em class="fa fa-book">&nbsp;</em> Formacion <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><i class="fa fa-plus"></i></span>
                        </a>
                        <ul class="children collapse" id="sub-item-3">
                            <li class="nav-item"><a class="nav-link" href="../formacion/altaFormacion.php">Alta Formacion</a></li>
                            <li class="nav-item"><a class="nav-link" href="../formacion/listarFormacion.php">Listar Formacion</a></li>
                        </ul>
                    </li>
                    <li class="parent nav-item"><a class="nav-link" data-toggle="collapse" href="#sub-item-4">
                            <em class="fa fa fa-child">&nbsp;</em> Alumnos <span data-toggle="collapse" href="#sub-item-4" class="icon pull-right"><i class="fa fa-plus"></i></span>
                        </a>
                        <ul class="children collapse" id="sub-item-4">
                            <li class="nav-item"><a class="nav-link" href="../alumnos/altaAlumnos.php">Alta Alumnos</a></li>
                            <li class="nav-item"><a class="nav-link" href="../alumnos/listarAlumnos.php">Listar Alumnos</a></li>
                        </ul>
                    </li>
				</ul>
				<a href="../index.html" class="logout-button"><em class="fa fa-power-off"></em> Salir</a>
			</nav>
				
			<a href="../index.html" class="logout-button"><em class="fa fa-power-off"></em> Signout</a>
			<main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">
				<header class="page-header row justify-center">
					<div class="col-md-6 col-lg-8" >
						<h1 class="float-left text-center text-md-left">Oferta de Empleo</h1>
					</div>
					<div class="dropdown user-dropdown col-md-6 col-lg-4 text-center text-md-right"><a class="btn btn-stripped dropdown-toggle" href="https://example.com" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="../images/profile-pic.jpg" alt="profile photo" class="circle float-left profile-photo" width="50" height="auto">
						<div class="username mt-1">
							<h4 class="mb-1">Usuario</h4>
                            <h6 class="text-muted"><?php echo $_SESSION["usuario"] ?></h6>
						</div>
						</a>
						<div class="dropdown-menu dropdown-menu-right" style="margin-right: 1.5rem;" aria-labelledby="dropdownMenuLink">
							<a class="dropdown-item" href="../index.html"><em class="fa fa-power-off mr-1"></em> Cerrar sesión</a>
						</div>
					</div>
					<div class="clear"></div>
				</header>
				<section class="row">
					<div class="col-sm-12">
						<section class="row">
							<div class="col-12">
								<div class="card mb-4">
                                    <div class="card-block">
                                    <?php
                                        //Recoger datos del formulario altaOfertas y dar de alta a la oferta en la BD.
                                        $autor = "'".$_SESSION["usuario"]."'";
                                        $empresa = "'".$_SESSION["nombreComercial"]."'";
                                        $nombreOferta = "'".$_POST["nombreOferta"]."'";
                                        $descripcion = "'".$_POST["descripcion"]."'";
                                        $duracion = "'".$_POST["duracion"]."'";
                                        $fecha =  date('d-m-Y');
                                        $horario = "'".$_POST["horario"]."'";
                                        $salario = "'".$_POST["salario"]."'";
                                        $vacantes = "'".$_POST["vacantes"]."'";
                                        $requisito1 =  "'".$_POST["subcategoria0"]."'";
                                        $requisito2 =  "'".$_POST["subcategoria1"]."'";
                                        $actitud1 =  "'".$_POST["actitud0"]."'";
                                        $actitud2 =  "'".$_POST["actitud1"]."'";

                                        if(isset($_POST["observaciones"]))
                                        {
                                            $observaciones = "'".$_POST["observaciones"]."'";
                                        }
                                        else
                                        {
                                            $observaciones = "NULL";
                                        }

                                        $archivo = $_FILES["archivo"]["tmp_name"];
                                        $nombreArchivo = $_FILES["archivo"]["name"];
                                        $destino = "../archivos/".$nombreArchivo;

                                        $sql1 = "SELECT idFormacion FROM formacion WHERE subcategoria=".$requisito1;
                                        $objetoBBDD->consultarBD($sql1);
                                        $fila1 = $objetoBBDD->devolverFilas();
                                        $requisito1 = $fila1["idFormacion"];

                                        $sql2 = "SELECT idFormacion FROM formacion WHERE subcategoria=".$requisito2;
                                        $objetoBBDD->consultarBD($sql2);
                                        $fila2 = $objetoBBDD->devolverFilas();
                                        $requisito2 = $fila2["idFormacion"];

                                        if(isset($_POST["subcategoria2"]))
                                        {
                                            $requisito3 =  "'".$_POST["subcategoria2"]."'";
                                            $sql3 = "SELECT idFormacion FROM formacion WHERE subcategoria=".$requisito3;
                                            $objetoBBDD->consultarBD($sql3);
                                            $fila3 = $objetoBBDD->devolverFilas();
                                            $requisito3 = $fila3["idFormacion"];
                                        }
                                        else
                                        {
                                            $requisito3 = "NULL";
                                        }

                                        if(isset($_POST["subcategoria3"]))
                                        {
                                            $requisito4 =  "'".$_POST["subcategoria3"]."'";
                                            $sql4 = "SELECT idFormacion FROM formacion WHERE subcategoria=".$requisito4;
                                            $objetoBBDD->consultarBD($sql4);
                                            $fila4 = $objetoBBDD->devolverFilas();
                                            $requisito4 = $fila4["idFormacion"];
                                        }
                                        else
                                        {
                                            $requisito4 = "NULL";
                                        }

                                        if(isset($_POST["subcategoria4"]))
                                        {
                                            $requisito5 =  "'".$_POST["subcategoria4"]."'";
                                            $sql5 = "SELECT idFormacion FROM formacion WHERE subcategoria=".$requisito5;
                                            $objetoBBDD->consultarBD($sql5);
                                            $fila5 = $objetoBBDD->devolverFilas();
                                            $requisito5 = $fila5["idFormacion"];
                                        }
                                        else
                                        {
                                            $requisito5 = "NULL";
                                        }

                                        $sql6 = "SELECT idFormacion FROM formacion WHERE subcategoria=".$actitud1;
                                        $objetoBBDD->consultarBD($sql6);
                                        $fila6 = $objetoBBDD->devolverFilas();
                                        $actitud1 = $fila6["idFormacion"];

                                        $sql7 = "SELECT idFormacion FROM formacion WHERE subcategoria=".$actitud2;
                                        $objetoBBDD->consultarBD($sql7);
                                        $fila7 = $objetoBBDD->devolverFilas();
                                        $actitud2 = $fila7["idFormacion"];

                                        if(isset($_POST["actitud2"]) && $_POST["actitud2"] != "Opcion")
                                        {
                                            $actitud3 =  "'".$_POST["actitud2"]."'";
                                            $sql8 = "SELECT idFormacion FROM formacion WHERE subcategoria=".$actitud3;
                                            $objetoBBDD->consultarBD($sql8);
                                            $fila8 = $objetoBBDD->devolverFilas();
                                            $actitud3 = $fila8["idFormacion"];
                                        }
                                        elseif($_POST["actitud2"] == "Opcion")
                                        {
                                            $actitud3 =  "NULL";
                                        }

                                        if(copy($archivo,$destino))
                                        {
                                            $query = "INSERT INTO ofertas (idOferta,autor,empresa,nombre,descripcion,duracion,fechaOferta,horario,salario,numeroVacantes,observaciones,
                                                        archivoOferta,requisito1,requisito2,requisito3,requisito4,requisito5,actitud1,actitud2,actitud3) VALUES 
                                                          (DEFAULT, ".$autor.", ".$empresa.", ".$nombreOferta.", ".$descripcion.", ".$duracion.", '".$fecha."', ".$horario.", ".$salario.", ".$vacantes."
                                                          , ".$observaciones.", '".$nombreArchivo."', ".$requisito1.", ".$requisito2.", ".$requisito3.", ".$requisito4.", ".$requisito5.", 
                                                          ".$actitud1.", ".$actitud2.", ".$actitud3.");";

                                            $objetoBBDD->consultarBD($query);
                                            if($objetoBBDD->filasAfectadas()==1)
                                            {
                                                echo '<div style="color:green;font-weight: bold">Éxito al dar de alta la oferta de empleo.</div><br>';
                                            }
                                            else
                                            {
                                                echo '<div style="color:red;font-weight: bold">Error al dar de alta la oferta de empleo.</div><br>';
                                            }
                                            echo '<a href="buscarEmpresa.php"><button type="submit" class="btn btn-primary btn-md float-right">Volver</button></a>';
                                        }
                                    ?>
                                    </div>
								</div>
							</div>
						</section>
					</div>
				</section>
			</main>
		</div>
	</div>

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="../dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	
	<script src="../js/chart.min.js"></script>
	<script src="../js/chart-data.js"></script>
	<script src="../js/easypiechart.js"></script>
	<script src="../js/easypiechart-data.js"></script>
	<script src="../js/bootstrap-datepicker.js"></script>
	<script src="../js/custom.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="../js/cargarCategoria.js"> </script>
    <script src="../js/cargarSubCategoria.js"> </script>
    <script src="../js/mod_borrar_Formacion.js"> </script>
</body>
</html>