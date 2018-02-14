<?php

$link = mysql_connect('localhost', 'root', '') or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('caroyhug_wedding_system') or die('No se pudo seleccionar la base de datos');

if (isset($_POST["val"])) {
	$val=$_POST["val"];
	if ($val!='') {
		$queryRes = "SELECT Nombre, IdInvitacion FROM invitacion WHERE Nombre LIKE '".$val."%' AND Rsvp='Por confirmar' ORDER BY Nombre LIMIT 5";
		$res = mysql_query($queryRes) or die('Consulta fallida: ' . mysql_error());
		$arrayResult=array();
		$c=0;
		while($resultInvitacion = mysql_fetch_assoc($res)) {
	    	$arrayResult[$c]=[utf8_encode($resultInvitacion['IdInvitacion']),utf8_encode($resultInvitacion['Nombre'])];
	    	$c++;
		}
		print_r(json_encode($arrayResult));
	}
}

if (isset($_POST['IdInvitacion']) && !isset($_POST['Nombre'])) {
	$IdInvitacion=$_POST['IdInvitacion'];
	$queryRes = "SELECT Nombre, IdInvitacion, Email, Whatsapp FROM invitacion WHERE IdInvitacion='".$IdInvitacion."'";
	$res = mysql_query($queryRes) or die('Consulta fallida: ' . mysql_error());
	$arrayResult=array();
	while($resultInvitado = mysql_fetch_assoc($res)) {
		$arrayResult['IdInvitacion']=utf8_encode($resultInvitado['IdInvitacion']);
		$arrayResult['Nombre']=utf8_encode($resultInvitado['Nombre']);
		$arrayResult['Email']=utf8_encode($resultInvitado['Email']);
		$arrayResult['Whatsapp']=utf8_encode($resultInvitado['Whatsapp']);
	}
	print_r(json_encode($arrayResult));
}

?>
