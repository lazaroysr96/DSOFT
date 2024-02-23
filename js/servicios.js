var data = document.getElementById('fr');
var btn = document.getElementById('btn');
var result = document.getElementById('result');
var info = document.getElementById('info');

btn.onclick=enviar;
function enviar(){
    if(data.name.value==""){
        mns_err("El campo nombre es requerido");
        return;
    }else if(data.tel.value=="" && data.email.value==""){
        mns_err("Proporcione al menos una vía de contacto.");
        return;
    }
    mns("Procesando solicitud");
    var fr = new FormData();
    fr.append("name",data.name.value);
    fr.append("tel",data.tel.value);
    fr.append("email",data.email.value);
    fr.append("website",data.website.value);
    fr.append("mns",data.mns.value);
    fr.append("act","add-servicio");
   var req =new XMLHttpRequest();
    try{
            req.open("POST","add.php",false);
            req.send(fr);
            result.innerHTML= req.responseText;
    }catch(e){
            result.innerHTML= e;
    }
}
function mns(a){
    info.style.color="#0F0";
    info.innerText=a;
}
function mns_err(a){
    info.style.color="red";
    info.innerText=a;
}