<?php

$link = mysql_connect('localhost', 'root', '') or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('caroyhug_wedding_system') or die('No se pudo seleccionar la base de datos');

if (isset($_POST['De']) && isset($_POST['Email']) && isset($_POST['Felicitacion'])) {
	$quitar = array("'",'"',"*","<?","?>","<?php");

	$De           =$_POST['De'];
	$De = str_replace($quitar, "", $De);
	$De = stripslashes($De);
	$De = iconv('UTF-8', 'windows-1252', $De);

	$Email        =$_POST['Email'];
	$Email = str_replace($quitar, "", $Email);
	$Email = stripslashes($Email);
	$Email = iconv('UTF-8', 'windows-1252', $Email);

	$Felicitacion =$_POST['Felicitacion'];
	$Felicitacion = str_replace($quitar, "", $Felicitacion);
	$Felicitacion = stripslashes($Felicitacion);
	$Felicitacion = iconv('UTF-8', 'windows-1252', $Felicitacion);

	$Aprobacion   ="Por aprobar";
	$queryRes = "INSERT INTO felicitacion (De, Email, Felicitacion, Aprobacion) VALUES ('".$De."','".$Email."','".$Felicitacion."','".$Aprobacion."')";
	$res = mysql_query($queryRes) or die('Consulta fallida: ' . mysql_error());
	if ($res) {
		echo "success";
	}else{
		echo "error";
	}
}else{
	echo "error de post";
}

?>
