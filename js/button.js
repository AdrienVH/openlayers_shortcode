// Ajout d'un bouton à l'éditeur de texte TinyMCE (mode visuel)
tinymce.create('tinymce.plugins.openlayers',
{
	init:function(editeur,urltojs)
	{
		editeur.addButton('openlayers',
		{
			title:'Ajouter une carte Openlayers',
			image:urltojs+'/../img/logo.png',
			onclick:function(){editeur.selection.setContent('[openlayers attribut="valeur"]');}
		})
	},
	createControl:function(n,cn){return null;}
});
tinymce.PluginManager.add('openlayers',tinymce.plugins.openlayers);