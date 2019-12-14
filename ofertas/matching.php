<?php
    session_start();
    require('../conexion/Conexion.php');
    $objetoBBDD = new Conexion();
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
    <style>#descripcion{resize: none}</style>
	<!-- Bootstrap core CSS -->
	<link href="../dist/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Icons -->
	<link href="../css/font-awesome.css" rel="stylesheet">
	
	<!-- Custom styles for this template -->
	<link href="../css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>
<body >
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
                                    <h4><i>Matching de alumnos con la oferta</i></h4>
									<div class="card-block">
                                        <?php
                                            $idOferta = $_GET["idOferta"];

                                            $sql = "SELECT distinct alumnos.NIA,  alumnos.apellidos_nombre, alumnos.correo, orden_requisitos.TOTAL FROM alumnos INNER JOIN orden_requisitos ON alumnos.NIA = orden_requisitos.NIA";
                                            $objetoBBDD->consultarBD($sql);
                                            echo '<h6>Listado de alumno con mas requistos cumplidos</h6><br>';
                                            while($fila = $objetoBBDD->devolverFilas())
                                            {
                                                echo '<div class="card-block">';
                                                    echo '<b>NIA: </b>'.$fila["NIA"].'&nbsp; ';
                                                    echo '<b>Nombre: </b><a href="../alumnos/listarAlumnoCompleto.php?nia='.$fila["NIA"].'&nombre='.$fila["apellidos_nombre"].'">'.$fila["apellidos_nombre"].'&nbsp; </a>';
                                                    echo '<b>Correo: </b>'.$fila["correo"].'&nbsp;';
                                                    echo '<b>TOTAL: </b>'.$fila["TOTAL"];
                                                echo '</div>';
                                            }

                                            $comprobar = "SHOW tables like 'oferta_formacion'";
                                            $objetoBBDD->consultarBD($comprobar);
                                            if($objetoBBDD->devolverFilas()==0)
                                            {
                                                $consulta = "create  table orden_requisitos(NIA char(7),TOTAL tinyint unsigned)";
                                                $objetoBBDD->consultarBD($consulta);

                                                $query1 = "create  table oferta_formacion(idOferta tinyint unsigned,idFormacion tinyint unsigned);";
                                                $objetoBBDD->consultarBD($query1);

                                                $query2 = "insert into oferta_formacion 
                                                        select idOferta, requisito1
                                                          from ofertas
                                                        where idOferta=".$idOferta.";  
                                                        
                                                        insert into oferta_formacion 
                                                        select idOferta, requisito2
                                                          from ofertas
                                                        where idOferta=".$idOferta.";  
                                                        
                                                        insert into oferta_formacion 
                                                        select idOferta, requisito3
                                                          from ofertas
                                                        where idOferta=".$idOferta.";  
                                                        
                                                        insert into oferta_formacion 
                                                        select idOferta, requisito4
                                                          from ofertas
                                                        where idOferta=".$idOferta."; 
                                                        
                                                        insert into oferta_formacion 
                                                        select idOferta, requisito5
                                                          from ofertas
                                                        where idOferta=".$idOferta."; 
                                                        
                                                        insert into oferta_formacion 
                                                        select idOferta, actitud1
                                                          from ofertas
                                                        where idOferta=".$idOferta."; 
                                                        
                                                        insert into oferta_formacion 
                                                        select idOferta, actitud2
                                                          from ofertas
                                                        where idOferta=".$idOferta.";    
                                                           
                                                        insert into oferta_formacion 
                                                        select idOferta, actitud3
                                                          from ofertas
                                                        where idOferta=".$idOferta.";";
                                                $objetoBBDD->consultarBDMulti($query2);



                                               $query4 = "INSERT INTO orden_requisitos SELECT NIA, COUNT(*) AS Total FROM alumnos_formacion inner join oferta_formacion
                                                        ON alumnos_formacion.idFormacion=oferta_formacion.idFormacion WHERE idOferta=".$idOferta." GROUP BY NIA 
                                                        ORDER BY COUNT(*) DESC;";
                                               $objetoBBDD->consultarBD($query4);

                                                //QUERY PARA INSERTAR

                                                /*INSERT INTO orden_requisitos (SELECT NIA, COUNT(*) AS Total FROM alumnos_formacion inner join oferta_formacion
                                                    ON alumnos_formacion.idFormacion=oferta_formacion.idFormacion WHERE idOferta=2 GROUP BY NIA ORDER BY COUNT(*) DESC);*/

                                            }
                                            /*else
                                            {
                                               $sql = "DROP TABLE oferta_formacion, orden_requisitos";
                                               $objetoBBDD->consultarBD($sql);
                                               echo '<div style="color:black;">Se han reajustado los valores. Recargue la página.</div><br>';
                                            }*/

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
    <script>

    </script>
</body>
</html>