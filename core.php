<?php
session_start();
include "database.php";

if(isset($_SESSION['count'])){
    $_SESSION['count']++;
}else{
    $_SESSION['count']=1;
    query("update visitas set visitas=".(getVisitas()+1)." where fuente=0");
}




function writeHtml($path){
	$mns = fopen($path,"r");
	if($mns==0){
		echo "Archivo no encontrado";
	}else{
		echo fread($mns,filesize($path));
	}
}


function seo_url($vp_string){
   $vp_string = trim($vp_string);
   $vp_string = html_entity_decode($vp_string);
   $vp_string = strip_tags($vp_string);
   $vp_string = strtolower($vp_string);
   $vp_string = preg_replace('~[^ a-z0-9_.]~', ' ', $vp_string);
   $vp_string = preg_replace('~ ~', '-', $vp_string);
   $vp_string = preg_replace('~-+~', '-', $vp_string);
   $vp_string .= "/";
   return $vp_string;
}

function writePreEntradas($resultados){
	while($resultado=$resultados->fetch_array()){
		   $id = $resultado["id"];
		   $t1= $resultado["title"];
           $e1=strip_tags($resultado["entrada"]);
		   $e1=substr($e1,0,300);
           $autor=$resultado["autor"];
           $fecha=$resultado["fecha"];
		   $image="";
		   if(isset($resultado["image"])){
			$img=$resultado["image"];
			$image="<img src=\"$img\">";
		   }

		   echo "
           <article class=\"card\">
           <h2 class=\"post-title\"><a href=\"index.php?post_id=$id\">$t1</a></h2>
           <div class='post-info'><span class='author'><strong>Publicado por:</strong> $autor</span> <strong>el</strong> <time>$fecha</time></div>
           $image
		   $e1...<a href=\"index.php?post_id=$id\">Seguir leyendo</a>
           </article>";

	   }
}

function writeVentas($resultados){
	while($resultado=$resultados->fetch_array()){
		   $url = $resultado["url"];
		   $name= $resultado["name"];
		   $precio=$resultado["precio"];
		   $moneda=$resultado["moneda"];
		   $id=$resultado["id"];
		   $provincia=$resultado["provincia"];
           $description=$resultado["description"];
		   
		   echo "<div class=\"card-box\"><div class=\"card\">
	<img src=\"$url\"/>
	<span class=\"card-name\">$name</span>
	<div class='card-detalle'>$description</div>
	<table>
	<tr>
		<td>Disponible en:</td><th>$provincia</th>
	  </tr>
	  <tr>
		<td>Precio:</td><th>$ $precio.00 $moneda</th>
	  </tr>
	</table>
	<a href=\"tienda.php?id=$id\"><input class=\"btn-comprar\" type=\"button\" value=\"Ver detalles\"/></a>
  </div></div>";
	   
	   }
}
function mns($mns){
	echo "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\">
    <title>D\'SOFT - Mensaje</title>
<link rel=\"stylesheet\" href=\"revolico.css\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\"/>
</head>
<body class='card'>
<div class='card' style='padding:20px;font-size:20px;margin-top:20px;box-sizing:border-box;'>
$mns
</div>
</body>
</html>";
}
function isLogin(){
    if(isset($_SESSION['isLogin'])&&$_SESSION['isLogin']){
        return true;
    }else{
        return false;
    }
}
?>

