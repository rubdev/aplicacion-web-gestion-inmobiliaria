<?php 
	session_start();
	setcookie('datos','',time()-1,'/'); // Elimino la cookie
	$_SESSION = array(); // Limpio el array $_SESSION
	session_destroy(); // Elimino la sesión
	header('Location: ../index.php');
 ?>