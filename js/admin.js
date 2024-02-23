
function mostrar(v){
var vistas=document.getElementsByClassName('item');

for(var i = 0;i<vistas.length;i++){

    var m = vistas[i];

    m.style.display="none";
}
document.getElementById(v).style.display="block";
document.getElementById(v).style.animationName="anim";
document.getElementById(v).style.animationDuration="1s";	
}




document.getElementById("home").style.display="block";
var drop=document.getElementsByClassName('drop');

for(var i = 0;i<drop.length;i++){

    var m = drop[i];

    m.onclick=abrir1;
}

function abrir1(){
var ul = this.parentNode.getElementsByClassName("ocu");
    if(ul.length>0){
     ul[0].style.display="block"
	 ul[0].style.animationName="anim";
	 ul[0].style.animationDuration="1s";
    }
    this.style.color="#ff0";
    this.onclick=cerrar1;
}

function cerrar1(){
var ul = this.parentNode.getElementsByClassName("ocu");
    if(ul.length>0){
     ul[0].style.display="none";
    }
    this.style.color="#def";
    this.onclick=abrir1;
}







var menu=document.getElementsByClassName('adminmenu');

for(var i = 0;i<menu.length;i++){

    var m = menu[i];

    m.onclick=abrir;
}

function abrir(){
var ul = this.getElementsByTagName("ul");
    if(ul.length>0){
     ul[0].style.display="block";
    }
    this.style.color="#ff0";
    this.onclick=cerrar;
}

function cerrar(){
var ul = this.getElementsByTagName("ul");
    if(ul.length>0){
     ul[0].style.display="none";
    }
    this.style.color="#def";
    this.onclick=abrir;
}










var subirfoto=document.getElementById('subirfoto');
var inputfoto=document.getElementById('inputfoto');
var infofoto=document.getElementById('infofoto');


subirfoto.onclick=subirFoto;



function subirFoto(){
  infofoto.innerText="Cargando...";
  var fd = new FormData();
  fd.append("act","subirfoto")
  fd.append("foto",inputfoto.files[0]);
  var req =new XMLHttpRequest();
  try{
      req.onload=function(){
            infofoto.innerHTML=req.responseText;
            }
            req.onerror=function(){
            infofoto.innerHTML="Error de conexión";
            }
      req.upload.onprogress=function(event){
        infofoto.innerHTML="Cargando..."+event.loaded+"/"+event.total;
      }
      req.open("POST","add.php");
      req.send(fd);
  }catch(e){
      infofoto.innerHTML=e;
  }
}


function subirProducto(){
    var info = document.getElementById("info-product");
    var form = document.getElementById("form_add_product");
    var btn = document.getElementById("btn_add_product");
    var prog = document.createElement("progress");
    prog.style.display="block";
  btn.innerHTML="<img src=\"media/images/loading.gif\" width=\"32\" height=\"32\" alt=\"\">";
  btn.style.display="inline-block";
  info.appendChild(prog);
  var fd = new FormData(form);
  var req =new XMLHttpRequest();
  try{
      req.onload=function(){
            info.innerHTML=req.responseText;
            btn.innerText="Publicar";
            }
            req.onerror=function(){
            info.innerHTML="Error de conexión";
            }
      req.upload.onprogress=function(event){

      prog.max= event.total;
      prog.value=event.loaded;
      }
      req.open("POST","add.php");
      req.send(fd);
  }catch(e){
      info.innerHTML=e;
  }
}

