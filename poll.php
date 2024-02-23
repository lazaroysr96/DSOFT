<?php
include_once "core.php";
if(isset($_POST["poll_id"])&isset($_POST["votar"])){
    $poll_id= $_POST["poll_id"];
     if(isset($_POST['valor'])){
            $opciones = $_POST['valor'];
            $mod = query( "SELECT * FROM opciones WHERE id = ".$opciones);
            while($result = mysqli_fetch_object($mod)){
                $valor = $result->valor + 1; // obtenemos el valor de 'valor' y le añadimos 1 unidad
                query("UPDATE opciones SET valor =  '".$valor."' WHERE id = ".$opciones); // luego ejecutamos el query SQL
            }
            header('location: poll.php?poll_id='.$poll_id); // Por ultimo lo redireccionamos a la encuestas mostrando los resultados.
        }
}else if(isset($_GET["poll_id"])){
   verResultado($_GET["poll_id"]);
}else if(isset($_GET["poll_idx"])){
    verEncuesta($_GET["poll_idx"]);
}else{

$sel = query("SELECT * FROM encuestas ORDER BY id DESC");
        while($result = mysqli_fetch_object($sel)){
           verEncuesta($result->id);

}

}



function verEncuesta($poll_id){
             $aux = 0;
           echo "<div class='widget' id=\"encuesta$poll_id\">
           <form id=\"poll$poll_id\" class='poll-form' action=\"poll.php\" method=\"post\">";



$sql = "SELECT a.titulo as titulo, a.fecha as fecha, b.id as id, b.nombre as nombre, b.valor as valor FROM encuestas a INNER JOIN opciones b ON a.id = b.id_encuesta WHERE a.id = ".$poll_id;
$req = query($sql);

while($result = mysqli_fetch_object($req)){

    if($aux == 0){
        echo '<h1 class="widget-title">'.$result->titulo.'</h1>';

        echo '<ul class="votacion">';
        $aux = 1;
    }

    echo "\n<li><label><input name=\"valor$poll_id\" type=\"radio\" value=\"$result->id\"><span>$result->nombre</span></label></li>";

}
    echo '</ul>';

    echo "\n<input onclick=\"votar($poll_id);\" type=\"button\" value=\"Votar\" class=\"votar\">";
    echo "<span onclick=\"ver($poll_id);\" class=\"resultado\">Ver Resultados</span>";
	echo "</form></div>";
           }

function verResultado($poll_id){
$suma = 0;
$id = $_GET['poll_id'];
$mod = query("SELECT SUM(valor) as valor FROM opciones WHERE id_encuesta = ".$poll_id);
while($result = mysqli_fetch_object($mod)){
    $suma = $result->valor;
}


echo "<div class=\"wrap\">
<form class'poll-form'>";

$aux = 0;
$sql = "SELECT a.titulo as titulo, a.fecha as fecha, b.id as id, b.nombre as nombre, b.valor as valor FROM encuestas a INNER JOIN opciones b ON a.id = b.id_encuesta WHERE a.id = ".$id;
$req = query($sql);

while($result = mysqli_fetch_object($req)){
    if($aux == 0){
            echo "<h1>".$result->titulo."</h1>";
            echo "<ul class='votacion'>";
        $aux = 1;
    }
    echo '<li><div class="fl">'.$result->nombre.'</div><div class="fr">Votos: '.$result->valor.'</div>';
    if($suma == 0){
        echo '<div class="barra cero" style="width:0%;"></div></li>';
    }else{
        echo '<div class="barra" style="width:'.($result->valor*100/$suma).'%;">'.round($result->valor*100/$suma).'%</div></li>';
    }

}
echo '</ul>';

if(isset($aux)){
    echo '<span class="fr">Total: '.$suma.'</span>';
    echo "<span class=\"volver\" onclick=\"verPoll($poll_id);\" >← Volver</span>
</ul>
</form>
</div>";
}
}
?>