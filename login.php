<?php
include "core.php";
if(!isExisteAdmin()){
	exit(header("location: createuser.php"));
}
if(isLogin()){
  header("location: admin.php");
}else if(isset($_POST["user"]) && isset($_POST["pass"])&&(getUser($_POST["user"],$_POST["pass"]))){
 $_SESSION['isLogin']	= true;
 header("location: admin.php");
}else{
    if(isset($_POST["user"]) && isset($_POST["pass"])){
      $err="Usuario o contraseña incorrecto, verifique los siguientes datos <br><strong>Usuario:</strong> (".$_POST["user"].")<br><strong>Contraseña:</strong>(".$_POST["pass"].")";
    }

}


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>D'SOFT - Login</title>
<link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body class="body-center">
<div class="site center">
<center>
<form class="form-admin extra" action="login.php" method="POST">
<div class="title">Iniciar Sesión</div>
<div style="color:red;"><?php if(isset($err)){echo $err;}?></div>
<input type="text" placeholder="Usuario" name="user" id="user" required />
<input placeholder="Contraseña" name="pass" id="pass" type="password" required />
<div class="block center">
<center>
<input type="submit" value="Acceder">
</center>
</div>
</form>
</center>
	</div>
	</body>
	</html>