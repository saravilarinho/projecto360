
function on() {
    document.getElementById("overlay").style.display = "block";
}

function off() {
    document.getElementById("overlay").style.display = "none";
}

function abrir() {
    var x = document.getElementById("caixa");
    var y = document.getElementById("comentarios");
    var s = document.getElementById( "subir");
    var d = document.getElementById("descer");
    if (x.style.height === "150px") {
        x.style.height = "400px";
        y.style.visibility = "visible";
        s.style.visibility = "hidden";
        d.style.visibility = "visible";
        d.style.position = "absolute";

    } else {
        x.style.height = "150px";
        y.style.visibility = "hidden";
        d.style.visibility = "hidden";
        s.style.visibility = "visible";
    }
}

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

function publicacao() {
    location.href = "publicacao.php?idp=<?= $id_p ?>";
}



