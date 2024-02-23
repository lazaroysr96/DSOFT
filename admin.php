<?php
include "core.php";

if(!isLogin()){
  exit(header("location: login.php"));
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>D'SOFT - Admin</title>
<link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>

<div class="site">

    <header>
    <div>
	  <img class="img-logo" src="logo.png"/>
    </div>
	<div class="title">
Panel de administración
</div>
<?php
  writeHtml("media/bar.html");
  ?>
  </header>



<div class="admin-main">


<aside class="admin-aside">

  <span id='btn-menu'><h3>Menu<i class='material-icons rig'>menu</i></h3></span>

  <ul id="menu" class="admin-menu">
  
      <li class="adminmenu">
          <div class='amo'>
              <i class='material-icons lef'>home</i>
              <span class='omt lef'>Inicio</span>
          </div>
          <ul class="admin-menu-item">
          <li onclick="mostrar('home');">Visión general</li>
          <li onclick="mostrar('servicios');">Solicitudes de servicios</li>

        </ul>

      </li>
  <li class="adminmenu">
      <div class='amo'>
          <i class='material-icons lef'>edit</i>
          <span class='omt lef'>Blog</span>
      </div>
        <ul class="admin-menu-item">
          <li onclick="mostrar('entradas');">Entradas</li>
          <li onclick="mostrar('add-entrada');">Añadir entrada</li>
          <li onclick="mostrar('add-categoria');">Categorias</li>
        </ul>
  </li>


      <li class="adminmenu">
          <div class='amo'>
              <i class='material-icons lef'>store</i><span class='omt lef'>Tienda</span>
          </div>
      <ul class="admin-menu-item">
          <li onclick="mostrar('articulos');">Productos</li>
          <li onclick="mostrar('add-producto');">Añadir producto</li>
          <li onclick="mostrar('compras');">Ventas</li>
      </ul>
      </li>


      <li class="adminmenu">

          <div class='amo'>
              <i class='material-icons lef'>poll</i><span class='omt lef'>Encuestas</span>
          </div>

      <ul class="admin-menu-item">
          <li onclick="mostrar('encuestas');">Ver Encuestas</li>
          <a href="agregar.php"><li>Agregar nueva encuesta</li></a>
      </ul>
          </li>

        <li class="adminmenu">

          <div class='amo'>
              <i class='material-icons lef'>image</i><span class='omt lef'>Multimedia</span>
          </div>

      <ul class="admin-menu-item">
          <li onclick="mostrar('imagen');">Imagenes</li>
      </ul>
          </li>



      <li class="adminmenu">
          <div class='amo'><i class='material-icons lef'>code</i><span class='omt lef'>Avanzado</span></div>
      <ul class="admin-menu-item">
          <a href='update.php'><li>Actualizar</li></a>
          </ul></li>

  </ul>
</aside>









<div class="admin-primary">
<?php
if(isset($_GET['mns'])){
    echo  $_GET['mns'];
}
?>

<!--Muestra informacion general-->
<div id="home" class='item'>
    <center>
<span class="item-title"  ><i style='font-size:50px;' class='material-icons'>person</i><p><?php echo '@'.$_SESSION['USER_NICK'].'<br>'.$_SESSION['USER_NAME']; ?></p></span>
<div style="text-align:left;">
    <table class="table-compras">
    <tr><th>Visitas al sitio</th><td><?php echo getVisitas();?></td></tr>
    <tr><th>Actividad personal</th><td><?php echo $_SESSION['count'];?></td></tr>
    <tr><th>Solicitudes de servicios</th><td><?php echo getCountRows("servicios");?></td></tr>
    <tr><th>Solicitudes de la tienda</th><td><?php echo getCountRows("compras");?></td></tr>
    <tr><th>Publicaciones en el blog</th><td><?php echo getCountRows("entradas");?></td></tr>
    <tr><th>Productos en la tienda</th><td><?php echo getCountRows("productos");?></td></tr>
    </table>
</div>

</center>
</div>

<!--Muestra los Servicios solicitados-->
<div id='servicios' class='item'>
    <?php
if(getDataBase()){
	   $resultados = query("SELECT * FROM servicios");

	  // echo "Publicado";
	   while($resultado=$resultados->fetch_array()){
	       $id= $resultado["id"];
		   $name = $resultado["name"];
		   $tel= $resultado["tel"];
		   $email= $resultado["email"];
           $website= $resultado["website"];
           $mns= $resultado["mns"];
           $addr=$resultado["ip"];
           $fecha=$resultado["fecha"];

           echo "<div class='dropdown' id='solicitud-servicio-$id'>
    <div class='dropdown-button drop'>$name a solicitado sus servicios</div>
	<div class=\"ocu\">
	<div class=\"barra-menu\">
	<button onclick='deleteServicio($id)'>Eliminar solicitud</button>
	</div>

	<table class=\"table-compras\">
	<tr>
	<th>Nombre del Cliente</th>
	<td>$name</td>
	</tr>
	<tr>
	<th>WhatsApp</th>
	<td><a href='https://wa.me/$tel'>$tel</a></td>
	</tr>
	<tr>
	<th>Correo</th>
	<td><a href='mailto:$email'>$email</a></td>
	</tr>
	<tr>
	<th>Página web</th>
	<td>$website</td>
	</tr>
	<tr>
	<th>Mensaje</th>
	<td>$mns</td>
	</tr>
    <tr>
	<th>Fecha</th>
	<td>$fecha</td>
	</tr>
    <tr>
	<th>Dirección IP</th>
	<td>$addr</td>
	</tr>
	</table>
	</div>

    </div>";

	   }
   }
?>
</div>





<!--Muestra las encuestas-->
<div id='encuestas' class="item">

<div class="wrap">
        <h1>Encuestas</h1>
        <ul class="votation">
        <?php
        $req = query("SELECT * FROM encuestas ORDER BY id DESC");
            while($result = mysqli_fetch_object($req)){
                echo '<li><a href="encuesta.php?id='.$result->id.'">'.$result->titulo.'</a></li>';
            }
        ?>
        </ul>
    </div>
</div>



<!--Muestra las imagenes subidas y permite subir nuevas imagenes-->
<div id='imagen' class="item">
<div>
<h1>Imagenes</h1>
<div style="text-align:center;">
<form class="form-admin">
<input id='inputfoto' type="file" name='inputfoto'/>
</form>
<div id="infofoto"></div>
<p>
<div id='subirfoto' class="btn-upload">
<i class="material-icons lef">publish</i> <strong style="display:inline-block;margin:3px;">SUBIR</strong>
</div>
</p>

</div>

</div>
<p>
<div class="scroll">
<table class="table-compras">
<tr>
<th>Nombre</th>
<th>URL</th>
</tr>
<?php
$fotos = query("select * from multimedia where tipo='image' ORDER BY id DESC");

while($foto = $fotos->fetch_array()){
	$f=$foto["name"];
	$u=$foto["url"];
echo "<tr>
<td>$f</td>
<td>$u</td>
</tr>";	
	
}
?>
</table>
</div>
</p>
</div>







<!--Muestra las entradas en el blog-->
<div id="entradas" class='item'>
    <h1 class="title">Entradas</h1>
    <ul class="admin-menu" >
<?php
    $entradas = getEntradas();
    while($entrada = $entradas->fetch_array()){
        $ID = $entrada['id'];
        $TITLE = $entrada['title'];
        $RESUMEN=substr($entrada["entrada"],0,300);
        $URL=$entrada["url"];
        $FECHA=$entrada["fecha"];
       echo "<div id='entrada$ID' class='dropdown'>
    <div class='dropdown-button drop'><span class='circle'></span>$TITLE</div>
	<div class=\"ocu\">
	<div class=\"barra-menu\">
	<a onclick='deleteEntrada($ID)'><i class='material-icons'>delete</i></a>
    <a href='index.php?post_id=$ID'><i class='material-icons'>open_in_new</i></a>
	</div>

	<table class=\"table-compras\">
	<tr>
	<th>Resumen</th>
	<td>$RESUMEN</td>
	</tr>
	<tr>
	<th>URL AMIGABLE</th>
	<td>$URL</td>
	</tr>
    <tr>
	<th>Fecha</th>
	<td>$FECHA</td>
	</tr>
	</table>
	</div>

    </div>";
        /*
        echo "<div class='dropdown'>
    <div class='dropdown-button'>$TITLE
    <span class='rig ic' onclick='deleteEntrada($ID)'><i class='material-icons'>delete</i></span>
    <a class='rig ic' href='index.php?id=$ID' target='_back'><i class='material-icons'>open_in_new</i></a>
    <a class='rig ic' href=''><i class='material-icons'>edit</i></a>
    </div>

    <div class='dropdown-content'/>
     $RESUMEN
     <p>$URL</p>
    </div>
    </div>";*/

    }
    ?>
   </ul>
</div>


<!--Muestra el formulario para crear o editar una entrada en el blog-->
<div id="add-entrada" class='item'>
<span class="item-title"  >Agregar entrada</span>
<form id="form_add_entrada" name="myForm" class="form-admin" action="add.php" method="POST">
<input id='act' name='act' type='hidden' value='add-entrada'/>
<input id='autor' name='autor' type='hidden' value='<?php echo $_SESSION['USER_NAME']; ?>'>
<input placeholder="Titulo" class="t1" name="title" id="title" type="text" required />
<ul class="editor">
<li class="intLink" onclick="insertMetachars('form_add_entrada','&lt;strong&gt;','&lt;\/strong&gt;');"><i class='material-icons'>format_bold</i></li>
<li class="intLink" onclick="insertMetachars('form_add_entrada','&lt;em&gt;','&lt;\/em&gt;');"><i class='material-icons'>format_italic</i></li>
<li class="intLink" onclick="var newURL=prompt('Enter the full URL for the link');if(newURL){insertMetachars('&lt;a href=\u0022'+newURL+'\u0022&gt;','&lt;\/a&gt;');}else{document.myForm.myTxtArea.focus();}"><i class='material-icons'>link</i></li>
<li class="intLink" onclick="insertMetachars('form_add_entrada','&lt;code&gt;','&lt;\/code&gt;');"><i class='material-icons'>code</i></li>
<li class="intLink" onclick="insertMetachars('form_add_entrada','\n&lt;pre&gt;\n','\n&lt;\/pre&gt;\n');">pre</li>
<li class="intLink" onclick="insertMetachars('form_add_entrada','\n&lt;p&gt;\n','\n&lt;\/p&gt;\n');">p</li>
</ul>
<textarea placeholder="Entrada" rows="10" class="entrada" id="detalle" name="detalle" required ></textarea>

<label>
SEO Para Redes Sociales
<input list="imagelist" placeholder="Imagen Destacada (Indicar URL)" class="t1" name="image" id="image" type="text" required />
<datalist id="imagelist">
<?php
$fotos = query("select * from multimedia where tipo='image' ORDER BY id DESC");

while($foto = $fotos->fetch_array()){
	$u=$foto["url"];
echo "
<option value=\"$u\">
";

}
?>
</datalist>
<textarea placeholder="Descripción (Esto es lo que mostraran las redes sociales y buscadores cuando se comparta el link de la entrada, debe ser breve.)" rows="3" class="entrada" id="description" name="description" required ></textarea>
</label>
<label>
    Categorias:
<select id='categoria' name='categoria[]' multiple>
<?php
$fotos = query("select * from categorias ORDER BY id DESC");

while($foto = $fotos->fetch_array()){
	$u=$foto["url"];
echo "
<option value=\"$u\">
";

}
?>
</select>
</label>
<label>
    Ubicar publicación en:
<select id='location' name='location'>
<option value="1">Sección principal del Blog</option>
<option value="2">Barra lateral del Blog</option>
<option value="3">Sección de Estudiantes</option>
</select>
</label>


<label id="info_add_entrada"></label>
<button type="button" id="btn_add_entrada" onclick="subirEntrada();" >Publicar</button>
</form>
</div>


<!--Muestra las categorias del blog-->
<div id="add-categoria" class='item'>
    <h1 class="title">Categorias</h1>
	<div style="text-align:center;">
<form class="form-admin">
<input id='tag'  name='tag' type="text"/>
</form>
<div id="infofoto"></div>
<p>
<div id='subircategoria' style='font-size: 16px;border-radius:5px;cursor:pointer;display:inline-block;width:100px;background:#090;text-align:center;padding:10px;'>
<i class="material-icons lef"/>publish</i> <strong style="display:inline-block;margin:3px;">SUBIR</strong>
</div>
</p>

</div>
</div>








<!--Muestra los productos a la venta-->
<div id="articulos" class='item'>
    <h1 class="title">Articulos a la venta</h1>
    <table class="table-compras">
    <tr>
        <th>Producto</th>
        <th>Precio</th>
        <th>Inventario</th>
    </tr>
<?php
    $prods=getProductos();
    while($res = $prods->fetch_array()){
        $url = $res["url"];
		   $name= $res["name"];
		   $detalle=$res["detalle"];
		   $precio=$res["precio"];
		   $moneda=$res["moneda"];
		   $id=$res["id"];
		   $provincia=$res["provincia"];
           echo "<tr id='product-id$id'>
           <td><div class='dropdown'>
    <div class='dropdown-button'>$name </div>
    <div class='dropdown-content'/>
    <button class='dropdown-button-eliminar' onclick='deleteProduct($id);' href='add.php?act=delete_producto&id=$id'>Eliminar</button>
    <a class='dropdown-button-eliminar' href='tienda.php?id=$id'>Ver</a>
    <a class='dropdown-button-eliminar' href=''>Editar</a>
    <p>
    <b>$name</b>
    <br>
     <img src='$url'  width='100%' />
     </p>
     <p>
      $detalle
     </p>
     <p><b>Precio: $precio.00 $moneda</b></p>

    </div>
    </div></td>
           <td>$precio.00 $moneda</td>
           <td></td>
           ";
        /*echo "<div class='dropdown'>
    <div class='dropdown-button'>$name </div>
    <div class='dropdown-content'/>
    <a class='dropdown-button-eliminar' href='add.php?act=delete_producto&id=$id'>Eliminar</a>
    <a class='dropdown-button-eliminar' href='tienda.php?id=$id'>Ver</a>
    <a class='dropdown-button-eliminar' href=''>Editar</a>
    <p>
    <b>$name</b>
    <br>
     <img src='$url'  width='100%' />
     </p>
     <p>
      $detalle
     </p>
     <p><b>Precio: $precio.00 $moneda</b></p>

    </div>
    </div>";*/
     echo "</tr>";
    }
    ?>
   </table>

</div>



<!--Muestra el formulario para crear agregar un nuevo producto-->
<div id="add-producto" class='item'>
<div class="item-title" >Añadir producto</div>
<form id="form_add_product" name="form_add_product" class="form-admin" action="add.php" enctype="multipart/form-data" method="POST">
    <input id='act' name='act' type='hidden' value='add-producto'/>
<input class="input-oscuro" placeholder="Nombre del Producto:" name="name" id="name" type="text" required />
<textarea placeholder="Descripción del producto:" rows="3" class="entrada" id="description" name="description" required ></textarea>
<ul class="editor">
<li class="intLink" onclick="insertMetachars('form_add_product','&lt;strong&gt;','&lt;\/strong&gt;');"><strong>Bold</strong></li>
<li class="intLink" onclick="insertMetachars('form_add_product','&lt;em&gt;','&lt;\/em&gt;');"><em>Italic</em></li>

<li class="intLink" onclick="insertMetachars('form_add_product','\n&lt;ul&gt;\n','\n&lt;\/ul&gt;\n');">ul</li>
<li class="intLink" onclick="insertMetachars('form_add_product','&lt;li&gt;','&lt;\/li&gt;');">li</li>
<li class="intLink" onclick="insertMetachars('form_add_product','\n&lt;p&gt;\n','\n&lt;\/p&gt;\n');">p</li>
</ul>

<textarea placeholder="Detalles del producto:" rows="5" class="entrada" id="detalle" name="detalle" required ></textarea>

Imagen del producto <br><small><em>Se recomienda una imagen recortada en aspecto 4:3</em></small>
<input type="file" name="imagen" required>
Precio: 
<input placeholder="Precio del Producto:" name="precio" id="precio" type="number" required/>

Tipo de Moneda: 
<select id='moneda' name='moneda'>
<option value="CUP">CUP</option>
<option value="USD">USD</option>
</select>
Provincia:
<select value="Las Tunas" id='provincia' name='provincia'>
<option value="Pinar del Río">Pinar del Río</option>
<option value="Artemisa">Artemisa</option>
<option value="Mayabeque">Mayabeque</option>
<option value="La Habana">La Habana</option>
<option value="Matanzas">Matanzas</option>
<option value="Villa Clara">Villa Clara</option>
<option value="Cienfuegos">Cienfuegos</option>
<option value="Sancti Spiritus">Sancti Spiritus</option>
<option value="Ciego de Ávila">Ciego de Ávila</option>
<option value="Camagüey">Camagüey</option>
<option value="Las Tunas">Las Tunas</option>
<option value="Holguin">Holguin</option>
<option value="Granma">Granma</option>
<option value="Santiago de Cuba">Santiago de Cuba</option>
<option value="Guantanamo">Guantanamo</option>
<option value="Isla de la Juventud">Isla de la Juventud</option>
</select>

<label id='info-product'></label>
<div style='display:inline-block;width:100%'>
<button onclick="subirProducto();" id="btn_add_product" class="rig" type="button" >Publicar</button>
</div>
</form>
</div>



<!--Muestra los pedidos a la tienda realizados por clientes-->
<div id="compras" class='item'>
<div class="item-title" >Ventas</div>
<?php
if(getDataBase()){
	   $resultados = query("SELECT * FROM compras");

	  // echo "Publicado";
	   while($resultado=$resultados->fetch_array()){
	       $id= $resultado["id"];
           $prod= $resultado["product_id"];
		   $name = $resultado["name"];
		   $tel= $resultado["tel"];
		   $email= $resultado["email"];
           $dire= $resultado["direction"];
           $mns= $resultado["mns"];

           echo "<div class='dropdown'>
    <div class='dropdown-button drop'>A $name le interesa comprar un(a) ".getProductName($prod)."</div>
	<div class=\"ocu\">
	<div class=\"barra-menu\">
	<a href='add.php?act=delete_compra&id=$id'>Eliminar</a>
    <a href='tienda.php?id=$prod'>Ver Producto</a>
	</div>

	<table class=\"table-compras\">
	<tr>
	<th>Nombre del Cliente</th>
	<td>$name</td>
	</tr>
	<tr>
	<th>WhatsApp</th>
	<td><a href='https://wa.me/$tel'>$tel</a></td>
	</tr>
	<tr>
	<th>Correo</th>
	<td><a href='mailto:$email'>$email</a></td>
	</tr>
	<tr>
	<th>Dirección</th>
	<td>$dire</td>
	</tr>
	<tr>
	<th>Mensaje</th>
	<td>$mns</td>
	</tr>
	</table>
	</div>

    </div>";

	   }
   }
?>
</div>
</div><!--Primary-->

</div>  <!--content blog-->


<footer class="pie">
	<?php
    include "media/footer.php"
?>
  </footer>


</div>
<script src="js/admin.js"></script>
</body>
</html>
