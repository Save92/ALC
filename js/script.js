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

	var projet_image = $("#image_projet img").attr("src");
	console.log(projet_image);

	$("#liste_image a").mouseenter(function(){
		var image = $(this).find("img").attr("src");
		$("#image_projet img").hide();
		$("#image_projet img").attr("src",image);
		$("#image_projet img").show();
	});
	$("#liste_image").bind({
		mouseenter:function(){
			$("#image_projet").show();
		},
		mouseleave: function(){
			if(projet_image){
				$("#image_projet img").attr("src",projet_image);
			}
			else{
				$("#image_projet").fadeOut(500);	
			}
		}});
	$("#icones_projets").bind({
		mouseenter:function(){
			$("#image_projet").show();
		},
		mouseleave: function(){
			$("#image_projet").fadeOut(500);	
	}});
	$("#icones_projets a").mouseenter(function(){
		var image = $(this).find("img").attr("src");
		if($(this).find("img").attr("status")){
			console.log("hello");
			$("#image_projet img").hide();
			$("#image_projet").fadeOut(500);
		}
		else{	
			$("#image_projet img").hide();
			$("#image_projet").show();
			$("#image_projet img").attr("src",image);
			$("#image_projet img").show();
		}
	});
	$('#menu_admin a').click(function(){
		var windows = $(this).attr("id");
		console.log(windows);
		$("#admin").show();
		$(".suivi_projet").hide();
		$("."+windows).show();
		return false;
	});
	$('#table_projets tr').click(function(){
		var url = $(this).find('a').attr("href");
		window.location = url;
	});
});
