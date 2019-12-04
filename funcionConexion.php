<?php
function conexion($bbdd){
    $con = mysqli_connect('localhost', 'root', '',$bbdd)or die('No se pudo conectar: ' . mysql_error());
    mysqli_set_charset($con,'utf8');
    return $con;
}
	

	?>