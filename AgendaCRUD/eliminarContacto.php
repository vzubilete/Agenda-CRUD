<?php

if ($_GET)
{
	include("mysql.php");
	$id_contacto = $_GET["id_contacto"];
	$mysql->begin_transaction();
	$pst = $mysql->prepare("delete from telefonos where id_contacto = ?");
	$pst->bind_param('i', $id_contacto);
	$pst->execute();
	$pst = $mysql->prepare("delete from contactos where id_contacto = ?");
	$pst->bind_param('i', $id_contacto);
	$pst->execute();
	$mysql->commit();
	header("Location:index.php");
} 
