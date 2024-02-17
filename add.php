<?php
include "core.php";

if(isset($_POST['act'])){
      $act= $_POST['act'];

  if($act=="add-compra"){
      $product_id = $_POST["id"];
      $name = $_POST["name"];
      $tel =$_POST["tel"];
      $email =$_POST["email"];
      $direction =$_POST["direction"];
      $mns =$_POST["mns"];

      query("INSERT INTO compras (product_id,name,tel,email,direction,mns) VALUES ('$product_id','$name','$tel','$email','$direction','$mns')");
      exit(header("location: tienda.php?id=$product_id&get=ok"));




  }else if(($act=="add-servicio")){

      $name = $_POST["name"];
      $tel =$_POST["tel"];
      $email =$_POST["email"];
      $website =$_POST["website"];
      $mns =$_POST["mns"];
      $addr='0.0.0.0';
      $fecha=date("d/m/Y");
      if(isset($_SERVER['REMOTE_ADDR'])){
          $addr=$_SERVER['REMOTE_ADDR'];
      }

      query("INSERT INTO servicios (name,tel,email,website,mns,ip,fecha) VALUES ('$name','$tel','$email','$website','$mns','$addr','$fecha')");
echo "Hola $name, tu solicitud fue recibida correctamente, próximamente contactaremos con tigo, gracias por elegir nuestros servicios.";
      exit();


  }else if(($act=="subirfoto")&&isLogin()){
    if(isset($_FILES['foto'])){
        $name= basename($_FILES['foto']['name']);
        $path = "imagenes/".$name;
        if(move_uploaded_file($_FILES['foto']['tmp_name'], $path)){
           query("INSERT INTO multimedia (tipo,name,url) VALUES ('image','$name','$path')");
           echo $path;
      }else{
           echo "No se subió la imagen";
      }
    }else{
           echo "No se seleccionó ninguna imagen";
      }





  }else if(($act=="add-entrada")&&isLogin()){
      $t = $_POST["title"];
      $e =$_POST["detalle"];
      $url = seo_url($t);
      $autor = $_POST["autor"];
	  $img =$_POST["image"];
	  $description=$_POST["description"];

      $t = escapeString($t);
      $e = escapeString($e);
      $autor =escapeString($autor);

      query("INSERT INTO entradas (url,title,entrada,autor,fecha,description,image) VALUES ('$url','$t','$e','$autor','".date("d/m/Y")."','$description','$img')");
      echo "Publicado!!!";



  }else if(($act=="add-producto")&&isLogin()){

      $path = "imagenes/". basename($_FILES['imagen']['name']);

      if(move_uploaded_file($_FILES['imagen']['tmp_name'], $path)) {
          $name = $_POST["name"];
          $detalle =$_POST["detalle"];
          $url =$path;
          $precio =$_POST["precio"];
          $moneda =$_POST["moneda"];
          $provincia =$_POST["provincia"];
          $description =$_POST["description"];

          query("INSERT INTO productos (name,detalle,precio,moneda,provincia,url,description) VALUES ('$name','$detalle','$precio','$moneda','$provincia','$url','$description ')");
          echo "Publicado!!!";
} else{
    echo "<span style='color:red'>Error al obtener imagen del producto</span>";
    exit();
}
  }else{
    exit(header("location: login.php"));
  }




}else if($_GET['act']){
        $act = $_GET['act'];
        $id= $_GET['id'];
    if(isLogin()){
        switch($act){
             case "delete_entrada":
               query("DELETE from entradas WHERE id='".$id."'");
			   echo "Entrada eliminada correctamente";
               exit();
             break;
             case "delete_servicio":
               query("DELETE from servicios WHERE id='".$id."'");
			   echo "Solicitud eliminada correctamente";
               exit();
             break;
             case "delete_producto":
               query("DELETE from productos WHERE id='".$id."'");
               echo "Producto eliminado!!!";
               exit();
             break;
             case "delete_compra":
               query("DELETE from compras WHERE id='".$id."'");
               exit(header("location: admin.php?mns=Solicitud eliminada correctamente#compras"));
             break;
        }

    }
 exit(header("location: login.php"));
}else{
 exit(header("location: login.php"));
}

?>