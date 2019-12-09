<!DOCTYPE html>
<html>
<head>
	<title>AGENDA</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<div class="container">
	<h1>Agenda</h1>

<form method="post" action="guardarContacto.php">

	<p>
		<label>Nombres:</label>
		<input type="text" name="nombres" required="true" maxlength="64" minlength="3" placeholder="  Nombres" class="nombre">
	</p>

	<p>
		<label>Apellidos:</label>
		<input type="text" name="apellidos" required="true" maxlength="64" minlength="3" placeholder="  Apellidos" class="apellido">
	</p>

	<p>
		<label>Dirección:</label>
		<input type="text" name="direccion" required="true" maxlength="64" minlength="10" placeholder="  Dirección" class="direccion">
	</p>

	<p>
		<label class="telefono">Teléfonos (separados por comas):</label><br>
		<textarea name="telefonos" cols="30" placeholder="" maxlength="256" class="telefono"></textarea>
	</p>
	<input type="submit" value="Guardar" class="button">
	<input type="reset" value="Cancelar" class="button">
</form>
<br>
<table border="3" class="container">
<tr>
	<th>ID</th>
	<th>Apellidos</th>
	<th>Nombres</th>
	<th>Dirección</th>
	<th>Teléfonos</th>
</tr>
<?php
include("mysql.php");

$contactos = $mysql->query("select * from contactos");

foreach($contactos as $c)
{
	$telefonos = $mysql->query("select telefono from telefonos where id_contacto = {$c['id_contacto']}");

	echo "<tr>
			<td>{$c['id_contacto']}</td>
			<td>{$c['apellidos']}</td>
			<td>{$c['nombres']}</td>
			<td>{$c['direccion']}</td>";
	echo "<td>";
		foreach($telefonos as $t)
		{
			echo "<li>{$t['telefono']}</li>";
		}
	echo "</td>";

	echo "<td><a href='modificarContacto.php?id_contacto={$c['id_contacto']}'>Modificar</a></td>
			<td><a href='eliminarContacto.php?id_contacto={$c['id_contacto']}'>Eliminar</a></td>";

	echo "</tr>";
}
?>
</table>


</div>

</body>
</html>