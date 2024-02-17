<?php
include "core.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>D'SOFT - Diseño y Desarrollo Web</title>
    <meta name="robots" content="index, follow">
<link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="og:title" content="D'SOFT - Desarrollo Web"/>
           <meta name="og:type" content="article"/>
           <?php echo "\n<meta name=\"og:url\" content=\"http://".$_SERVER["HTTP_HOST"]."/servicios.php\"/>
           <meta name=\"og:image\" content=\"http://".$_SERVER["HTTP_HOST"]."/media/webmaster.jpg\"/>"?>
           <meta name="og:description" content="Diseño y Desarrollo Web, desde Cuba, para Cuba y para el mundo. "/>
</head>
<body>
<div class="site">
    <header>
    <div>
	  <img class="img-logo" src="logo.png"/>
    </div>
<div class="title"><span style="font-family: 'Comic Sans MS', cursive, sans-serif">Servicios</span></div>
  <nav>
  <?php
  writeHtml("media/bar.html");
  ?>
   </nav>
  </header>
<div class="content">
<div class="primary">
<article class="servi-main">
<header>
<h1 class="title">
Diseño y Desarrollo Web, desde Cuba, para Cuba y para el mundo.
</h1>

</header>
<div class="servi-description">
<img width="100%" src="media\webmaster.jpg">
<span style="line-height: 1.5">
<p>
Esta es la plataforma de servicios de desarrollo web y Webmasters D'SOFT perteneciente a UNISOFT-CUBA, Nuestra misión es prestar servicios de desarrollo web, así como Servicios de Web master, tanto para los Cubanos, cómo para el mundo. 
</p>
<p>
<b>Nuestro enfoque:</b>
<br>
Nos enfocamos en la construcción de webs minimalistas, utilizando código nativo, nuestro objetivo es que su web sea fácil de cargar bajo cualquier condición, incluso bajo condiciones poco propicias donde otras web nunca cargarían cómo zonas en las que la cobertura móvil o las velocidades de conexión a internet no sean muy eficientes. 
</p>
<b>Tecnologías utilizadas:</b>
<ul>
<li>PHP para los servidores.</li> 
<li>HTML, JavaScript y CSS para el diseño y desarrollo de su Web.</li> 
<li>MySQL para bases de datos.</li> 
</ul>
<p>
<b>Acerca de uso de los framework</b>
<br>
La utilización de framework y librerías conllevará siempre el aumento del tamaño de su web, lo que se traduce en una mayor carga de archivos por los navegadores y un rendimiento deficiente en ubicaciones geográficas donde las condiciones de conexión sean inestables, no recomendamos usar framework para webs minimalistas, sin embargo podemos adaptarnos a las necesidades del cliente, por lo que si su web está orientada a segmentos geográficos dónde las condiciones de conexión permitan la carga de páginas grandes podemos trabajar con el framework y u o librería que usted demande. 
</p>
<p>
<b>¿Que Podemos Hacer por usted?</b>
<br>
Si desea más información o contratar algún servicio rellene el formulario de solicitud de servicio, ofrecemos un servicio personalizado, una vez recibida su solicitud uno de nuestros programadores se pondrá en contacto con usted lo antes posible para responder cualquier duda o acordar la concertación de un servicio. 
</p>

</span>
</div>
</article>

</div><!--Primary-->



<div class="secondary">
  <aside>
  <div id='result' style="background:#234;display:inline-block;width:100%;padding:10px;border:1px solid #567;box-sizing:border-box;border-radius:5px;">
               <form class='form-admin' id='fr'>
                   <label class='title'>Formulario de solicitud</label>
                   <label>Nombre:<input type='text' id='name' name='name' required /></label>
                   <label>Correo:<input type='email' id='email' name='email'/></label>
                   <label>WhatsApp:<input type='tel' id='tel' name='tel' required/></label>
                   <label>Website:<input type='text' id='website' name='website'/></label>
                   <label>Comentario:<textarea id='mns' name='mns'></textarea></label>
                   <label id='info' style="color:red"></label>
                   <input type='button' class='rig' value='enviar' id="btn">
               </form>
           </div>
           <script src="js/servicios.js"></script>
   </aside>
</div> <!--Secondary-->

</div>  <!--content blog-->




<footer class="pie">
	<?php
	//writePie();
    include "media/footer.php"
?>
  </footer>


</div>

</body>
</html>