function subirEntrada(){
    var info = document.getElementById("info_add_entrada");
    var form = document.getElementById("form_add_entrada");
    var btn = document.getElementById("btn_add_entrada");
    if(form.title.value==""){
        info.innerHTML="Complete el campo de titulo";
        return;
    }
    if(form.editor.value==""){
        info.innerHTML="La entrada no puede estar vicia";
        return;
    }
    var prog = document.createElement("progress");
    prog.style.display="block";
  btn.innerHTML="<img src=\"media/images/loading.gif\" width=\"32\" height=\"32\" alt=\"\">";
  btn.style.display="inline-block";
  info.appendChild(prog);
  var fd = new FormData(form);
  var req =new XMLHttpRequest();
  try{
      req.onload=function(){
            info.innerHTML=req.responseText;
            btn.innerHTML="<i class=\"material-icons\">done</i>";
            }
            req.onerror=function(){
            info.innerHTML="Error de conexión";
            btn.innerText="Reintentar";
            }
      req.upload.onprogress=function(event){

      prog.max= event.total;
      prog.value=event.loaded;
      }
      req.open("POST","add.php");
      req.send(fd);
  }catch(e){
      info.innerHTML=e;
  }
  return false;
}

function deleteEntrada(a){
	if(confirm("Advertencia, usted está a punto de eliminar una entrada permanentemente, esta acción es irrevocable. ¿Esta usted seguro de eliminar esta en entrada?")){
	this.onclick=null;
	this.innerHTML="";
	var req =new XMLHttpRequest();
  try{
      req.onload=function(){
      alert(req.responseText);
      document.getElementById("entrada"+a).style.display="none";
      }
      req.onerror=function(){
      alert("Error de conexión");
      }
      req.open("GET","add.php?act=delete_entrada&id="+a);
      req.send();
  }catch(e){
      alert(e);
  }
	}
}



function deleteServicio(a){
	if(confirm("Advertencia, usted está a punto de eliminar una solicitud de servicio permanentemente, esta acción es irrevocable. ¿Esta usted seguro de eliminar esta en entrada?")){
	this.onclick=null;
	this.innerHTML="";
	var req =new XMLHttpRequest();
  try{
            req.onload=function(){
            alert(req.responseText);
            document.getElementById("solicitud-servicio-"+a).style.display="none";
            }
            req.onerror=function(){
            alert("Error de conexión");
            }
      req.open("GET","add.php?act=delete_servicio&id="+a);
      req.send();

  }catch(e){
      alert(e);
  }
	}
}




function deleteProduct(a){
	if(confirm("Advertencia, usted está a punto de eliminar una solicitud de servicio permanentemente, esta acción es irrevocable. ¿Esta usted seguro de eliminar esta en entrada?")){
	this.onclick=null;
	this.innerHTML="";
	var req =new XMLHttpRequest();
  try{
            req.onload=function(){
            alert(req.responseText);
            document.getElementById("product-id"+a).style.display="none";
            }
            req.onerror=function(){
            alert("Error de conexión");
            }
      req.open("GET","add.php?act=delete_producto&id="+a);
      req.send();

  }catch(e){
      alert(e);
  }
	}
}

function updateEntrada(a){

	var req =new XMLHttpRequest();
  try{
      req.open("GET","index.php?post_id="+a+"&json=true",false);
      req.send();
      alert(req.responseText);
  }catch(e){
      alert(e);
  }

}


var btn_menu=document.getElementById("btn-menu");
var menu = document.getElementById("menu");
var bool_menu=true;
btn_menu.onclick=function(){
   if(bool_menu){
       menu.style.display="block";
   }else{
       menu.style.display="none";
   }
   bool_menu=!bool_menu;
}



function insertMetachars(id,sStartTag, sEndTag) {
    var fr = document.getElementById(id);
  var bDouble = arguments.length > 1, oMsgInput = fr.detalle, nSelStart = oMsgInput.selectionStart, nSelEnd = oMsgInput.selectionEnd, sOldText = oMsgInput.value;
  oMsgInput.value = sOldText.substring(0, nSelStart) + (bDouble ? sStartTag + sOldText.substring(nSelStart, nSelEnd) + sEndTag : sStartTag) + sOldText.substring(nSelEnd);
  oMsgInput.setSelectionRange(bDouble || nSelStart === nSelEnd ? nSelStart + sStartTag.length : nSelStart, (bDouble ? nSelEnd : nSelStart) + sStartTag.length);
  oMsgInput.focus();
}



