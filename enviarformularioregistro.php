<?php 
	$id_producto = $_POST['id_producto'];
	$id_proveedor = $_POST['id_proveedor'];
	$nombre = $_POST['nombre'];
	$precio = $_POST['precio'];
	$cantidad = $_POST['cantidad'];
	$imagen = $_POST['files'];

	mysql_connect("localhost", "root", "") or die(mysql_error());
	mysql_select_db("ferreteriabd") or die(mysql_error());

	$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
    $limite_kb = 16384;

    if (in_array($_FILES['files']['type'], $permitidos) && $_FILES['files']['size'] <= $limite_kb * 1024)
    {

        // Archivo temporal
        $imagen_temporal = $_FILES['files']['tmp_name'];

        // Tipo de archivo
        $tipo = $_FILES['files']['type'];

        // Leemos el contenido del archivo temporal en binario.
        $fp = fopen($imagen_temporal, 'r+b');
        $data = fread($fp, filesize($imagen_temporal));
        fclose($fp);
        
        //Podríamos utilizar también la siguiente instrucción en lugar de las 3 anteriores.
        // $data=file_get_contents($imagen_temporal);

        // Escapamos los caracteres para que se puedan almacenar en la base de datos correctamente.
        $data = mysql_escape_string($data);

        $resultado = @mysql_query("INSERT INTO `t_productos`(`id_producto`, `id_proveedor`, `nombre`, `precio`, `cantidad`, `imagen`, `tipo`) VALUES ('$id_producto','$id_proveedor','$nombre','$precio','$cantidad','$imagen','$tipo')");

        if ($resultado)
        {
            echo "El archivo ha sido copiado exitosamente.";
        }
        else
        {
            echo "Ocurrió algun error al copiar el archivo.";
        }
    }
    else
    {
        echo "Formato de archivo no permitido o excede el tamaño límite de $limite_kb Kbytes.";
    }
 ?>