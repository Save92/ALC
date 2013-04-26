$(document).ready(function (){
	$(".galerie_choix").hide();
	$(".categorie").hide();
	$("#galerie").hover(function(){
		$(".galerie_choix").show();
	});
	$(".galerie_choix a").hover(function(){
		var nom = $(this).text();
		$(".categorie").hide();
		$("#galerie_lien_"+nom).show();
	});
	$("footer").mouseleave(function(){
		$(".galerie_choix").hide("slow");
		$(".categorie").hide("slow");
	});

});

$(window).load(function() {
	$('#featured').orbit();
});

function animateGlow(div){
    div.css({backgroundPosition:"0 0"})
       .animate({backgroundPosition:"-3000px 0"},25000,"linear",function(){ animateGlow(div); })
}

$(function(){
    $("#background").css("opacity",0);
    $("#page_connexion input").focus(function(){
        $("#background").stop().fadeTo(500,1);
    });
    $(" #page_connexion input").blur(function(){
        $("#background").fadeTo(500,0);
    });
    //animateGlow($("#background"));
});
