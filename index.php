<?php
include "core.php";
if(isset($_GET['post_id'])){
    $post_id=$_GET['post_id'];
        $resultados = query("SELECT * FROM entradas WHERE id=$post_id");
         $title="";
         $entrada="";
         $autor="";
         $fecha="";
		 $description='';
	   while($resultado=$resultados->fetch_array()){
		   $title= $resultado["title"];
		   $entrada=$resultado["entrada"];
           $autor=$resultado["autor"];
           $fecha=$resultado["fecha"];
		   if(isset($resultado["description"])){
		   $description=$resultado["description"];
		   $image=$resultado["image"];
		   }
           }
		   
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>D'SOFT<?php if(isset($title)){echo " - ".$title;}?></title>
    <meta name="robots" content="index, follow">
    <meta name="google-site-verification" content="d_5lUSQjiA3UYv1SiUP7ddg6jkP8qwyL9jVpzdAr_Lw">
    <meta name="description" content="Blog sobre programación y desarrollo de software"/>
<meta name="author" content="Lazaro Yunier Salazar Rodriguez">
<link rel="icon" href="media/images/icon64.png"/>
<link rel="manifest" href="dsoft.webmanifest" />
<link rel="stylesheet" href="css/style.css"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<meta name="og:type" content="article"/>
		   <?php
				if(isset($_GET["post_id"])){
				echo "
		<meta name=\"og:title\" content=\"$title\"/>
		<meta name=\"og:url\" content=\"http://".$_SERVER["HTTP_HOST"]."/index.php?post_id=$post_id\"/>";
				if(isset($image)&file_exists($image)){
					echo "
		<meta name=\"og:image\" content=\"http://".$_SERVER["HTTP_HOST"]."/$image\"/>";
				}else{
					echo "
		<meta name=\"og:image\" content=\"http://".$_SERVER["HTTP_HOST"]."/media/logo.png\"/>";
				}
				
				if((!($description==""))){
					echo "
		<meta name=\"og:description\" content=\"$description\"/>";
				}else{
					echo "
		<meta name=\"og:description\" content=\"Multiplataforma Web | Blog sobre programación y desarrollo de software.\"/>";
				}
				
				}else{
		   echo "\n
				<meta name=\"og:title\" content=\"D'SOFT - lazaroysr96\"/>
				<meta name=\"og:url\" content=\"http://".$_SERVER["HTTP_HOST"]."/index.php\"/>
				<meta name=\"og:image\" content=\"http://".$_SERVER["HTTP_HOST"]."/media/logo.png\"/>
				<meta name=\"og:description\" content=\"Multiplataforma Web | Blog sobre programación y desarrollo de software.\"/>
				";
				}
		   ?>
           
</head>
<body>
<div class="site">
    <header>
    <div>
	  <img class="img-logo" src="logo.png"/>
    </div>
  <div class="cabecera">
	<div class="titulo">
	<h1 class="title-1"><span style="color:red">D'</span><span style="color:#0F0">SOFT</span></h1>
	<h2 class="subtitle-1"><span style="color:#0F0">Blog sobre programación y desarrollo de software</span></h2>
	</div>
    <div class="container-cabecera"><form class="form-buscar" method="get" action="index.php">
	<input type="search" name="s" id="s">
	<input type="submit" value="Buscar">
  </form></div>
  </div>
  <nav>
  <?php
  writeHtml("media/bar.html");
  ?>
   </nav>
  </header>
<div class="content">
<div class="primary">
<div class='contenedor-de-articulos'>
<?php 
   if(getDataBase()){

	   
	   if(isset($_GET["s"])){
	   $s =$_GET["s"]; 
	   $resultados = query("SELECT * FROM entradas WHERE (title LIKE '%$s%' OR entrada LIKE '%$s%')");
	  if(mysqli_num_rows($resultados) > 0){
		  echo "<div class='title'>Resultados para $s</div>";
	   writePreEntradas($resultados);
	  }else{
		  echo "No se han encontrado resultados para $s";
	  }
	   } else if(isset($_GET['post_id'])){
           $img="";
		   if(isset($image)){
			$img="<img style='width:100%;display:block' src=\"$image\">";
		   }
		   echo "
           <article class='post'>
           <header>
		   $img
           <h1 class=\"post-title\">$title</h1>
		   
           </header>
           <div class='post-info'><span class='author'><strong>Publicado por:</strong> $autor</span> <strong>el</strong> <time>$fecha</time></div>
           <div class='post-entrada'>
		   
           $entrada
           </div>
           </article>";

	   }else{
	   writePreEntradas(query("SELECT * FROM entradas ORDER BY id DESC"));
	   }
   }
?>
</div>
</div><!--Primary-->


  <aside class="secondary">
  <div class='contenedor-de-widgets'>
  <?php include "media/aside.php";?>
  </div>
  </aside> <!--Secondary-->

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