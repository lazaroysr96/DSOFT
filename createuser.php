<?php
include "core.php";
if(isExisteAdmin()){
    exit(header("location: login.php"));
}
     if(isset($_POST['name'])&&isset($_POST['lastname'])&&isset($_POST['email'])&&isset($_POST['tel'])&&isset($_POST['token'])&&isset($_POST['user'])&&isset($_POST['pass'])){
	 $name = $_POST["name"];
	 $lastname = $_POST["lastname"];
	 $email = $_POST["email"];
	 $tel = $_POST["tel"];
	 $token = $_POST["token"];
	 $user = $_POST["user"];
	 $password = $_POST["pass"];
	 $password = sha1($password);

	 if($token=="@935226"){
		 if(getDataBase()){
	   

	   query("INSERT INTO users (name,lastname,email,tel,user,password) VALUES ('$name','$lastname','$email','$tel','$user','$password')");
	   header("location: login.php");
	   

   }
	 }
     }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>D'SOFT</title>
<link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<div class="site">
    <div>
	  <img class="img-logo" src="logo.png"/>
    </div>
<ul class="bar">
<li class="option-bar">Crear cuenta</li>
</ul>
<div class="content center">

<form class="form-admin peque" action="createuser.php" method="POST">
<input type="text" placeholder="Nombre" name="name" id="name" required/>
<input type="text" placeholder="Apellidos" name="lastname" id="lastname" required/>
<input type="email" placeholder="Correo" name="email" id="email" valid="email" required/>
<input type="text" placeholder="Teléfono" name="tel" id="tel" required/>
<input type="text" placeholder="Token" name="token" id="token"/>
<input type="text" placeholder="Usuario" name="user" id="user" required/>
<input placeholder="Contraseña" name="pass1" id="pass1" type="password" required/>
<input placeholder="Repetir Contraseña" name="pass" id="pass" type="password" required/>
<div class="block center">
<input type="submit" value="Crear Cuenta">
</div>
</form>
</div>  <!--content blog-->




<div class="pie">


</div>
</div>

</body>
</html>
