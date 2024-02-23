<?php
if(!file_exists('config.php')){
	exit(exit(header("location: install.php")));
}

include "config.php";
$DB_HOST = DB_HOST;
$DB_USER = DB_USER;
$DB_PASS = DB_PASS;
$DB_NAME = DB_NAME;

if(isset($DB_HOST)&&isset($DB_USER)&&isset($DB_PASS)&&isset($DB_NAME)){
	query("CREATE TABLE IF NOT EXISTS users (id integer PRIMARY KEY AUTO_INCREMENT,name text,lastname text,email text,tel text,user text,password text)");

    query("CREATE TABLE IF NOT EXISTS entradas (id integer PRIMARY KEY AUTO_INCREMENT,url text,title text,entrada text,autor text,fecha text,location text,categorias text,description text,image text)");

	query("CREATE TABLE IF NOT EXISTS categorias (id integer PRIMARY KEY AUTO_INCREMENT,name text)");

    query("CREATE TABLE IF NOT EXISTS productos (id integer PRIMARY KEY AUTO_INCREMENT,name text,detalle text,precio text,moneda text,provincia text,url text,description text,inventario text,vendido text)");

    query("CREATE TABLE IF NOT EXISTS compras (id integer PRIMARY KEY AUTO_INCREMENT,product_id text,name text,tel text,email text,direction text,mns text,fecha text,ip text)");

query("CREATE TABLE IF NOT EXISTS servicios (id integer PRIMARY KEY AUTO_INCREMENT,name text,tel text,email text,website text,mns text,fecha text,ip text)");

query('CREATE TABLE IF NOT EXISTS `encuestas` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`titulo` varchar(50) NOT NULL,
`fecha` date NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ');


query('CREATE TABLE IF NOT EXISTS `opciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_encuesta` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `valor` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1');


query("CREATE TABLE IF NOT EXISTS multimedia (id integer PRIMARY KEY AUTO_INCREMENT,tipo text,name text,url text)");

query("CREATE TABLE IF NOT EXISTS visitas (id integer PRIMARY KEY AUTO_INCREMENT,visitas text,fuente text)");

$rows = query('select * from visitas')->num_rows;
if($rows==0){
    query("INSERT INTO visitas (visitas,fuente) values (\"0\",\"0\")");
}



}else{
   exit(header("location: install.php"));
}



function getVisitas(){
    $F0= query('select * from visitas where fuente=0');
    if($F0->num_rows>0){
      return $F0->fetch_assoc()['visitas'];
    }
    return 0;
}
function getCountRows($table_name){
    $F0= query('select count(*) as id from '.$table_name);
    if($F0->num_rows>0){
      return $F0->fetch_assoc()['id'];
    }
    return 0;
}

function getDataBase(){

$c = @new mysqli(DB_HOST,DB_USER,DB_PASS);
   
   if($c){
	  $c->select_db(DB_NAME);
   return $c; 
}
}

function query($comando){
$c = getDataBase();
return $c->query($comando);
}


function escapeString($comando){
$c = getDataBase();
return mysqli_real_escape_string($c,$comando);
}

function getUser($user,$pass){
	$resultados = query("SELECT * FROM users WHERE user='$user'");
	
	while($resultado=$resultados->fetch_array()){
		
		if(sha1($pass)==$resultado["password"]){
		$_SESSION['USER_ID']=$resultado["id"];
        $_SESSION['USER_NAME']=$resultado["name"];
        $_SESSION['USER_LASTNAME']=$resultado["lastname"];
        $_SESSION['USER_EMAIL']=$resultado["email"];
        $_SESSION['USER_TEL']=$resultado["tel"];
        $_SESSION['USER_NICK']=$resultado["user"];


			return true;
		}else{
			return false;
		}
	   
	   }
}

function getEntradas(){
    return query("SELECT * FROM entradas");
}


function getProductos(){
    return query("SELECT * FROM productos");
}



function getProductName($id){
    $resultados = query("SELECT name FROM productos WHERE id=$id");
    while($resultado=$resultados->fetch_array()){
        return $resultado['name'];
        }
        return '<span style=\"color:red\">Producto agotado</span>';
}

function isExisteAdmin(){
    $res = query("SELECT * FROM users");

    while($result=$res->fetch_array()){
        return true;
        }
        return false;
}
?>