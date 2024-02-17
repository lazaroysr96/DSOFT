/*confeccionado por: Lazaro Yunier Salazar Rodriguez (@lazaroysr96)*/

function post(url,data){
   var req =new XMLHttpRequest();
    try{
            req.open("POST",url,false);
            req.send(data);
            return req.responseText;
    }catch(e){
            return e;
    }
}

function get(url){
   var req =new XMLHttpRequest();
    try{
            req.open("GET",url,false);
            return req.responseText;
    }catch(e){
            return e;
    }
}