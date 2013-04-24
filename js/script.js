$(document).ready(function (){
	$(".galerie_choix").hide();
	$(".categorie").hide();
	$("#galerie").click(function(){
		$(".galerie_choix").show();
		return false;
	});
	$(".galerie_choix a").click(function(){
		var nom = $(this).text();
		$(".categorie").hide();
		$("#galerie_lien_"+nom).show();
		return false;
	});

});

$(window).load(function() {
	$('#featured').orbit();
});