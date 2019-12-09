<?php

if ($_POST)
{
	include("mysql.php");
	include("validador.php");
	$nombres = $_POST["nombres"];
	$apellidos = $_POST["apellidos"];
	$direccion = $_POST["direccion"];
	$telefonos = str_replace(" ", "", $_POST["telefonos"]);
	$cadaTelefono = explode(",", $telefonos);
	$numeroInvalido = verificarTelefonos($cadaTelefono);
	
	if(count($numeroInvalido))
	{
		echo "Los siguientes números de teléfono son inválidos:";
		foreach($numeroInvalido as $n)
		{
			echo "<li>$n</li>";
		}
		echo "<a href='index.php'>Regresar</a>";
		exit();
	}
	$mysql->begin_transaction();
	$pst = $mysql->prepare("insert into contactos values (null, ?, ?, ?)");
	$pst->bind_param('sss', $nombres, $apellidos, $direccion);
	/*
		i = enteros
		d = dobles o decimales
		s = cadenas
		b = booleanos
	*/
	$resultado = $pst->execute();
	$id_contacto = $mysql->insert_id;
	$pst = $mysql->prepare("insert into telefonos values (null, {$id_contacto}, ?)");
	foreach($cadaTelefono as $telefono)
	{
		$pst->bind_param('s', $telefono);
		$pst->execute();
	}
	if ($resultado)
	{
		$mysql->commit();
		header("Location:index.php");
	}
	else
	{
		$mysql->rollback();
		echo "El contacto no pudo ser guardado.";
	}
} 
