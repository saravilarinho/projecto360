
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

// popovers Initialization
/*$(function () {
    $('[data-toggle="popover"]').popover()
});


*/

/*
TENTATIVA 2*/

$(function(){
    $("[data-toggle=popover]").popover({
        html : true,
        content: function() {
            var content = $(this).attr("data-popover-content");
            return $(content).children(".popover-body").html();
        },
        title: function() {
            var title = $(this).attr("data-popover-content");
            return $(title).children(".popover-heading").html();
        }
    });
});

$('.popover-dismiss').popover({
    trigger: "focus"
});