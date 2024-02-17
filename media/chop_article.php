<?php
$id = $_GET['id'];
if(getDataBase()){

       $resultados = query("SELECT id,name,detalle,precio,moneda,provincia,url FROM productos WHERE id=$id");

       while($resultado=$resultados->fetch_array()){
           $url = $resultado["url"];
           $name= $resultado["name"];
           $detalle=$resultado["detalle"];
           $precio=$resultado["precio"];
           $moneda=$resultado["moneda"];
           $id=$resultado["id"];
           $provincia=$resultado["provincia"];
           echo "<div class=\"primary\">

<a href=\"$url\"><img class=\"card-max-img\" src=\"$url\"/></a>
<span class=\"card-max-title\">$name</span>
<div class='info'>$detalle
<table>
    <tr>
        <td>Disponible en:</td><th>$provincia</th>
      </tr>
      <tr>
        <td>Precio:</td><th>$ $precio.00 $moneda</th>
      </tr>
    </table></div>";
    If(!isset($_GET['get'])){
        echo "<div class='info'>
  <span class='textual'><em>Estimado cliente, si desea comprar este articulo deberá rellenar el formulario de solicitud que se muestra a continuación, una vez recibida su solicitud uno de nuestros gestores de venta le atenderá personalmente en un plazo no mayor a 3 días, Gracias por usar los servicios de Camapé.
  </em></span></div>";
  }else{

    }
    echo "</div><!--primary-->
    <div class=\"secondary\">";

  If(!isset($_GET['get'])){
echo "<form class='formulario' action='add.php' method='post'>
<input id='act' name='act' type='hidden' value='add-compra'/>
<label class='formulario-title'>Formulario de solicitud</label>
<label><input id='id' name='id' type='hidden' value='$id'/></label>
<label><input id='name' name='name' type='text'  placeholder='Nombre *' required /></label>
<label><input id='tel' name='tel' type='text'  placeholder='WhatsApp *' rquired /></label>
<label><input id='email' name='email' type='email' placeholder='Correo'/></label>
<label><textarea id='direction' name='direction' rows='5' placeholder='Dirección'></textarea></label>
<label><textarea id='mns' name='mns' rows='5' placeholder='Detalle aquí cualquier comentario, observación o duda que tenga sobre el producto.'></textarea></label>
<label><input class='btn-comprar' type='submit' value='Enviar'/><label>
</form>
  </div>";
  }else{
      echo "<div class='formulario'><div class='info'>
  <span class='textual'><em>Estimado cliente, le comunicamos que su solicitud a sido registrada, en las próximas 72 horas un gestor de ventas contactará con usted por las vías de contacto prestadas, agradecemos su paciencia. Nuevamente gracias por utilizar nuestros servicios.</em></span>
  </div></div>";
  }
       }
   }
?>