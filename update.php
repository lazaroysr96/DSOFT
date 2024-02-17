<?php
include "core.php";
if(!isLogin()){
   exit( header("location: login.php"));
}
if(isset($_POST["user"])){
if(getUser($_POST["user"],$_POST["pass"])!=""){
	
	$type =$_POST["tipo"];
		if($type=="FILE"){
		updateFromFile();
		}else{
		updateFromZip();
		}
	
}
}



function updateFromFile(){
	
	$path = $_POST['path']. basename($_FILES['archivo']['name']); 
 
if(move_uploaded_file($_FILES['archivo']['tmp_name'], $path)) {
    mns("El archivo <a href='$path'><strong>".  basename( $_FILES['archivo']['name']). "</strong></a> ha sido subido correctamente<br><a href='update.php'>Subir un nuevo archivo</a>");
exit();
	
} else{
    mns("El archivo no se ha subido correctamente");
    exit();
}
}

function updateFromZip(){
	
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>D'SOFT</title>
<link rel="stylesheet" href="css/revolico.css">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>

<body style="text-align:center">

<form style="max-width:300px;display:inline-block;margin-top:20px;margin-bottom:20px;" class='formulario' action="update.php" enctype="multipart/form-data" method="post">
<label class='formulario-title'>Actualizar</label>

<label><input id='archivo' name='archivo' type='file'></label>
<label><input id='path' name='path' type='text' placeholder='Ruta'></label>
<label><select id='tipo' name='tipo'>
<option value="FILE">FILE</option>
<option value="ZIP">ZIP</option>
</select></label>
<label><input id='user' name='user' type='text'  placeholder='Usuario'></label>
<label><input id='pass' name='pass' type='password' placeholder='Contraseña' /></label>
<label><input class='btn-comprar' type='submit' value='Enviar'><label>
</form>

</body>
</html>