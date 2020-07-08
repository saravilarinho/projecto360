
function on() {
    document.getElementById("overlay").style.display = "block";
}

function off() {
    document.getElementById("overlay").style.display = "none";
}

function abrir() {
    document.getElementById("caixa").style.height = "400px";
    document.getElementById("comentarios").style.visibility = "visible";
    console.log("ABRI");
    document.getElementById("subir").style.visibility = "hidden";
    document.getElementById("descer").style.visibility = "visible";
    document.getElementById("descer").style.position = "absolute";

}

/*function fechar() {
    document.getElementById("caixa").style.height = "150px";
    document.getElementById("comentarios").style.visibility = "hidden";
}



if (document.getElementById("caixa").style.height = "400px") {
    fechar()
}*/




