<?php
include "core.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>D'SOFT - Camapé</title>
    <meta name="robots" content="index, follow">
<link rel="stylesheet" href="css/revolico.css">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="Bienvenido al camapé, Encuentra productos de primer calidad en Cuba, Todo lo que usted requiera para su hogar o su negocio.">
    <?php
    if(isset($_GET['id'])&&getDataBase()){

       $resultados = query("SELECT * FROM productos WHERE id=".$_GET['id']);

       while($resultado=$resultados->fetch_array()){
           $url = $resultado["url"];
           $name= $resultado["name"];
           $description=$resultado["description"];
           $id=$resultado["id"];
           echo "
           <meta name=\"og:title\" content=\"$name\"/>
           <meta name=\"og:type\" content=\"article\"/>
           <meta name=\"og:url\" content=\"http://".$_SERVER["HTTP_HOST"]."/tienda.php?id=".$id."\"/>
           <meta name=\"og:image\" content=\"http://".$_SERVER["HTTP_HOST"]."/".$url."\"/>
           <meta name=\"og:description\" content=\"$description\"/>";

    }
    }else{
        echo "
           <meta name=\"og:title\" content=\"Tienda Camapé\"/>
           <meta name=\"og:type\" content=\"article\"/>
           <meta name=\"og:url\" content=\"http://".$_SERVER["HTTP_HOST"]."/tienda.php\"/>
           <meta name=\"og:image\" content=\"http://".$_SERVER["HTTP_HOST"]."/media/images/logotipo-tienda.png\"/>
           <meta name=\"og:description\" content=\"Plataforma Camapé, Encuentra productos de primer calidad en Cuba, Todo lo que usted requiera para su hogar o su negocio.\"/>";
    }
    ?>

</head>
<body>
<div class="site">
    <header/>
    <div>
	  <img class="img-logo" src="revolico.png"/>
    </div>
  <div class="cabezera">
	<div class="titulo">
	<div class="title">Plataforma de ventas Camapé</div>
	<div class="subtitle">Productos de primera calidad en Las Tunas, Cuba.</div>
	</div>
  <form class="form-buscar" method="get" action="tienda.php">
	<input type="search" class="buscar" name="s" id="s"/>
    <input type="submit"  value="&nbsp;"/>
    <!--<input type="submit" value="Buscar" />-->
  </form>
  </div>
<?php
  writeHtml("media/bar.html");
 ?>
 </header>
<div class="content">
<main>
     <?php
    if(isset($_GET['id'])){
     include "media/chop_article.php";
    }else{
     include "media/chop.php";
    }
     ?>
</main>
</div>  <!--content blog-->




<footer class="pie">
<p><b>Acerca de...</b><br>
Transparencia de la Tienda. Proporcionamos esta información por que pueda verificar la autenticidad de los productos aquí expuestos, esta tienda reside geográficamente en Las Tunas, Cuba. Nuestra tienda sólo hace el rol de ente intermediario ente el cliente y el vendedor, si como vendedor desea publicar un producto en nuestra plataforma deberá enviar un correo electrónico a la dirección proporcionada en este pilé de página, para los clientes tenemos el formulario de solicitud.
</p>
<p><b>Acerca de este proyecto</b><br>
D’SOFT-CAMAPÉ es un proyecto de Tienda On-Line desde la que usted podrá mostrarle a sus clientes los productos que tiene a la venta, Si desea implementar un sistema como este contacte con el administrador mediante la dirección de correo electrónico proporcionada aquí.
</p>
<p>
<b>Webmaster:</b> Lazaro Yunier Salazar Rodriguez<br>
<b>Correo Electrónico:</b> <a href="mailto:lazaroyunier96@nauta.cu">lazaroyunier96@nauta.cu</a><br>
</p>
<p>
<b>Meta:</b>
<br><a href="login.php">Admin</a>
</p>
<a href="terms.html">Términos y condiciones</a><br>

<p>D'SOFT-CAMAPÉ Esta Trabajando con <b>LYSR-BLOG</b> Versión 20.01.2024
<br>
©2024 <b>lazaroysr96</b> Derechos Reservados</p>
  </footer>


</div>

</body>
</html>