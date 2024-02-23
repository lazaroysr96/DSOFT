
function votar(id){
    var padre= document.getElementById("encuesta"+id);
    var fr= document.getElementById("poll"+id);
    var voto = eval("fr.valor"+id+".value");
    if(voto==""){
      alert("Seleccione una opción antes de votar");
    return false;
    }
    padre.innerHTML="<img src=\"media/images/loading.gif\" width=\"32\" height=\"32\" alt=\"\">";
    if(true){
     var fd = new FormData();
    fd.append("votar","true");
    fd.append("valor",voto);
    fd.append("poll_id",id);
    //padre.innerHTML=post("poll.php",fd);

    var req =new XMLHttpRequest();
    try{    req.onload=function(){
            padre.innerHTML=req.responseText;
            }
            req.onerror=function(){
            padre.innerHTML="Error de conexión";
            }
            req.open("POST","poll.php");
            req.send(fd);
    }catch(e){
            padre.innerHTML=e;
    }
    }

}


function ver(id){
    var padre= document.getElementById("encuesta"+id);

    padre.innerHTML="<img src=\"media/images/loading.gif\" width=\"32\" height=\"32\" alt=\"\">";
    if(true){
    var req =new XMLHttpRequest();
    //padre.innerHTML=get("poll.php?poll_id="+id);

    try{
            req.onload=function(){
            padre.innerHTML=req.responseText;
            }
            req.onerror=function(){
            padre.innerHTML="Error de conexión";
            }
            req.open("GET","poll.php?poll_id="+id);
            req.send();

    }catch(e){
            padre.innerHTML=e;
    }
    }

}

function verPoll(id){
    var padre= document.getElementById("encuesta"+id);
    padre.innerHTML="<img src=\"media/images/loading.gif\" width=\"32\" height=\"32\" alt=\"\">";
    if(true){
    var req =new XMLHttpRequest();
    try{
            req.onload=function(){
            padre.innerHTML=req.responseText;
            }
            req.onerror=function(){
            padre.innerHTML="Error de conexión";
            }
            req.open("GET","poll.php?poll_idx="+id);
            req.send();
    }catch(e){
            padre.innerHTML=e;
    }
    }

}



