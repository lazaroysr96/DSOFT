<?php

if(file_exists("config.php")&&compruebe()){
     exit(header("location: index.php"));

}else if(isset($_POST["host"])){
	
	 $host = $_POST["host"];
	 $user = $_POST["user"];
	 $db_name = $_POST["db_name"];
	 $password = $_POST["pass"];

	   $connection = @new mysqli($host,$user,$password);
	   $database = $connection->select_db($db_name);
	   if($database){
	   if(writeConfigFile($host,$user,$db_name,$password)){
		   header("location: createuser.php");
		   }
		   }
		   }
//header("location: index.php");
 function compruebe(){
     include "config.php";
    $connection = @new mysqli(DB_HOST,DB_USER,DB_PASS);
	$database = $connection->select_db(DB_NAME);
	if($database){
return true;
}else{
    return false;
}
 }

 function writeConfigFile($host,$user,$db_name,$password)
    {
        $config_file    = @fopen('config.php', "w");

        if (!$config_file) {
            
            return false;
        }

        $data   = "<?php\n";
        $data   .= "defined('DB_HOST') ? NULL : define('DB_HOST', '".$host."');\n";
        $data   .= "defined('DB_USER') ? NULL : define('DB_USER', '".$user."');\n";
        $data   .= "defined('DB_PASS') ? NULL : define('DB_PASS', '".$password."');\n";
        $data   .= "defined('DB_NAME') ? NULL : define('DB_NAME', '".$db_name."');\n";
        $data   .= "?>";

        // create the new file
        if (fwrite($config_file, $data)) {

            fclose($config_file);
            
            return true;
        }
        
        // check if something was created and delete it
        if (file_exists($config_file)) {

            unlink($config_file);
        }
        
        return false;
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>D'SOFT</title>
<link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
	<style>
	.total-center{
	text-align:center;
    display:flex;
    flex-direction:column;
    justify-content:center;
}
	</style>
</head>
<body class="body-center">
    <div class="total-center">
        <form style='margin:0 auto;display:inline-block;max-width:300px;padding:10px;background:#345;border-radius:5px;' class="form-admin" action="install.php" method="POST">
	<div>
	  <img class="img-logo" src="logo.png"/>
    </div>
<div style='color:#def;padding:10px;text-align:center;font-weight:bold'>Instalación de la base de datos</div>
<label for="host">
<input placeholder="Host:" class="t1" name="host" id="host" type="text" required/>
</label>

<label for="db_name">
<input placeholder="DATABASE NAME:" class="t1" name="db_name" id="db_name" type="text" required/>
</label>

<label for="user">
<input placeholder="Usuario:" class="t1" name="user" id="user" type="text" required/>
</label>
<label for="pass">
<input placeholder="Contraseña:" class="t1" name="pass" id="pass" type="password"/>
</label>
<input type="submit" value="Instalar" class='rig'>
</form>
</div>


</body>
</html>
