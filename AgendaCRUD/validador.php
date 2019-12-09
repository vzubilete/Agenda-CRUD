<?php

function validarTelefono(string $telefono): int
{
	return preg_match("/^\d{9}$/", $telefono);
}


function verificarTelefonos(array $telefonos):array
{
	$numeroInvalido = [];
	$i = 0;
	foreach($telefonos as $telefono)
	{
		if(!validarTelefono($telefono))
		{
			$numeroInvalido[$i] = $telefono;
			$i++;
		}
	}
	return $numeroInvalido;
}
?>