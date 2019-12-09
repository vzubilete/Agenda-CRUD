<!DOCTYPE html>
<html>
<head>
	<title>Modificar</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<h1>Modificar</h1>
<form method="post" action="actualizarContacto.php">
<?php
include("mysql.php");
$id_contacto =mysqli_escape_string($mysql, $_GET["id_contacto"]);
$datosContacto = $mysql->query("select * from contactos where id_contacto = {$id_contacto}");
$datos = $datosContacto->fetch_array();

$telefonos = $mysql->query("select telefono from telefonos where id_contacto = {$id_contacto}");
?>

	<p>
		<label>ID</label>
		<input type="text" name="id_contacto" value="<?php echo $id_contacto; ?>" readonly=true>
	</p>
	
	<p>
		<label>Nombres</label>
		<input type="text" name="nombres" required="true" maxlength="64" minlength="3" placeholder="Nombres" value="<?php echo $datos['nombres']; ?>">
	</p>

	<p>
		<label>Apellidos</label>
		<input type="text" name="apellidos" required="true" maxlength="64" minlength="3" placeholder="Apellidos" value="<?php echo $datos['apellidos']; ?>">
	</p>

	<p>
		<label>Dirección</label>
		<input type="text" name="direccion" required="true" maxlength="64" minlength="10" placeholder="Dirección" value="<?php echo $datos['direccion']; ?>">
	</p>

	<p>
		<label>Teléfonos (separados por comas)</label><br>
		<textarea name="telefonos" cols="40" placeholder="#########" maxlength="256"><?php 
		$total = $telefonos->num_rows;
		$i = 0;
		foreach($telefonos as $telefono)
		{
			echo $telefono['telefono'];
			$i++;
			if ($i != $total)
			{
				echo ", ";
			}
		} 
		?></textarea>
	</p>
	<input type="submit" value="Guardar">
	<input type="reset" value="Cancelar">
</form>

</body>
</html> 
