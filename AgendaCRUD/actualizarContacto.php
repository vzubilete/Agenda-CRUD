<?php

if ($_POST)
{
	include("validador.php");
	include("mysql.php");
	$id_contacto = $_POST["id_contacto"];
	$nombres = $_POST["nombres"];
	$apellidos = $_POST["apellidos"];
	$direccion = $_POST["direccion"];
	$telefonos =str_replace(" ", "", $_POST["telefonos"]);
	$cadaTelefono = explode(",", $telefonos);
	$numeroInvalido = verificarTelefonos($cadaTelefono);

	if (count($numeroInvalido))
	{
		echo "Los siguientes números de teléfono son inválidos:";
		foreach($numeroInvalido as $n)
		{
			echo "<li>$n</li>";
		}
		exit();
	}

	$pst = $mysql->prepare("update contactos set nombres = ?, apellidos = ?, direccion = ? where id_contacto = ?");
	$pst->bind_param('sssi', $nombres, $apellidos, $direccion, $id_contacto);
	$resultado = $pst->execute();
	$pst = $mysql->prepare("delete from telefonos where id_contacto = ?");
	$pst->bind_param('i', $id_contacto);
	$pst->execute();
	$pst = $mysql->prepare("insert into telefonos values (null, {$id_contacto}, ?)");
	foreach($cadaTelefono as $telefono)
	{
		$pst->bind_param('s', $telefono);
		$pst->execute();
	}
		$mysql->close();
		header("Location:index.php");
} 
