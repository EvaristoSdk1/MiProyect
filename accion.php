<?php 
$accion = $_GET['ac'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$conexion = mysqli_connect("localhost","root","","formulario_registro");


switch ($accion) {
	case 1:
		# code...
		mysqli_query($conexion,"INSERT INTO registro values('$nombre','$apellidos','$correo','$password','$password2')");
		echo "Datos agregados correctamente";
		break;
	
	default:
		# code...
		break;
}
?>