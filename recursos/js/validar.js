function validar_email(){
    var contenedor = document.getElementById("contenedor_email");
    var correo = document.getElementById("email");
    var valor = correo.value;
    if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(valor)){
        contenedor.setAttribute("class","form-group has-success");
    } else {
        contenedor.setAttribute("class","form-group has-error");
    }
}

function validar_texto(elemen_texto){
    var texto = elemen_texto.value;
    var contenedor = elemen_texto.parentNode;
    if (/^([a-z\xc0-\xff]+)$/i.test(texto)){
        contenedor.setAttribute("class","form-group has-success");
    } else {
        contenedor.setAttribute("class","form-group has-error");
    }
}
