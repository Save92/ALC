$(document).ready(function (){
	$(".galerie_choix").hide();
	$(".categorie").hide();

	$('#featured').orbit();
	
	$("#background").css("opacity",0);


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

	$("#page_connexion input").focus(function(){
		$("#background").stop().fadeTo(500,1);
	});
	
	$("#page_connexion input").blur(function(){
		$("#background").fadeTo(500,0);
	});

	$("#icones_projets a").mouseenter(function(){
		var image = $(this).find("img").attr("src");
		$("#image_projet img").fadeTo(500,0);
		$("#image_projet img").attr("src",image);
		$("#image_projet img").fadeTo(500,1);
	});
});