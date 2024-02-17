<?php
include "core.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>D'SOFT - Estudantes</title>
<link rel="stylesheet" href="css/uni.css">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<div class="site">
    <header/>
    <div>
      <img class="img-logo" src="uni-logo.png"/>
    </div>
  <div class="cabezera">
    <div class="titulo">
    <div class="title">Estudiantes</div>
    <div class="subtitle">Contenidos de carácter educativo para estudiantes universitarios.</div>
    </div>
  <form class="form-buscar" method="get" action="uni.php">
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
<main class="primary">
     <script src="media/ckeditor.js"></script>
		<textarea type="text" name="txtDescripcion" id="txtDescripcion"></textarea>
		<script>
        ClassicEditor
            .create( document.querySelector( '#txtDescripcion' ) )
            .catch( error => {
            console.error( error );
            } );
        </script>
</main>
<aside class='secondary'>
    <?php include 'media/aside_uni.php' ?>
</aside>
</div>  <!--content blog-->



<footer class="pie">
    <?php
    include "media/footer.php"
?>
  </footer>


</div>

</body>
</html>