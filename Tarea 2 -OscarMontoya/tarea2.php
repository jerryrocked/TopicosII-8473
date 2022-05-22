<html>
<head>
	<meta charset ="UTF-8"> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/documento.css">
	<title>Document</title>
	
	<title>Formularios</title>
</head>
<body>
    <header>
	<?php 
		session_start();
        $total=0;
        $comisionMIN=0;
        $comisionCOD=0;
        $comisionFORT=0;
        $comisionTOTAL=0;
		if (!isset($_SESSION['persona'])){
			$_SESSION['persona']= array();
		}
		if (isset($_POST['insertar'])){
			$rut = $_POST['RUT'];
			$nom = $_POST['NOM'];
			$ape = $_POST['APE'];
            $min = $_POST['MIN'];
            $fort = $_POST['FORT'];
            $cod = $_POST['COD'];
            $total;
            $comisionMIN;
            $comisionCOD;
            $comisionFORT;
            $comisionTOTAL;
            

			if (empty($rut)||empty($nom)||empty($ape)||empty($min)||empty($fort)||empty($cod)){
				echo "Rellena todos los valores";
			}else {
                $total=$min+$fort+$cod;
                $comisionFORT=((round($fort*58200)*9)/100);
                $comisionMIN=round((($min*8800)*4)/100);
                $comisionCOD=round((($cod*34500)*6)/100);
                $comisionTOTAL=$comisionCOD+$comisionFORT+$comisionMIN;
				$persona = array(
					"rut" => $rut,
					"Nombre" => $nom,
					"Apellido" => $rut,
                    "Minecraft" => $min,
                    "Fortnite" => $fort,
                    "Cod" => $cod,
                    "Total" => $total,
                    "comisioncod" => $comisionCOD,
                    "comisionmin" => $comisionMIN,
                    "comisionfort" => $comisionFORT,
                    "comisiontotal" => $comisionTOTAL,
                    
				); 
                }
				if (isset($_SESSION['persona'][$rut])){
					echo "Se ha modificado la Persona con el RUT: ".$rut;
				}else{
					echo "Se ha registrado la persona";
				}		
				$_SESSION['persona'][$rut]=$persona;
				print_r($_SESSION['persona']);	
			
        
		}else if (isset($_POST['vaciar'])){
			if (!isset($_POST['ruts'])){
				echo "No hay Personas seleccionadas";

			}else{	
				$ruts=$_POST['ruts'];
				print_r($ruts);

				foreach ($_SESSION['persona'] as $key =>$value){
					if (in_array($key,$ruts)){
						unset($_SESSION['persona'][$key]);
					}
				}
			echo "Persona(s) Borradas";
			}
		}

	?>
	<form method="post">
		<label for="RUT">RUT</label>
		<input type="text" id="RUT" name="RUT" />
		<br>
		<label for="NOM">NOMBRE</label>
		<input type="text" id="NOM" name="NOM" />
		<br>
		<label for="RUT">APELLIDO</label>
		<input type="text" id="APE" name="APE" />
		<br>
        <label for="MIN">Minecraft total</label>
		<input type="text" id="MIN" name="MIN" />
        <br>
        <label for="FORT">Fortnite total</label>
		<input type="text" id="FORT" name="FORT" />
        <br>
        <label for="COD">Cod total</label>
		<input type="text" id="COD" name="COD" />
        <br>
		<button type="submit" name="insertar">Insertar</button>
		<button type="submit" name="mostrar">Mostrar</button>
		<button type="submit" name="vaciar">Vaciar</button>
	

	<?php
		if (isset($_POST['mostrar'])){
			if (count($_SESSION['persona'])===0){
				echo "<p> No hay Personas </p>";
			}else {
				echo "<table border=1 width=100%>";
				echo "<tr>";
				echo "<th width=2%></th>";
				echo "<th width=11%>RUT</th>";
				echo "<th width=11%>NOMBRE</th>";
				echo "<th width=11%>APELLIDO</th>";
                echo "<th width=6%>Ventas MIN</th>";
                echo "<th width=6%>Ventas FORT</th>";
                echo "<th width=6%>Ventas COD</th>";
                echo "<th width=6%>Total de ventas</th>";
                echo "<th width=10%>Comision de ventas MIN</th>";
                echo "<th width=10%>Comision de ventas FORT</th>";
                echo "<th width=10%>Comision de ventas COD</th>";
                echo "<th width=11%>Comision Total</th>";
				echo "<tr>";
                

				foreach ($_SESSION['persona'] as $key => $value){
					?>
					<tr>
						<td><input type="checkbox" name="ruts[]" value="<?php echo $key; ?>"> </td>
						<td><?php echo $value['rut']; ?></td>
						<td><?php echo $value['Nombre']; ?></td>
						<td><?php echo $value['Apellido']; ?></td>
                        <td><?php echo $value['Minecraft']; ?></td>
                        <td><?php echo $value['Fortnite']; ?></td>
                        <td><?php echo $value['Cod']; ?></td>
                        <td><?php echo $value['Total'];?></td>
                        <td><?php echo $value['comisionmin'];?></td>
                        <td><?php echo $value['comisionfort'];?></td>
                        <td><?php echo $value['comisioncod'];?></td>
                        <td><?php echo $value['comisiontotal'];?></td>
					</tr>
					<?php 
				}
				echo "</table width=80%>";
			} 
		}
        ?>
        </header>
        </body>
        </html>