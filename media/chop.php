<?php
    if(getDataBase()){
       if(isset($_GET['s'])){
       $s =$_GET["s"];
       $res = query("SELECT * FROM productos WHERE (name LIKE '%$s%' OR detalle LIKE '%$s%')");
       if(mysqli_num_rows($res) > 0){
           echo "<div class='subtitle'>Se han encontrado los siguientes resultados para <em><strong>$s</strong></em></div>";
           writeVentas($res);
       }else{
           echo "<div class='subtitle'>No han encontrado resultados para <em><strong>$s</strong></em></div>";
       }
       }else{
       $res = query("SELECT * FROM productos");
       writeVentas($res);
       }

    }



?>