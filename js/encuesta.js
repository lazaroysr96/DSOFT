
    var encuesta = document.getElementById("encuesta");
    var resultado = document.getElementById("resultado");
    var btn = document.getElementById("btn-encuesta");
    btn.style.color="green";
    btn.onclick= function(){
    encuesta.style.display="none";
    resultado.innerText="Gasias por su voto";

    var valor = document.querySelector('input[name="encuesta"]:checked').value;
    let fd = new FormData();
    alert(fd);
    fd.append("encuesta","Hola mundo");
    fetch("media/encuesta.php",{method:"POST",body:fd})
    .then(response=>{alert(123);response.json()})
    .then(data => alert("xxx"+data));
    alert("Ejecutado")
    return false;
    }